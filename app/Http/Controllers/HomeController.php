<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Alert;
use Auth;
use DB;
use App\Fatura;
use App\Site;
use App\Gelir;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        //return view('layouts.dd');
        if (Auth::check()) {

            return view('superadmin.superadmin');
        }else{
            $sites = Site::all();
            return view('welcome',['sites' => $sites]);
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $faturalar = Fatura::all();
        $gelirler = DB::table('gelirs')
                ->select('gelir_adi', DB::raw('SUM(gelir_miktar) as total_gelir'))
                ->groupBy('gelir_adi','site_id')
                ->get();
        $gelirlers = DB::table('gelirs')
                ->select('site_id', DB::raw('SUM(gelir_miktar) as total_gelir'))
                ->groupBy('site_id')
                ->get();
        //return view('layouts.dd');
        return compact('faturalar','gelirler','gelirlers');

    }

    /**
     * Change the application language
     *
     * @return
     *
    */
    public function lang($locale)
    {
        App::setLocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();
    }
}
