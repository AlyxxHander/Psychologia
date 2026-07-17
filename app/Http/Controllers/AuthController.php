<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  /**
   * << Authtentication Function >>
   * 
   * --------------------------------
   * @method showLogin
   * @method login
   * @method logout
   * --------------------------------
   */ 
  public function showLogin()
  {
    if (Auth::check()) {
      return redirect()->route('admin.dashboard');
    }
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => [
        'required',
        'email',
      ],
      'password' => ['required', 'string'],
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->with('toast_error', 'Email atau password salah')
        ->withInput();
    }

    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();
      
      return redirect()
        ->intended(route('admin.dashboard'))
        ->with('toast_success', 'Selamat datang kembali, ' . Auth::user()->position_id . '!');
    }

    return back()->withErrors([
      'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
    ])->with('toast_error', 'Email atau password salah.')->onlyInput('email');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()
      ->route('login')
      ->with('toast_success', 'Anda telah berhasil logout.');
  }
}
