<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function getDashboard ()
    {
        $username = User::where('username','!=','admin')->pluck('username');
        return view('sjc.sjc')->with('username', $username);
    }

    public function getIndex()
    {
        return view('directory.company');
    }

    public function popTable(){
        $company = Company::all();

        return response()->json($company);
    }

    public function postCreateCompany(Request $request)
    {
        $this->validate($request, [
            'companyName' => 'required|max:150|unique:companies,companyName',
            'contactName' => 'required|max:150',
            'contactTel' => 'required|max:20',
            'contactMobile' => 'required|max:20',
            'contactEmail' => 'required|email',
            'city' => 'required',
            'country' => 'required',
        ]);

        $company = new Company();
        $company->companyName = $request['companyName'];
        $company->contactName = $request['contactName'];
        $company->contactTel = $request['contactTel'];
        $company->contactMobile = $request['contactMobile'];
        $company->contactEmail = $request['contactEmail'];
        $company->city = $request['city'];
        $company->country = $request['country'];
        $company->address = $request['address'];
        $message = 'There was an error creating the record.';
        if($company->save())
        {
            return response()->json('Created', 201);
        }
        else {
            return response()->json('Error', 500);
        }
    }

    public function postEditCompany(Request $request)
    {
        $this->validate($request, [
            'companyName' => 'required|max:150',
            'contactName' => 'required|max:150',
            'contactTel' => 'required|max:20',
            'contactMobile' => 'required|max:20',
            'contactEmail' => 'required|email',
            'city' => 'required',
            'country' => 'required',
            'address' => 'required'
        ]);

        $company = Company::find($request['companyId']);
        $company->companyName = $request['companyName'];
        $company->contactName = $request['contactName'];
        $company->contactTel = $request['contactTel'];
        $company->contactMobile = $request['contactMobile'];
        $company->contactEmail = $request['contactEmail'];
        $company->city = $request['city'];
        $company->country = $request['country'];
        $company->address = $request['address'];
        $company->update();
        return response()->json('Updated', 202);
    }

    public function getDeleteCompany(Request $request)
    {
        $company = Company::find($request->companyId);

        if($company->delete()){
            return response()->json('OK',200);
        }
        else{
            return response()->json('Not OK', 500);
        }

    }
}

