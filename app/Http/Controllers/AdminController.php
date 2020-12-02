<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() 
    {
        return view('index');   
    }

    public function postLogin(Request $request) 
    {
        $username = $request->username;
        $password = md5($request->password);
        $user = DB::table('account')->where('username', $username)->where('password', $password)->get();
        if (count($user) == 0) {
            return redirect()->back()->with('alert', 'Incorrect username or password.');
        } else {
            session(['user' => $username]);
            return redirect('register');
        }
    }

    public function register() 
    {
        return view('register');   
    }
}
