<?php

namespace App\Http\Controllers;

use App\Fatura;
use App\FaturaTip;
use App\Site;
use Auth;
use Illuminate\Http\Request;

class FaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$faturalar = Fatura::all();
        $faturatips = FaturaTip::all();

        $site = Site::find(Auth::user()->site_id);

        $faturalar = Fatura::where('site_id','=',$site->id)->paginate(3);

        return view('superadmin.faturalar.index',['faturalar' => $faturalar,'faturatips'=>$faturatips]);
    }


    public function faturam()
    {
        //
        $faturalar = Fatura::all();

        return compact('faturalar');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('superadmin.faturalar.create',['fatura_adi'=>'']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createtip($id)
    {
        //
        $fatura = Fatura::where('fatura_tipi',$id)->get();
        
        return view('superadmin.faturalar.create',['fatura_adi'=>$fatura[0]->fatura_adi]);
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
            'fatura_adi' => 'required|string|max:255',
            'fatura_numarasi' => 'required|string|max:255',
            'fatura_tarih' => 'required|date',
            'fatura_tutar' => 'required',
            'fatura_ilkendeks' => 'required',
            'fatura_sonendeks' => 'required',
        ]);

        
        $site = Site::find(Aut::user()->site_id);
         
        $input = $request->only('fatura_adi', 'fatura_numarasi', 'fatura_tarih','fatura_tutar','fatura_detay','fatura_ilkendeks','fatura_sonendeks','fatura_durum');

        $input['site_id'] = $site->id;
        $fatura= Fatura::create($input);

        $faturalar = Fatura::paginate(3);

        $notification = array(
            'message' => 'Create successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('faturalar')->with($notification,$faturalar);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function show(Fatura $fatura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $fatura = Fatura::find($id);

        return view('superadmin.faturalar.edit',  ['fatura' => $fatura]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'fatura_adi' => 'required|string|max:255',
            'fatura_numarasi' => 'required|string|max:255',
            'fatura_tarih' => 'required|date',
            'fatura_tutar' => 'required'
        ]);

        

        $site = Site::find(Aut::user()->site_id);
         
        $input = $request->only('fatura_adi', 'fatura_numarasi', 'fatura_tarih','fatura_tutar','fatura_detay','fatura_ilkendeks','fatura_sonendeks','fatura_durum');

        $input['site_id'] = $site->id;
        
        $fatura = Fatura::find($id);
        $fatura->update($input);

        $faturalar = Fatura::paginate(3);

        $notification = array(
            'message' => 'Post updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('faturalar')->with($notification,$faturalar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fatura  $fatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Fatura::where('id', $id)->delete();

        $faturalar = Fatura::paginate(3);
        
        $notification = array(
            'message' => 'Deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('faturalar')->with($notification,$faturalar);

    }
}
