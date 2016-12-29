<?php

namespace App\Http\Controllers;

use App\Company;
use App\Inventory;
use App\Ticket;
use Illuminate\Http\Request;


class TicketController extends Controller
{
    public function getIndex()
    {
        $companySelect = Company::select('companyName','id')->get();
        return view('ticket.ticketGenerator', ['companySelect' => $companySelect]);
    }

    public function popAsset(Request $request)
    {
        $idVal = $request['idVal'];

        $inventory = Inventory::
                        where('company_id','=', $idVal)
                        ->orderBy('id','asc')
                        ->get();


        return response()->json($inventory);
    }

    public function popTicketId()
    {
        $ticketId = Ticket::orderBy('id','desc')->first();

        if ($ticketId == null) {
            $newTicketId = 12345678;
        }
        else{
            $newTicketId = $ticketId->id + 1;
        }

        return response($newTicketId);
    }

    public function popTable()
    {
        $ticket = Ticket::all();

        return response()->json($ticket);
    }

    public function postCreateTicket(Request $request)
    {
        $this->validate($request, [
            'companyId' => 'required',
            'assetId'     => 'required',
            'issueDate' => 'required',
            'issueCategory' => 'required',
            'issueDescription' => 'required'
        ]);

        $ticket = new Ticket();
        $ticket->company_id = $request['companyId'];
        $ticket->company_name = $ticket->company->companyName;
        $ticket->inventory_id = $request['assetId'];
        $ticket->asset_serial = $ticket->inventory->machine_serial;
        $ticket->asset_model = $ticket->inventory->machine_model;
        $ticket->issue_date = $request['issueDate'];
        $ticket->issue_category = $request['issueCategory'];
        $ticket->issue_details = $request['issueDescription'];
        $ticket->status = "Active";
        $message = "There was an error in creating record";
        if($ticket->save())
        {
            $message = "Record was successfully created";
            return response($message, 200);
        }
        //return response($message, 200);

    }

    public function getPeekModal(Request $request)
    {
        $companyId = $request['companyId'];
        $ticketId = $request['ticketId'];

        $company = Company::find($companyId);
        $ticket = Ticket::find($ticketId);

        return response()->json(["company" => $company, "ticket" => $ticket],200);
    }

    public function getDeleteTicket(Request $request)
    {
        $ticketId = $request['ticketId'];

        $ticket = Ticket::find($ticketId);

        $ticket->delete();

        return response('',200);
    }


}

