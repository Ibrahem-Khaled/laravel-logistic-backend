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
            return redirect()->route('profile')->with('success', 'تم تسجيل الدخول بنجاح.');
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
            if (auth()->user()->role == 'admin') {
                return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح.');
            } else {
                $this->logout();
                return redirect()->back()->with('error', 'تفاصيل تسجيل الدخول غير صحيحة. يرجى المحاولة مرة أخرى.');
            }
        } else {
            return redirect()->back()->with('error', 'تفاصيل تسجيل الدخول غير صحيحة. يرجى المحاولة مرة أخرى.');
        }
    }


    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح.');
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

        return redirect()->back()->with('success', 'تم انشاء حسابك بنجاح');
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

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return redirect()->back()->with('success', 'Password reset link sent to your email.');
    }
}
