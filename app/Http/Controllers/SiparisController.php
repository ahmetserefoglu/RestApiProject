<?php

namespace App\Http\Controllers;

use App\Siparis;
use App\User;
use Auth;
use DB;
use Excel;
use PDF;
use File;
use App\Site;
use App\SiteBloks;
use Illuminate\Http\Request;

class SiparisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $siparisler = Siparis::paginate(3);

        return view('superadmin.siparis.index',['siparisler' => $siparisler]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importsiparis(Request $request)
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
                            $insert[] = ['siparis_konu' => $value->sipariskonu,'siparis_detay' => $value->siparisdetay, 'siparis_isteyen_kisi' => $value->kisi,'siparis_tarihi' => date_format($value->tarih, 'Y-m-d')
                            ];
                        

                    }


                    if(!empty($insert))
                    {
                        DB::table('siparis')->insert($insert);
                        if ($insert) {

                            $notification = array(
                                'message' => 'İmport successfully!',
                                'alert-type' => 'success'
                            ); 

                            $siparisler = Siparis::paginate(3);

                            return redirect()->intended('siparis')->with($notification,$siparisler);
                        }else {                        
                            $notification = array(
                                'message' => 'İmport not successfully!',
                                'alert-type' => 'error'
                            ); 
                            
                            $siparisler = Siparis::paginate(3);

                            return redirect()->intended('siparis')->with($notification,$siparisler);
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
        $users = User::where('site_id','=',Auth::user()->site_id)->get();

        return view('superadmin.siparis.create',['users' => $users]);
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
            'siparis_konu' => 'required|string|max:255',
            'siparis_detay' => 'required|string|max:255',
            'siparis_isteyen_kisi' => 'required|string|max:255',
            'siparis_tarihi' => 'required|date'
        ]);

        $input = $request->only('siparis_konu', 'siparis_detay','siparis_isteyen_kisi','siparis_tarihi');

        $siparis= Siparis::create($input);

        $siparisler = Siparis::paginate(3);

        $notification = array(
            'message' => 'Create successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('siparis')->with($notification,$siparisler);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siparis  $siparis
     * @return \Illuminate\Http\Response
     */
    public function show(Siparis $siparis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siparis  $siparis
     * @return \Illuminate\Http\Response
     */
    public function edit(Siparis $siparis)
    {
        //
         $siparis = Siparis::find($id);

        return view('superadmin.siparis.edit',['siparis' => $siparis]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siparis  $siparis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siparis $siparis)
    {
        //
        $this->validate($request, [
            'siparis_konu' => 'required|string|max:255',
            'siparis_detay' => 'required|string|max:255',
            'siparis_isteyen_kisi' => 'required|string|max:255',
            'siparis_tarihi' => 'required|date'
        ]);


        $input = $request->only('siparis_konu', 'siparis_detay','siparis_isteyen_kisi','siparis_tarihi');

        $siparis = Siparis::find($id);
        $siparis->update($input);

        $aracplakalari = Siparis::paginate(3);

        $notification = array(
            'message' => 'Post updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('siparis')->with($notification,$arizalar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siparis  $siparis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siparis $siparis)
    {
        //
        Siparis::where('id', $id)->delete();

        $siparisler = Siparis::paginate(3);
        
        $notification = array(
            'message' => 'Deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('aracplaka')->with($notification,$siparisler);
    }
}
