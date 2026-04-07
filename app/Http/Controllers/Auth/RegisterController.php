<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nis'      => ['required', 'string', 'max:20', 'unique:users'],
            'kelas'    => ['required', 'string', 'max:50'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'nis'       => $data['nis'],
            'kelas'     => $data['kelas'],
            'password'  => Hash::make($data['password']),
            'role'      => 'murid',
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect()->route('student.dashboard')->with('success', 'Registrasi berhasil. Selamat datang di Perpustakaan Digital!');
    }
}
