<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }


    // Override the username method from AuthenticatesUsers trait to modify login process
    public function username()
    {
        $user_identifier = request()->input('telephone');

        $field = filter_var($user_identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'telephone';

        request()->merge([$field => $user_identifier]);

        return $field;
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('user/login');
      }
}
