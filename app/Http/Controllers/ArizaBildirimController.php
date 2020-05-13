<?php

namespace App\Http\Controllers;

use App\ArizaBildirim;
use Auth;
use App\Site;
use App\SiteBloks;
use Illuminate\Http\Request;

class ArizaBildirimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $arizabildirim = ArizaBildirim::where('site_id','=',Auth::user()->site_id)->get();

        return view('superadmin.arizabildirim.index',['arizalar' => $arizabildirim]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('superadmin.arizabildirim.create');
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
            'ariza_konu' => 'required|string|max:255',
            'ariza_detay' => 'required|string|max:255',
            'ariza_durumu' => 'required',
        ]);

        
        $site = Site::find(Auth::user()->site_id);
         
        $input = $request->only('ariza_konu', 'ariza_detay', 'ariza_durumu');

        $input['site_id'] = $site->id;
        $input['ariza_kayit_kisi'] = Auth::user()->name;
        $ariza= ArizaBildirim::create($input);

        $arizalar = ArizaBildirim::where('site_id','=',Auth::user()->site_id)->get();

        $notification = array(
            'message' => 'Create successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('arizabildirim')->with($notification,$arizalar);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArizaBildirim  $arizaBildirim
     * @return \Illuminate\Http\Response
     */
    public function show(ArizaBildirim $arizaBildirim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArizaBildirim  $arizaBildirim
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $arizabildirim = ArizaBildirim::find($id);

        return view('superadmin.arizabildirim.edit',['ariza' => $arizabildirim ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArizaBildirim  $arizaBildirim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'ariza_konu' => 'required|string|max:255',
            'ariza_detay' => 'required|string|max:255',
            'ariza_durumu' => 'required',
            'ariza_onay' => 'required',
        ]);

        
        $site = Site::find(Auth::user()->site_id);
         
        $input = $request->only('ariza_konu', 'ariza_detay', 'ariza_durumu','ariza_onay');

        $input['site_id'] = $site->id;
        $input['ariza_kayit_kisi'] = Auth::user()->name;
        $input['ariza_kayiteden'] = Auth::user()->name;

        $arizabildirim = ArizaBildirim::find($id);
        $arizabildirim->update($input);

        $arizalar = ArizaBildirim::where('site_id','=',Auth::user()->site_id)->get();

        $notification = array(
            'message' => 'Post updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('arizabildirim')->with($notification,$arizalar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArizaBildirim  $arizaBildirim
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArizaBildirim $arizaBildirim)
    {
        //
    }
}
