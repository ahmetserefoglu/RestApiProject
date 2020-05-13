<?php

namespace App\Http\Controllers;

use App\SiteSakinleri;
use App\Site;
use App\SiteBlok;
use Auth;
use Illuminate\Http\Request;

class SiteSakinleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sitesakinleri = SiteSakinleri::all();
        $siteblok = SiteBlok::where('site_id','=',Auth::user()->site_id)->get();

        return view('superadmin.sitesakinleri.index',['siteSakinleri' => $sitesakinleri,'sitebloks'=>$siteblok]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createsitesakin($id)
    {
        //
        //$siteblok = SiteBlok::find($id);
        //['siteblok'=>$siteblok]
        return view('superadmin.sitesakinleri.create');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteSakinleri  $siteSakinleri
     * @return \Illuminate\Http\Response
     */
    public function show(SiteSakinleri $siteSakinleri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteSakinleri  $siteSakinleri
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSakinleri $siteSakinleri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteSakinleri  $siteSakinleri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteSakinleri $siteSakinleri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteSakinleri  $siteSakinleri
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSakinleri $siteSakinleri)
    {
        //
    }
}
