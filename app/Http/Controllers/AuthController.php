<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    
    public function store()
    {
        $formData=request()->validate([
            'name'=>['required','max:255','min:3'],
            'username'=>['required','max:255','min:3',Rule::unique('users','username')],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>['required','min:8']
        ]);
        
        $user=User::create($formData);

        //login
        auth()->login($user);

        return redirect('/')->with('success', 'Welcome User '.$user->name);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Bye!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function post_login()
    {
        $formData=request()->validate([
            'email'=>['required','max:255',Rule::exists('users','email')],
            'password'=>['required','min:8',Rule::exists('users','password')]
        ],[
            'email.required'=>'Need to fill email',
            'password.min'=>'Password must be more than 8 characters'
        ]);

        if(auth()->attempt($formData)) {
            if(auth()->user()->is_admin){
                return redirect('/bensai/blogs');
            }else {
                return redirect('/')->with('success','Welcome Back!');
            }
        }else {
            return redirect()->back()->withErrors([
                'email'=>'User Credentials Wrong'
            ]);
        }

    }
}
