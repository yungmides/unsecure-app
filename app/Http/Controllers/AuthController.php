<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Mysql;

class AuthController extends Controller
{
  public function login(Request $request)
  {
      return view('auth.login');
  }

  public function logout(Request $request)
  {
      \Auth::logout();
      \Cookie::forget('id');
      return view('auth.login');
  }

  public function loginValidation(Request $request)
  {
    $mysql = new Mysql;

    $user = $mysql->select('users', '*', ['name' => $request->username]);


    if(isset($user[0]) && $user[0]['password'] === md5($request->password)){
      \Auth::loginUsingId($user[0]['id']);

      return redirect()->route('admin.index');
    }

    return back()->withErrors(['login' => 'Les identifiants fournis ne correspondent pas à nos données']);
  }
}
