<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $dummyEmail = "admin@example.com";
    private $dummyPassword = "password123";

    public function show()
    {
        return view('auth.login');
    }

    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if($request->email === $this->dummyEmail && $request->password === $this->dummyPassword) {
            session(['logged_in' => true, 'user_name' => 'Administrator']);
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
