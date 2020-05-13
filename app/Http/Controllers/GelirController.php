<?php

namespace App\Http\Controllers;

use App\Gelir;
use App\Site;
use App\SiteBlok;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class GelirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gelirs = Gelir::paginate(3);
        $sitebloks = SiteBlok::all();
        $orders = DB::table('gelirs')
                ->select('gelir_adi', DB::raw('SUM(gelir_miktar) as total_gelir'))
                ->groupBy('gelir_adi','site_id')
                ->get();
        return view('superadmin.gelirgider.index',['gelirs' => $gelirs,'sitebloks' => $sitebloks,'orders' => $orders]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::where('site_id','=',Auth::user()->site_id)->get();

        return view('superadmin.gelirgider.create',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aidat()
    {
        //
        //$siteblok = SiteBlok::find($id);
        //['siteblok'=>$siteblok]
        $users = User::where('site_id','=',Auth::user()->site_id)->get();

        return view('superadmin.gelirgider.aidat',['users' => $users]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createblok($id)
    {
        //
        //$siteblok = SiteBlok::find($id);
        //['siteblok'=>$siteblok]
        return view('superadmin.gelirgider.create');
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
            'gelir_adi' => 'required|string|max:255',
            'gelir_kisi' => 'required|string|max:255',
            'gelir_tarih' => 'required|date',
            'gelir_miktar' => 'required',
        ]);

        
        $site = Site::find(Auth::user()->site_id);
         
        $input = $request->only('gelir_adi', 'gelir_kisi', 'gelir_tarih','gelir_miktar');

        $input['site_id'] = $site->id;
        $gelir= Gelir::create($input);

        $gelirs = Gelir::paginate(3);

        $notification = array(
            'message' => 'Create successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('gelir')->with($notification,$gelirs);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gelir  $gelir
     * @return \Illuminate\Http\Response
     */
    public function show(Gelir $gelir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gelir  $gelir
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $gelir = Gelir::find($id);
        $users = User::where('site_id','=',Auth::user()->site_id)->get();

        return view('superadmin.gelirgider.edit',  ['gelir' => $gelir,'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gelir  $gelir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'gelir_adi' => 'required|string|max:255',
            'gelir_kisi' => 'required|string|max:255',
            'gelir_tarih' => 'required|date',
            'gelir_miktar' => 'required',
        ]);

        
        $site = Site::find(Auth::user()->site_id);
         
        $input = $request->only('gelir_adi', 'gelir_kisi', 'gelir_tarih','gelir_miktar');

        $input['site_id'] = $site->id;
        
        $gelir= Gelir::find($id);
        $gelir->updat($input);

        $gelirs = Gelir::paginate(3);

        $notification = array(
            'message' => 'Updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('gelir')->with($notification,$gelirs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gelir  $gelir
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Gelir::where('id', $id)->delete();

        $gelirs = Gelir::paginate(3);
        
        $notification = array(
            'message' => 'Deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('gelir')->with($notification,$gelirs);
    }
}
