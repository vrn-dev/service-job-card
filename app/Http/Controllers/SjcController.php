<?php

namespace App\Http\Controllers;

use App\ActTaken;
use App\Fnw;
use App\Noc;
use App\OtherAction;
use App\OtherFault;
use App\RepPart;
use App\Sjc;
use App\Ticket;
use App\User;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Object_;


class SjcController extends Controller
{

    public function getSjcCreateForm(Request $request)
    {
        $ticketId = $request['ticketId'];
        $ticket = Ticket::find($ticketId);
        $username = User::where('username','!=','admin')->pluck('username');

        $formData = (object)[
            'ticketId'        => $request['ticketId'],
            'companyName'     => $ticket->company->companyName,
            'contactPerson'   => $ticket->company->contactName,
            'contactMobile'   => $ticket->company->contactMobile,
            'contactEmail'    => $ticket->company->contactEmail,
            'ticketIssueDate' => $ticket->issue_date,
            'machineModel'    => $ticket->inventory->machine_model,
            'machineSerial'   => $ticket->inventory->machine_serial,
            'address'         => $ticket->company->address
        ];

        return view('sjc.sjc_form')->with(['formData' => $formData, 'username' => $username]);
    }

    public function getSjcIndex()
    {
        $username = User::where('username','!=','admin')->pluck('username');
        return view('sjc.sjc')->with('username', $username);
    }

    public function postCreateSjc(Request $request)
    {
        $ticketId = $request['ticketId'];
        $scheduleDate = $request['scheduleDate'];
        $assignedTo = $request['assignedTo'];

        $ticket = Ticket::find($ticketId);

        if (!(Sjc::where('ticket_id', $ticketId)))
        {
            return response('duplicate', 200);
        }
        else {

            $sjc = new Sjc();

            $sjc->ticket_id = $ticketId;
            $sjc->company_id = $ticket->company_id;
            $sjc->inventory_id = $ticket->inventory_id;
            $sjc->assigned_to = $assignedTo;
            $sjc->scheduled_date = $scheduleDate;
            $sjc->status = "Active";

            if ($sjc->save()) {
                return response('OK', 200);
            }
        }
    }

    public function popTable()
    {
        $sjcTable = DB::table('tickets')
            ->Join('sjcs', 'tickets.id','=', 'sjcs.ticket_id')
            ->get();

        return response()->json($sjcTable);
    }

    public function getJobCardIndex()
    {
        return view('sjc.jobCard');
    }

    public function postSjcUpdate(Request $request)
    {
        $ticketId = $request['ticketId'];
        $reDate = $request['reDate'];
        $reAssign = $request['reAssign'];

        $sjc = Sjc::where('ticket_id','=', $ticketId)->first();

        $sjc->assigned_to = $reAssign;
        $sjc->scheduled_date = $reDate;


        if($sjc->update()){
            return response('OK',200);
        }else{
            return response('Error',400);
        }

    }

    public function getSjcDelete(Request $request)
    {
        $ticketId = $request['ticketId'];

        $sjc = Sjc::where('ticket_id','=', $ticketId)->first();

        if($sjc->delete()){
            return response('OK',200);
        }else{
            return response('Error',400);
        }

    }

    public function getFillSjc (Request $request)
    {
        $ticketId = $request['ticketId'];

        return view('sjc.jobCard')->with('ticketId', $ticketId);
    }

