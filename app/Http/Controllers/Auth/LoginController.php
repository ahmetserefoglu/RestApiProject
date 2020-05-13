<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Alert;
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
     protected $redirectTo;

    public function redirectTo()
    {
        switch(Auth::user()->rolename){
            case 'Admin':
            $this->redirectTo = '/admin';
            return $this->redirectTo;
                break;
            case 'SuperAdmin':
                    $this->redirectTo = '/superadmin';
                return $this->redirectTo;
                break;
            case 'User':
                $this->redirectTo = '/user';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/';
                return $this->redirectTo;
        }
         
        // return $next($request);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email'))){
            return ['phonenumber'=>$request->get('email'),'password'=>$request->get('password')];
        }

        return $request->only($this->username(), 'password');
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            Alert::warning('Hesabınızı onaylamanız gerekir. Size bir aktivasyon kodu gönderdik, lütfen e-postanızı kontrol edin.');
            return back()->with('warning', 'Hesabınızı onaylamanız gerekir. Size bir aktivasyon kodu gönderdik, lütfen e-postanızı kontrol edin.');
        }

        Alert::message('Hoş geldiniz');
        
        //return redirect('user');
    }
}
