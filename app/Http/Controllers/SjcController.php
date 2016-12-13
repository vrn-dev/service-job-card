<?php

namespace App\Http\Controllers;

use App\Sjc;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
//TODO Make Validations for submits