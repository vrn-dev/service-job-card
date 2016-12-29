<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function userSignUp(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'email'   => 'required|email',
            'name' => 'required|max:120',
            'password' => 'required|min:4',
            'repeatPassword' => 'required|min:4|same:password'
        ]);
        $username = $request['username'];
        $email = $request['email'];
        $name = $request['name'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->name = $name;
        $user->password = $password;

        $user->save();

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function userSignIn(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']]))
        {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login')->withMessage('Invalid Login')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}