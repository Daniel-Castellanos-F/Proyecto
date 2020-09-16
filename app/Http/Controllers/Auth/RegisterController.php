<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Traits\ValidateAndCreateUser;

class RegisterController extends Controller
{
   
    use RegistersUsers;
    use ValidateAndCreateUser;

    protected $redirectTo = '/home';
   
    public function __construct()
    {
        $this->middleware('guest');
    }
 
}
