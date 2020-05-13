<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Site;
use App\SiteBlok;
use App\VerifyUser;
use Alert;
use Mail;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function user()
    {
        return view('user.user');
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
    	return view('superadmin.kullaniciayarlari.index', ['users' => $model->orderBy('id', 'desc')->paginate(10)]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        $sites = Site::all();

    	return view('superadmin.kullaniciayarlari.create',['roles' => $roles,'sites' => $sites]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteBlok  $siteBlok
     * @return \Illuminate\Http\Response
     */
    public function siteblok($id)
    {
        //

        $siteblok = SiteBlok::where('site_id','=',$id)->get();

        return compact('siteblok');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'phonenumber' => 'required|string',
            'site_id' => 'required',
            'blok_id' => 'required',
            'evsahibimi' => 'required',
        ]);

        
        $input = $request->only('name', 'email', 'password','rolename','phonenumber','site_id','blok_id','evsahibimi');

        $input['password'] = Hash::make($input['password']);
        $input['token']=str_random(60);
        $input['verified'] = 1;

        $user= User::create($input);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        $users = User::all();
        $site = Site::find(request('site_id'));
        $blok = SiteBlok::find(request('blok_id'));
        

         $datax = ['ad' => $user->name, 'mail' => $user->email,'contact_number'=>$user->phonenumber,'sifre' => request('password'), 'site' => $site->site_adi ,'blok' => $blok->blok_adi ];
       
          $email=$user->email;
          Mail::send('emailskayit', $datax, function($message) use ($email) {
             $message->to($email, 'SİteYonetimPaneli')->subject
                ('SİteYonetimPaneli');
             $message->from('ahmet@ahmetserefoglu.com','SiteYonetimi');
          });

          $notification = array(
            'message' => 'Created successfully sending information your email!',
            'alert-type' => 'success'
        );

        return redirect()->intended('kullanicilar')->with($notification,$users);
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
    	/*if ($user->id == 1) {
    		return redirect()->route('user.index');
    	}*/
        $user = User::find($id);
        $roles = Role::all();
        $sites = Site::all();
        $bloks = SiteBlok::where('site_id','=' ,$user->site_id)->get();

    	return view('superadmin.kullaniciayarlari.edit',  ['user' => $user,'roles' => $roles,'sites' => $sites,'bloks' => $bloks]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $users = User::find($id);
        $roles = Role::all();

        return compact('users','roles');
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
    	 $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phonenumber' => 'required|string',
            'site_id' => 'required',
            'blok_id' => 'required',
            'evsahibimi' => 'required',
        ]);

        

        $input = $request->only('name', 'email', 'password','rolename','phonenumber','site_id','blok_id','evsahibimi');

  
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
            $input['token']=str_random(60);
            $input['verified'] = 1;
        }else{
            $input = array_except($input,array('password')); //remove password from the input array
        }

        $user = User::find($id);
        $user->update($input);

        $users = User::all();
        $site = Site::find(request('site_id'));
        $blok = SiteBlok::find(request('blok_id'));
        
         $datax = ['ad' => $user->name, 'mail' => $user->email,'contact_number'=>$user->phonenumber,'sifre' => $input['password'], 'site' => $site->site_adi ,'blok' => $blok->blok_adi ];
       
          $email=$user->email;
          Mail::send('emailskayit', $datax, function($message) use ($email) {
             $message->to($email, 'SİteYonetimPaneli')->subject
                ('SİteYonetimPaneli');
             $message->from('ahmet@ahmetserefoglu.com','SiteYonetimi');
          });

        $notification = array(
            'message' => 'Post updated successfully and sending information your email!',
            'alert-type' => 'success'
        );

    	return redirect()->intended('kullanicilar')->with($notification,$users);
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
    	User::find($id)->delete();

    	return redirect()->intended('kullanicilar')->with('success','Başarıyla Kaydedildi','user',$users);
    }
}
