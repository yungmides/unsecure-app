<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cookie;

class Auth
{
  public static function connected(){
    return Cookie::has('id');
  }

}
