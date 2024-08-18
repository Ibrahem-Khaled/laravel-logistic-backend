<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function profile()
    {
        $user = User::find(Auth::id());
        return view('Auth.proflie', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح.');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('proflie')->with('success', 'تم تسجيل الدخول بنجاح.');
        }
        return view('Auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        if (auth()->attempt($credentials, $remember)) {
            return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح.');
        } else {
            return redirect()->back()->with('error', 'تفاصيل تسجيل الدخول غير صحيحة. يرجى المحاولة مرة أخرى.');
        }
    }


    public function register()
    {
        if (Auth::check()) {
            return redirect('proflie')->with('success', 'تم تسجيل الدخول بنجاح.');
        }
        return view('Auth.register');
    }

    public function customRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('home')->with('success', 'Registration successful. You can now login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout successful.');
    }

    public function forgetPassword()
    {
        return view('Auth.forgetPassword');
    }
}
