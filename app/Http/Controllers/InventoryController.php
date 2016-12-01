<?php

namespace App\Http\Controllers;

use App\Company;
use App\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::orderBy('id','asc')->get();
        $companies = Company::orderBy('companyName','asc')->get();
        //$inventory_co_Id = Inventory::where('id','=', )
        //$company = Company::where('id','=', $inventory_co_Id)->value('companyName');
        return view('directory.inventory', ['inventory' => $inventory, 'companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $message = "There was an error in creating record";
        if($inventory->save())
        {
            $message = "Record was successfully created";
        }
        return redirect()->route('inventory.index')->with(['message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
