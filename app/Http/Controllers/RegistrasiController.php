<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function index(){
        return view('auth.registrasi');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required||min:5|max:50',
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login');
    }
}
