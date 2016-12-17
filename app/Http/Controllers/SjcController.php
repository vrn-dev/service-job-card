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

        return view('sjc.sjc_form')->with('formData', $formData);
    }

    public function getSjcIndex()
    {
        return view('sjc.sjc');
    }

    public function postCreateSjc(Request $request)
    {
        $ticketId = $request['ticketId'];
        $scheduleDate = $request['scheduleDate'];
        $assignedTo = $request['assignedTo'];

        $ticket = Ticket::find($ticketId);

        if (!(Sjc::where('ticket_id', $ticketId)))
        {
            return response('found', 200);
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
            'fnw' => 'present',
            'actTaken' => 'present',
            'repPart' => 'present',
            'noc' => 'present',
        ]);

        $ticketId = $request->ticketId;
        $sjc = Sjc::where('ticket_id', $ticketId)->first();


        $fnw = $request->fnw;
        foreach ($fnw as $item) //Store Fault & Warnings in Fnw
        {
            $jc = new Fnw();
            $jc->sjc_id = $sjc->id;
            $jc->ticket_id = $ticketId;
            $jc->fnw_value = $item;
            $jc->save();
        }

        $of = new OtherFault(); //Store otherFault in other_fault
        $of->sjc_id = $sjc->id;
        $of->ticket_id = $ticketId;
        $of->value = $request->otherFault;
        $of->save();


        $actTaken = $request->actTaken;
        foreach ($actTaken as $item) //Store actTaken in act_taken
        {
            $jc = new ActTaken();
            $jc->sjc_id = $sjc->id;
            $jc->ticket_id = $ticketId;
            $jc->value = $item;
            $jc->save();
        }

        $oa = new OtherAction(); //Store otherAction in other_action
        $oa->sjc_id = $sjc->id;
        $oa->ticket_id = $ticketId;
        $oa->value = $request->otherAction;
        $oa->save();

        $repPart = $request->repPart;
        foreach ($repPart as $item) //Store repPart in rep_part
        {
            $jc = new RepPart();
            $jc->sjc_id = $sjc->id;
            $jc->ticket_id = $ticketId;
            $jc->value = $item;
            $jc->save();
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

        //TODO sort out mail
        //TODO sort out JC download and template
        //TODO same JC needs to go out in mail as attachment

        /*$data = [
            'fnw' => $request->fnw,
            'otherFault' => $request->otherFault,
            'actTaken' => $request->actTaken,
            'otherAction' => $request->otherAction,
            'repPart' => $request->repPart,
            'noc' => $request->noc,
            'remarks' => $request->remarks,
            'ticketId' => $request->ticketId
        ];

        if(Mail::send('emails.jobCardMail', $data, function ($message){
            $message->from('vrn.njt@outlook.com');
            $message->to('vrn.dev@outlook.com');
            $message->subject('New Job Card');
        }))*/


        return view('sjc.sjc');
    }

    public function getPdfDownload()
    {
        $pdf = PDF::loadView('emails.test');

        return $pdf->download('invoice.pdf');
    }


}
//TODO Make Validations for submits
//TODO make Job Card into PDF and send as attachment
//TODO once the JC is done and status on SJC is set to Completed, move ticket from active ticket table to historical ticket table, make historical ticket table