<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PublicController extends Controller
{
    public function __construct() {
	 	
    }
    
    // public function login_view() {

    //     if(Auth::guard('admin')->check()) {
    //         return back();
    //     } 
    //     else {
    //         return view('pages.public.login');
    //     }
    // }

    public function loginAuth(Request $request) {

        $this->validate($request, [
            'email'    => 'required|email|exists:admins',
            'password' => 'required|min:6'
        ],
        [
            'email.exists' => 'Email not found.'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            return redirect()->intended('/dashboard');
        }
        return back()->withInput($request->only('email', 'password'))->with('failedLogin', 'Wrong Password!');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
