<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request)
    {
      

        $validatedData=$request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users',
            'email' => ['required', 'string', Rule::unique('users')],
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,customer,staff',

        ]);  
        // dd($request->input('role')); 


        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make( $validatedData['password']),
            'role' =>  $validatedData['role'], // Lưu vai trò
        ]);
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);



        return redirect('/login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
}
