<?php

namespace App\Http\Controllers;

use App\Site;
use App\User;
use App\SiteBlok;
use Auth;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('superadmin.site.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'site_adi' => 'required|string|max:255',
            'site_yonetici_adi' => 'required|string|max:255',
            'aidat' => 'required|float'
        ]);

        
        $input = $request->only('site_adi', 'site_yonetici_adi','aidat');


        $site= Site::create($input);

        $site_id = Auth::user()->site_id;

        $sites = Site::find($site_id);

        $notification = array(
            'message' => 'Create successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('siteyonetim')->with($notification,$sites);

    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $site = Site::find($id);

        return view('superadmin.site.edit',  ['site' => $site]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'site_adi' => 'required|string|max:255',
            'site_yonetici_adi' => 'required|string|max:255'
        ]);

        $siteid = Auth::user()->site_id;

        $input = $request->only('site_adi', 'site_yonetici_adi');

        $site = Site::find($id);
        $site->update($input);

        $rsiteadi = request('site_adi');

        /*$user = User::where('site_id','=',$siteid)->get();


        foreach ($user as  $value) {
             $userx = User::find($value['id']); 
             $userx->siteid = $id; 
             $userx->save(); 
        }*/

      

        $sites = Site::find($siteid);


        $notification = array(
            'message' => 'Post updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('siteyonetim')->with($notification,$sites);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Site::where('id', $id)->delete();

        $siteid = Auth::user()->site_id;

        $sites = Site::find($siteid);

        
        $notification = array(
            'message' => 'Deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('siteyonetim')->with($notification,$sites[0]);
    }
}
