<?php

namespace App\Http\Controllers;

use App\Company;
use App\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InventoryController extends Controller
{
    public function getIndex()
    {
       return view('directory.inventory');
    }

    public function postCreateInventory(Request $request)
    {
        $this->validate($request, [
            'machineSeries' => 'required',
            'machineModel' => 'required',
            'machineSerial' => 'required|unique:inventories,machine_serial',
            'companyId' => 'required',
        ]);

        $inventory = new Inventory();
        $inventory->machine_series = $request['machineSeries'];
        $inventory->machine_model = $request['machineModel'];
        $inventory->machine_serial = $request['machineSerial'];
        $inventory->company_id = $request['companyId'];
        $inventory->company_name = $inventory->company->companyName;
        $inventory->save();
        return response()->json('Created', 201);
    }


    public function getInventoryDelete(Request $request)
    {
        $serial = $request->machineSerial;
        $inventory = Inventory::where('machine_serial',$serial)->first();

        $inventory->delete();
        return response()->json('Deleted', 200);
    }

    public function popCompanySelect(){
        $company = Company::pluck('companyName','id');
        return response()->json($company);
    }

    public function popTable(){
        $inventory = Inventory::all();
        return response()->json($inventory);
    }
}
