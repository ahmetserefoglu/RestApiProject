<?php

namespace App\Http\Controllers;

use App\AracPlaka;
use Auth;
use DB;
use Excel;
use PDF;
use File;
use App\Site;
use App\SiteBloks;
use Illuminate\Http\Request;

class AracPlakaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aracplakalari = AracPlaka::where('site_id','=',Auth::user()->site_id)->get();

        return view('superadmin.aracplaka.index',['aracplakalari' => $aracplakalari]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importarac(Request $request)
    {
            //validate the xls file
            $this->validate($request, array(
                'file'      => 'required'
            ));

            if($request->hasFile('file')){
                $extension = File::extension($request->file->getClientOriginalName());
                if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") 
                {
                    $path =  $request->file->getRealPath();
                    $data = Excel::load($path, function($reader) {
                    })->get();


                    if(!empty($data) && $data->count()){

                        foreach ($data as $key => $value) {
                            $insert[] = ['arac_sahibi' => $value->aracsahibi,'arac_plaka' => $value->aracplaka, 'site_id' => $value->site,'blok_id' => $value->blok,'kayit_eden' => Auth::user()->name
                            ];                    
                    }


                    if(!empty($insert))
                    {
                        DB::table('arac_plakas')->insert($insert);
                        if ($insert) {

                            $notification = array(
                                'message' => 'İmport successfully!',
                                'alert-type' => 'success'
                            ); 

                            $aracplakalari = AracPlaka::where('site_id','=',Auth::user()->site_id)->get();

                            return redirect()->intended('aracplaka')->with($notification,$aracplakalari);
                        }else {                        
                            $notification = array(
                                'message' => 'İmport not successfully!',
                                'alert-type' => 'error'
                            ); 
                            
                            $aracplakalari = AracPlaka::where('site_id','=',Auth::user()->site_id)->get();

                            return redirect()->intended('aracplaka')->with($notification,$aracplakalari);
                        }

                    }
                }

                return redirect()->back();
            }else{
                $notification = array(
                                'message' => 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!',
                                'alert-type' => 'error'
                            ); 
                return redirect()->back();
            }

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('superadmin.aracplaka.create');
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
            'arac_sahibi' => 'required|string|max:255',
            'arac_plaka' => 'required|string|max:255'
        ]);

        
        $site = Site::find(Auth::user()->site_id);
         
        $input = $request->only('arac_sahibi', 'arac_plaka');

        $input['site_id'] = $site->id;
        $input['blok_id'] = $site->id;
        $input['kayit_eden'] = Auth::user()->name;
        $ariza= AracPlaka::create($input);

        $aracplakalari = AracPlaka::where('site_id','=',Auth::user()->site_id)->get();

        $notification = array(
            'message' => 'Create successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('aracplaka')->with($notification,$aracplakalari);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AracPlaka  $aracPlaka
     * @return \Illuminate\Http\Response
     */
    public function show(AracPlaka $aracPlaka)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AracPlaka  $aracPlaka
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $aracplaka = AracPlaka::find($id);

        return view('superadmin.aracplaka.edit',['aracplaka' => $aracplaka ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AracPlaka  $aracPlaka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'arac_sahibi' => 'required|string|max:255',
            'arac_plaka' => 'required|string|max:255'
        ]);

        
        $site = Site::find(Auth::user()->site_id);
         
        $input = $request->only('arac_sahibi', 'arac_plaka');

        $input['site_id'] = $site->id;
        $input['blok_id'] = $site->id;
        $input['kayit_eden'] = Auth::user()->name;

        $arizabildirim = AracPlaka::find($id);
        $arizabildirim->update($input);
        $aracplakalari = AracPlaka::where('site_id','=',Auth::user()->site_id)->get();

        $notification = array(
            'message' => 'Post updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('aracplaka')->with($notification,$arizalar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AracPlaka  $aracPlaka
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        AracPlaka::where('id', $id)->delete();

        $aracplakalari = AracPlaka::all();
        
        $notification = array(
            'message' => 'Deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('aracplaka')->with($notification,$aracplakalari);
    }
}
