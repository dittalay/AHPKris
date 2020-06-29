<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Kriteria;
use App\Property;
use App\NilaiKriteria;
use App\NilaiAlternatif;
use App\NormalisasiKriteria;
use App\TotalNormalisasiKriteria;
use App\SkorNormalisasiKriteria;
use App\KonsistensiKriteria;
use App\CekKonsistensi;
use App\PembobotanAlternatif;
use App\Ranking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboardCekKonsistensi(){
      $idUser = Auth::getUser()->id;
      $properties = Property::join('ranking', 'properties.id', '=', 'ranking.property_id')->orderBy('ranking.nilai', 'DESC')->get();

      $konsistensi = Kriteria::join('konsistensi_kriteria', 'kriteria.id', '=', 'konsistensi_kriteria.id_kriteria')->orderBy('kriteria.id', 'ASC')->get();

      $cekKonsistensi = CekKonsistensi::where('id', $idUser)->first();
      return view('admin.cek-konsistensi.hasil', compact('cekKonsistensi'));
    }

    public function dashboardKonsistensiKriteria(){
      $idUser = Auth::getUser()->id;
      $properties = Property::join('ranking', 'properties.id', '=', 'ranking.property_id')->orderBy('ranking.nilai', 'DESC')->get();

      $konsistensi = Kriteria::join('konsistensi_kriteria', 'kriteria.id', '=', 'konsistensi_kriteria.id_kriteria')->orderBy('kriteria.id', 'ASC')->get();

      $cekKonsistensi = CekKonsistensi::where('id', $idUser)->first();
      return view('admin.konsistensi-kriteria.hasil', compact('konsistensi'));
    }

}
