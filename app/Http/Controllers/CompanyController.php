<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class CompanyController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function getDashboard ()
    {
        return view('dashboard');
    }

    public function getCompanyView(Request $request)
    {
        $search = $request['search'];

        $companies = Company::
                        where('companyName','like', '%'.$search.'%')
                        ->orderBy('id', 'asc')
                        ->Paginate(10);
        return view('directory.company', ['companies' => $companies]);
    }

    public function postCreateCompany(Request $request, $current_page)
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
        if($request->user()->companies()->save($company))
        {
            $message = "The Record was successfully created";
        }
        return redirect()->route('companyView', ['page='.$current_page])->with(['message' => $message]);
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
//        if (Auth::user != $company->user)
//        {
//            redirect()->back();
//        }
        $company->companyName = $request['companyName'];
        $company->contactName = $request['contactName'];
        $company->contactTel = $request['contactTel'];
        $company->contactMobile = $request['contactMobile'];
        $company->contactEmail = $request['contactEmail'];
        $company->city = $request['city'];
        $company->country = $request['country'];
        $company->address = $request['address'];
        $company->update();
        return response()->json([
            'new_companyName' => $company->companyName,
            'new_contactName' => $company->contactName,
            'new_contactTel'  => $company->contactTel,
            'new_contactMobile' => $company->contactMobile,
            'new_contactEmail' => $company->contactEmail,
            'new_city'        => $company->city,
            'new_country'     => $company->country,
            'new_address'     => $company->address
        ], 200);
    }

    public function getDeleteCompany($company_id, $current_page)
    {
        $company = Company::find($company_id);
        if (Auth::user() != $company->user)
        {
            redirect()->back();
        }
        $company->delete();
        return redirect()->route('companyView', ['page='.$current_page])->with(['message' => 'Record for '.$company->companyName.' was successfully deleted']);
    }
}

