<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        return view('login');
    }

    public function postLoginAdmin(Request $request): RedirectResponse
    {
        $remember = $request->has('remember_me');
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password],$remember)){
          return redirect()->to('home');
        }
        else {
            return redirect()->route('admin.post_login')->with('error','Username or password is not correct!');
        }
    }
}
