<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Property;
use App\Kriteria;
use App\PembobotanAlternatif;
use Illuminate\Http\Request;

class PembobotanAlternatifController extends Controller
{
    //
    public function index(){
      $idUser = Auth::getUser()->id;
      $properties = Property::with(['PembobotanAlternatif' => function($q){
        $q->orderBy('id_kriteria', 'ASC');
      }])->get();
      $kriteria = Kriteria::where('id_user', $idUser)->orderBy('id', 'ASC')->get();

      return view('admin.bobot-alternatif.index', compact('properties', 'kriteria'));
    }
}