    public function postSendEmail (Request $request)
    {
        $this->validate($request, [
            'noc' => 'present',
            'fae' => 'required',
            'customerSupervisor' => 'required',
            'jobDate' => 'required',
            'machineHours' => 'required'
        ]);

        $ticketId = $request->ticketId;
        $sjc = Sjc::where('ticket_id', $ticketId)->first();

        $fnw = $request->fnw;
        if(!empty($fnw))
        {
            foreach ($fnw as $item) //Store Fault & Warnings in Fnw
            {
                $jc = new Fnw();
                $jc->sjc_id = $sjc->id;
                $jc->ticket_id = $ticketId;
                $jc->fnw_value = $item;
                $jc->save();
            }
        }
        if(!empty($request->otherFault))
        {
            $of = new OtherFault(); //Store otherFault in other_fault
            $of->sjc_id = $sjc->id;
            $of->ticket_id = $ticketId;
            $of->value = $request->otherFault;
            $of->save();
        }


        $actTaken = $request->actTaken;
        if(!empty($actTaken)) {
            foreach ($actTaken as $item) //Store actTaken in act_taken
            {
                $jc = new ActTaken();
                $jc->sjc_id = $sjc->id;
                $jc->ticket_id = $ticketId;
                $jc->value = $item;
                $jc->save();
            }
        }

        if(!empty($otherAction))
        {
            $oa = new OtherAction(); //Store otherAction in other_action
            $oa->sjc_id = $sjc->id;
            $oa->ticket_id = $ticketId;
            $oa->value = $request->otherAction;
            $oa->save();
        }

        $repPart = $request->repPart;
        if(!empty($repPart)) {
            foreach ($repPart as $item) //Store repPart in rep_part
            {
                $jc = new RepPart();
                $jc->sjc_id = $sjc->id;
                $jc->ticket_id = $ticketId;
                $jc->value = $item;
                $jc->save();
            }
        }

        $noc = $request->noc;//Store noc in noc
        $nc = new Noc();
        $nc->sjc_id = $sjc->id;
        $nc->ticket_id = $ticketId;
        $nc->value = $noc;
        $nc->remarks = $request->remarks;
        $nc->save();

        $sjc->status = "Completed";
        $sjc->update();

        $ticket = Ticket::find($ticketId);
        $ticket->issue_category = 'Not Active';
        $ticket->status = 'Not Active';
        $ticket->update();

        //Generate PDF

        $fnwPass = Fnw::where('ticket_id', $ticketId)->pluck('fnw_value')->toArray();
        $otherFaultPass = OtherFault::where('ticket_id', $ticketId)->value('value');
        $actTakenPass = ActTaken::where('ticket_id', $ticketId)->pluck('value')->toArray();
        $otherActionPass = OtherAction::where('ticket_id', $ticketId)->value('value');
        $repPartPass = RepPart::where('ticket_id', $ticketId)->pluck('value')->toArray();
        $nocPass = Noc::where('ticket_id', $ticketId)->value('value');
        $remarksPass = Noc::where('ticket_id', $ticketId)->value('remarks');


        PDF::loadView('emails.jobCardMail', [
            'customer' => $sjc->company->companyName,
            'location' => $sjc->company->address,
            'supervisor' => $request->customerSupervisor,
            'mobile' => $sjc->company->contactMobile,
            'date' => $request->jobDate,
            'machineModel' => $sjc->inventory->machine_model,
            'machineSerial' => $sjc->inventory->machine_serial,
            'machineHours' => $request->machineHours,
            'ticketId' => $ticketId,
            'fnw' => $fnwPass,
            'otherFault' => $otherFaultPass,
            'actTaken' => $actTakenPass,
            'otherAction' => $otherActionPass,
            'repPart' => $repPartPass,
            'noc' => $nocPass,
            'remarks' => $remarksPass,
            'user' => $request->fae,
        ])->save('/Applications/MAMP/htdocs/service-job-card/storage/app/public/job_card.pdf');

        Storage::copy('public/job_card.pdf', 'public/job_card_history/job_card_'.$ticketId.'.pdf');
        //Storage::copy('job_card.pdf', 'job_card_history/job_card_'.$ticketId.'.pdf'); //if filesystem disks = public

        $data = ['ticketId' => $request->ticketId];


        Mail::send('emails.email', $data, function ($message){
            $mailto = ['ronin.dev@outlook.com'];
            $message->from('job.card@tradelinkmeltd.com');
            foreach($mailto as $email) {
                $message->to($email);
            }
            $message->subject('New Job Card');
            $message->attach('storage/job_card.pdf',[
                'as' => 'JobCard.pdf',
                'mime' => 'application/pdf'
            ]);
        });
        Storage::delete('public/job_card.pdf');
        //Storage::delete('job_card.pdf'); //if filesystem disks = public

        return redirect()->route('sjc.index');
    }

    public function getPdfDownload(Request $request)
    {
        $ticketId = $request->ticketId;
        return response()->download('storage/job_card_history/job_card_'.$ticketId.'.pdf');
    }

}
