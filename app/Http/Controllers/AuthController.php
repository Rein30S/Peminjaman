<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Import Log facade

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function registerPost(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'alamat' => 'required|string|max:255',
            'nomor_telepon' => ['required', 'string', 'max:20', 'regex:/^62/'],
            'email' => 'required|string|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->nama_lengkap = $validatedData['nama_lengkap'];
        $user->jenis_kelamin = $validatedData['jenis_kelamin'];
        $user->tanggal_lahir = $validatedData['tanggal_lahir'];
        $user->alamat_rumah = $validatedData['alamat'];
        $user->nomor_telepon = $validatedData['nomor_telepon'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->level = 'user'; 
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            Log::info('User logged in:', ['id' => $user->id, 'email' => $user->email, 'level' => $user->level]);
            if ($user->level === 'Admin') {
                return redirect()->route('index_admin')->with('success', 'Login berhasil');
            } else if ($user->level === 'User')  {
                return redirect()->route('index_user')->with('success', 'Login berhasil');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}