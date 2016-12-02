<?php

namespace App\Http\Controllers;

use App\Company;
use App\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InventoryController extends Controller
{
    public function getIndex(Request $request)
    {
        $search = $request['search'];

        $inventory = Inventory::where('machine_model','like', '%'.$search.'%')
                        ->orWhere('company_name', 'like', '%'.$search.'%')
                        ->orderBy('id','asc')->get();
        $companies = Company::orderBy('companyName','asc')->get();
        return view('directory.inventory', ['inventory' => $inventory, 'companies' => $companies]);
    }


    public function postCreateInventory(Request $request)
    {
        $this->validate($request, [
            'machine-series' => 'required',
            'machine-model' => 'required',
            'machine-serial' => 'required|unique:inventories,machine_serial',
            'company-id' => 'required',
        ]);

        $inventory = new Inventory();
        $inventory->machine_series = $request['machine-series'];
        $inventory->machine_model = $request['machine-model'];
        $inventory->machine_serial = $request['machine-serial'];
        $inventory->company_id = $request['company-id'];
        $inventory->company_name = $inventory->company->companyName;
        $message = "There was an error in creating record";
        if($inventory->save())
        {
            $message = "Record was successfully created";
        }
        return redirect()->route('inventory.index')->with(['message' => $message]);
    }


    public function getInventoryDelete($inventory_id)
    {
        $inventory = Inventory::find($inventory_id);
        if (Auth::user() != $inventory->user)
        {
            redirect()->back();
        }
        $inventory->delete();
        return redirect()->route('inventory.index')->with(['message' => 'Record for '.$inventory->company->companyName.' was successfully deleted']);
    }
}
