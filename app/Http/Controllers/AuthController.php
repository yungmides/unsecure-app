<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
  public function login(Request $request)
  {
      return view('auth.login');
  }

  public function logout(Request $request)
  {
      Auth::logout();
//      Cookie::forget('id');
//      CookieJar::forget('id');
      if (isset($_COOKIE['id'])) {
          unset($_COOKIE['id']);
          setcookie('id', '', time() - 3600, '/');
      }
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      return redirect('/');
//      return view('auth.login');
  }

  public function loginValidation(Request $request)
  {
      $userdb = DB::table('users')->where('name','=', $request->username)->get()->toArray();
      if(isset($userdb[0]) && password_verify($request->password, $userdb[0]->password)){
          Auth::loginUsingId($userdb[0]->id);
          return redirect()->route('admin.index')->withCookie(cookie('id', $userdb[0]->id, 2628000));
      }
      return back()->withErrors(['login' => 'Les identifiants fournis ne correspondent pas à nos données']);
  }
}
