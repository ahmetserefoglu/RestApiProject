<?php

namespace App\Http\Controllers;

use App\Degerlendirme;
use DB;
use Illuminate\Http\Request;

class DegerlendirmeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $degerlendirmeler = Degerlendirme::paginate(3);
            $degerlendirmelersx = DB::table('degerlendirmes')
                ->select('degerlendirme_konu', DB::raw('AVG(degerlendirme_derece) as total_derece'))
                ->groupBy('degerlendirme_konu')
                ->get();
                
        return view('superadmin.degerlendirme.index',['degerlendirmeler' => $degerlendirmeler,'degerlendirmelersx' => $degerlendirmelersx]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('superadmin.degerlendirme.create');
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
         request()->validate([
            'degerlendirme_konu' => 'required',
            'degerlendirme_derece' => 'required'
        ]);

        $input = $request->only('degerlendirme_konu', 'degerlendirme_derece');

        $input['degerlendiren_kullanici'] = auth()->user()->name;
        $degerlendirme= Degerlendirme::create($input);

        $rating = new \willvincent\Rateable\Rating;

        $rating->rating = $request->degerlendirme_derece;

        $rating->user_id = auth()->user()->id;

        $degerlendirme->ratings()->save($rating);

        $degerlendirmeler = Degerlendirme::all();

         $notification = array(
            'message' => 'Rated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('degerlendirme')->with($notification,$degerlendirmeler);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Degerlendirme  $degerlendirme
     * @return \Illuminate\Http\Response
     */
    public function show(Degerlendirme $degerlendirme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Degerlendirme  $degerlendirme
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $degerlendirme = Degerlendirme::find($id);

        return view('superadmin.degerlendirme.edit',  ['degerlendirme' => $degerlendirme]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Degerlendirme  $degerlendirme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        request()->validate([
            'degerlendirme_konu' => 'required',
            'degerlendirme_derece' => 'required'
        ]);

        $input = $request->only('degerlendirme_konu', 'degerlendirme_derece');

        $input['degerlendiren_kullanici'] = auth()->user()->name;
        $degerlendirme= Degerlendirme::find($id);
        $degerlendirme->update($input);

        $rating = new \willvincent\Rateable\Rating;

        $rating->rating = $request->degerlendirme_derece;

        $rating->user_id = auth()->user()->id;

        $degerlendirme->ratings()->save($rating);

        $degerlendirmeler = Degerlendirme::paginate(3);

         $notification = array(
            'message' => 'Rated updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('degerlendirme')->with($notification,$degerlendirmeler);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Degerlendirme  $degerlendirme
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Degerlendirme::where('id', $id)->delete();

        $degerlendirmeler = Degerlendirme::paginate(3);
        
        $notification = array(
            'message' => 'Deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended('degerlendirme')->with($notification,$degerlendirmeler);
    }
}
