<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\Sex;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // original
     //protected $redirectTo = RouteServiceProvider::HOME;

    // updated to support different user roles. from video
        protected $redirectTo = '/triathlon-details';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   /* original
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);//*/
        return Validator::make($data, [
           'first_name' => ['required', 'string', 'max:50' ],
           'last_name' =>  ['required', 'string', 'max:50' ],
           'dob' =>        ['required', 'string', 'max:191'],
           'sex' =>        ['required', 'string', 'max:1', new Sex  ],
           'email' =>      ['required', 'string', 'email', 'max:255', 'unique:users'],
           'password' =>   ['required', 'string', 'min:8', 'confirmed'],
           
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   /* original
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);//*/
            // attempt to add user roles. following video instructions
       
       
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'dob'        => $data['dob'],
            'sex'        => $data['sex'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
        ]);
        $user->attachRole('user'); // user or administrator or superadministrator or role_name?
        return $user;

    }
}
