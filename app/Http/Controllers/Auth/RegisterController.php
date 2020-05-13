<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyMail;
use App\User;
use App\VerifyUser;
use Mail;
use Alert;
use App\SmsVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Twilio\Jwt\ClientToken;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

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
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('guest');
    }*/

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phonenumber' => 'required|string|unique:users',
            'sitename' => 'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phonenumber' => $data['phonenumber'],
            'sitename' => $data['sitename'],
            'password' => bcrypt($data['password']),
            'verified' => 0,
            'token' => str_random(40),
            'rolename' => 'User'
        ]);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        $datax = ['ad' => $user->name, 'mail' => $user->email,'token'=>$user->verifyUser->token,'contact_number'=>$user->phonenumber];
       
      $email=$user->email;
      Mail::send('emails', $datax, function($message) use ($email) {
         $message->to($email, 'SİteYonetimPaneli')->subject
            ('SİteYonetimPaneli');
         $message->from('ahmet@ahmetserefoglu.com','SiteYonetimi');
      });
      
      /*$code = rand(1000, 9999);

        $verifyUser = SmsVerification::create([
            'code' => $code,
            'contact_number'=>$user->phone_number
        ]);


        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $smsverification=SmsVerification::orderBy('created_at', 'asc')->get();
        try
        {
            $client = new Client(['auth' => [$accountSid, $authToken]]);
            $result = $client->post('https://api.twilio.com/2010-04-01/Accounts/AC037e3b3a9f8743ee90adb2283e7c8402/Messages.json',
                [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'form_params' => [
         'Body' => 'CODE: '. $code, //set message body
         'To' => '+9'.$user->phone_number,
         'From' => '+13344599247' //we get this number from twilio
        ]]);
            //$result[0]
            //$mesaj="Mesaj Başarıyla Gönderildi";
            

            //return redirect()->intended('sendsms')->with('success',$mesaj ,'smsverification' ,$smsverification);
        }
        catch (Exception $e)
        {
            $mesaj= "Error: " . $e->getMessage();
            //return redirect()->intended('sendsms')->with('success',$mesaj ,'smsverification' ,$smsverification);
        }*/

      Alert::success('E-mail adresinize gelen maili kontrol ediniz.');

        return $user;
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->email_verified_at = now();
                $verifyUser->user->save();

                $status = "E-mail adresiniz onaylandı.Giriş Yapabilirsiniz.";
            }else{
                $status = "E-mail adresiniz onaylanmadı.Destek Birimimizle Iletişime Geçiniz.";
            }
        }else{
            Alert::warning('E-mail adresinize gelen maili kontrol ediniz.');
            return redirect('/login')->with('warning', "Malesef e-posta adresiniz tanımlanmıyor.");
        }
        Alert::success($status);
        return redirect('/')->with('status', $status);
    }

    protected function registered(Request $request, $user)
    {
        //$this->guard()->logout();
        Alert::success('Size bir aktivasyon kodu gönderdik. E-postanızı kontrol edin ve doğrulamak için bağlantıya tıklayın.');
        return redirect('/')->with('status', 'Size bir aktivasyon kodu gönderdik. E-postanızı kontrol edin ve doğrulamak için bağlantıya tıklayın.');
        //return redirect('verifyphone')->with(['contact_number'=>$user->phone_number,'token'=>$user->verifyUser->token]);;
    }
}
