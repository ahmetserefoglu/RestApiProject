<?php

namespace App\Http\Controllers;

use App\SiteBlok;
use App\Site;
use Auth;
use Illuminate\Http\Request;

class SiteBlokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $siteid = Auth::user()->site_id;

        $site = Site::find($siteid);


        return view('superadmin.siteyonetim.index',['sites' => $site]); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('superadmin.siteyonetim.create'); 
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
            'blok_adi' => 'required|string|max:255',
            'daire_sayisi' => 'required|integer'
        ]);

        

        $input = $request->only('blok_adi', 'daire_sayisi');

        $siteid = Auth::user()->site_id;

        $sites = Site::find($siteid);

        $input['site_id'] = $siteid;

        $siteblok= SiteBlok::create($input);

        $notification = array(
            'message' => 'Create successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('siteyonetim')->with($notification,$sites);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteBlok  $siteBlok
     * @return \Illuminate\Http\Response
     */
    public function show(SiteBlok $siteBlok)
    {
        //
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteBlok  $siteBlok
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $siteblok = SiteBlok::find($id);

        return view('superadmin.siteyonetim.edit',  ['siteblok' => $siteblok]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteBlok  $siteBlok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'blok_adi' => 'required|string|max:255',
            'daire_sayisi' => 'required|integer'
        ]);

        
        $input = $request->only('blok_adi', 'daire_sayisi');


        $siteid = Auth::user()->site_id;

        $sites = Site::find($siteid);

        $input['site_id'] = $siteid;

        $site = SiteBlok::find($id);
        $site->update($input);

        $notification = array(
            'message' => 'Post updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('siteyonetim')->with($notification,$sites);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteBlok  $siteBlok
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        SiteBlok::where('id', $id)->delete();

        $siteid = Auth::user()->site_id;

        $sites = Site::find($siteid);

        
        $notification = array(
            'message' => 'Deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('siteyonetim')->with($notification,$sites);
    }
}
