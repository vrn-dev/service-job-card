<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function getIndex(){
        return view('admin.adminAccount');
    }

    public function popUserTable(){
        $users = User::all();

        return response()->json($users);
    }

    public function postCreateUser(Request $request){
        $this->validate($request, [
            'username' => 'required|max:15|unique:users,username',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'passwordRepeat' => 'required|min:6|same:password'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if($user->save()){
            return response()->json('Created', 201);
        }
        else {
            return response()->json('Error', 500);
        }

    }

    public function postUserPasswordReset(Request $request){
        $username = $request->username;

        $user = User::where('username', $username)->first();

        $user->password = bcrypt('password');
        if($user->update()){
            return response()->json('Reset', 200);
        }
        else {
            return response()->json('Error', 500);
        }
    }

    public function postDeleteUser(Request $request){
        $username = $request->username;

        $user = User::where('username', $username);
        if($user->delete()){
            return response()->json('Deleted', 200);
        }
        else {
            return response()->json('Error', 500);
        }
    }

    public function postAdminResetPassword(Request $request){
        $this->validate($request, [
            'currentPwd' => 'required',
            'newPwd' => 'required|min:6',
            'repNewPwd' => 'required|min:6|same:newPwd'
        ]);

        $user = User::where('username','admin')->first();
        if(Hash::check($request->currentPwd, $user->password)){
            $user->password = bcrypt($request->newPwd);
            if($user->update()){
                Auth::logout();
                return response()->json('Updated', 200);
            }
            else {
                return response()->json('Error', 500);
            }
        }
        else{
            return response()->json('Current Password Incorrect', 401);
        }
    }

    public function getUserAccountIndex(){
        return view('admin.userAccount');
    }

    public function postUserChangePassword(Request $request){
        $this->validate($request, [
            'userName' => 'required',
            'currentPwd' => 'required',
            'newPwd' => 'required|min:6',
            'repPwd' => 'required|min:6|same:newPwd'
        ]);

        $user = User::where('username', $request->userName)->first();


        if(Hash::check($request->currentPwd, $user->password)){
            $user->password = bcrypt($request->newPwd);
            if($user->update()){
                Auth::logout();
                return response()->json('Updated', 200);
            }
            else {
                return response()->json('Error', 500);
            }
        }
        else{
            return response()->json('Current Password Incorrect', 401);
        }
    }

    public function postUserChangeEmail(Request $request){
        $this->validate($request, [
            'userName' => 'required',
            'newEmail' => 'required|email'
        ]);

        $user = User::where('username', $request->userName)->first();
        $user->email = $request->newEmail;
        if($user->update()){
            Auth::logout();
            return response()->json('Updated', 200);
        }
        else {
            return response()->json('Error', 500);
        }
    }
}
