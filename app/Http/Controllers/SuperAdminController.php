<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SuperAdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $orders = DB::table('gelirs')
                ->select('site_id', DB::raw('SUM(gelir_miktar) as total_gelir'))
                ->groupBy('site_id')
                ->get();
        $faturas = DB::table('faturas')
                ->select('site_id', DB::raw('SUM(fatura_tutar) as total_gelir'))
                ->groupBy('site_id')
                ->get();                

        return view('superadmin.superadmin',['orders' => $orders,'faturas' => $faturas]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /**public function faturalar()
    {
        return view('superadmin.faturalar.index');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('superadmin.profile.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deneme()
    {
        return view('superadmin.gelirgider.aidat');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function gelirgider()
    {
        return view('superadmin.gelirgider.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function odemeler()
    {
        return view('superadmin.odemeler.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function arizabildirim()
    {
        return view('superadmin.arizabildirim.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function raporlama()
    {
       
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function siparis()
    {
        return view('superadmin.siparis.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function aracplakakayit()
    {
        return view('superadmin.aracplaka.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /*public function siteyonetim()
    {
        return view('superadmin.siteyonetim.index');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kullanicilar()
    {
        return view('superadmin.kullaniciayarlari.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ayarlarim()
    {
        return view('superadmin.ayarlar.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sosyal()
    {
        return view('superadmin.sosyal.index');
    }

}
