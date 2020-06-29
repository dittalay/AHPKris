<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;
use App\Property;
use App\Service;
use App\Slider;
use App\Post;

class FrontpageController extends Controller
{
    
    public function index()
    {
        $sliders        = Slider::latest()->get();
        $properties     = Property::all();
        $services       = Service::orderBy('service_order')->get();
        $testimonials   = Testimonial::latest()->get();

        return view('frontend.index', compact('sliders','properties','services','testimonials'));
    }


    public function search(Request $request)
    {
        $kota     = strtolower($request->kota);
        $desain     = $request->desain;
        $kategori  = $request->kategori;
        $kamar_tidur  = $request->kamar_tidur;
        $kamar_mandi = $request->kamar_mandi;
        $minharga_rumah = $request->minharga_rumah;
        $maxharga_rumah = $request->maxharga_rumah;
        $minjumlah_lantai  = $request->minjumlah_lantai;
        $maxjumlah_lantai  = $request->maxjumlah_lantai;
        $featured = $request->featured;

        $properties = Property::latest()->withCount('comments')
                                ->when($kota, function ($query, $kota) {
                                    return $query->where('kota', '=', $kota);
                                })
                                ->when($desain, function ($query, $desain) {
                                    return $query->where('desain', '=', $desain);
                                })
                                ->when($kategori, function ($query, $kategori) {
                                    return $query->where('kategori', '=', $kategori);
                                })
                                ->when($kamar_tidur, function ($query, $kamar_tidur) {
                                    return $query->where('kamar_tidur', '=', $kamar_tidur);
                                })
                                ->when($kamar_mandi, function ($query, $kamar_mandi) {
                                    return $query->where('kamar_mandi', '=', $kamar_mandi);
                                })
                                ->when($minharga_rumah, function ($query, $minharga_rumah) {
                                    return $query->where('harga_rumah', '>=', $minharga_rumah);
                                })
                                ->when($maxharga_rumah, function ($query, $maxharga_rumah) {
                                    return $query->where('harga_rumah', '<=', $maxharga_rumah);
                                })
                                ->when($minjumlah_lantai, function ($query, $minjumlah_lantai) {
                                    return $query->where('jumlah_lantai', '>=', $minjumlah_lantai);
                                })
                                ->when($maxjumlah_lantai, function ($query, $maxjumlah_lantai) {
                                    return $query->where('jumlah_lantai', '<=', $maxjumlah_lantai);
                                })
                                ->when($featured, function ($query, $featured) {
                                    return $query->where('featured', '=', 1);
                                })
                                ->paginate(10); 

        return view('pages.search', compact('properties'));
    }

}
