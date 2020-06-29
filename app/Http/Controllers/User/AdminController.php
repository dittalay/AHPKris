<?php

namespace App\Http\Controllers\User;

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
    public function dashboarduser(){
      $idUser = Auth::getUser()->id;
      $properties = Property::join('ranking', 'properties.id', '=', 'ranking.property_id')->orderBy('ranking.nilai', 'DESC')->get();

      $konsistensi = Kriteria::join('konsistensi_kriteria', 'kriteria.id', '=', 'konsistensi_kriteria.id_kriteria')->orderBy('kriteria.id', 'ASC')->get();

      $cekKonsistensi = CekKonsistensi::where('id_user', $idUser)->first();
      return view('user.nilai-kriteria.hasil', compact('properties', 'cekKonsistensi', 'konsistensi'));
    }

    public function process(){
      $idUser = Auth::getUser()->id;
      $kriteria = Kriteria::all();
      $properties = Property::all();

      for ($i=0; $i < sizeof($kriteria); $i++) {
        $sum = NilaiKriteria::where('id_kriteria_2', $kriteria[$i]['id'])->sum('nilai');
        // $sum = $sum->sum('nilai');
        // return response()->json($sum);
        for ($j = 0; $j < sizeof($kriteria); $j++) {
          $nilai = NilaiKriteria::where('id_kriteria_1', $kriteria[$j]['id'])->where('id_kriteria_2', $kriteria[$i]['id'])->first();

          $cek = NormalisasiKriteria::where('id_kriteria_1', $kriteria[$j]['id'])->where('id_kriteria_2', $kriteria[$i]['id'])->first();
          if ($cek){
            $update = NormalisasiKriteria::where('id', $cek->id)->update([
              'nilai' => $nilai->nilai / $sum
            ]);
          } else {
            $new = new NormalisasiKriteria();
            $new->id_kriteria_1 = $kriteria[$j]['id'];
            $new->id_kriteria_2 = $kriteria[$i]['id'];
            $new->nilai = $nilai->nilai / $sum;
            $new->save();
          }
        }

        $total = NormalisasiKriteria::where('id_kriteria_2', $kriteria[$i]['id'])->sum('nilai');

        $cek = TotalNormalisasiKriteria::where('id_kriteria', $kriteria[$i]['id'])->first();
        if ($cek){
          $update = TotalNormalisasiKriteria::where('id', $cek->id)->update([
            'nilai' => $total
          ]);
        } else {
          $new = new TotalNormalisasiKriteria();
          $new->id_kriteria = $kriteria[$i]['id'];
          $new->nilai = $total;
          $new->save();
        }
      }

      for ($i=0; $i < sizeof($kriteria); $i++) {
        $avg = NormalisasiKriteria::where('id_kriteria_1', $kriteria[$i]['id'])->avg('nilai');

        $cek = SkorNormalisasiKriteria::where('id_kriteria', $kriteria[$i]['id'])->first();
        if ($cek){
          $update = SkorNormalisasiKriteria::where('id', $cek->id)->update([
            'skor' => $avg,
            'persen' => number_format($avg * 100)
          ]);
        } else {
          $new = new SkorNormalisasiKriteria();
          $new->id_kriteria = $kriteria[$i]['id'];
          $new->skor = $avg;
          $new->persen = number_format($avg * 100);
          $new->save();
        }
      }

      $avgKonsistensi = 0;
      for ($i=0; $i < sizeof($kriteria); $i++) {
        $total = 0;
        $per = 0;
        for ($j=0; $j < sizeof($kriteria); $j++) {
          $nilai = NilaiKriteria::where('id_kriteria_1', $kriteria[$i]['id'])->where('id_kriteria_2', $kriteria[$j]['id'])->first();
          $skor = SkorNormalisasiKriteria::where('id_kriteria', $kriteria[$j]['id'])->first();
          $total = $total + ($nilai->nilai * $skor->skor);

          if ($j == $i){
            $per = $skor->skor;
          }
        }

        $total = $total / $per;
        $cek = KonsistensiKriteria::where('id_kriteria', $kriteria[$i]['id'])->first();
        if ($cek){
          $update = KonsistensiKriteria::where('id', $cek->id)->update([
            'nilai' => $total
          ]);
        } else {
          $new = new KonsistensiKriteria();
          $new->id_kriteria = $kriteria[$i]['id'];
          $new->nilai = $total;
          $new->save();
        }

        $avgKonsistensi = $avgKonsistensi + $total;
      }

      $avgKonsistensi = $avgKonsistensi/sizeof($kriteria);

      $p = sizeof($kriteria);
      $ci = ($avgKonsistensi-$p)/($p-1);
      $ri = 1.12;
      $cr = $ci/$ri;
      $cr_persen = number_format($cr * 100, 2);

      $cek = CekKonsistensi::where('id_user', $idUser)->first();
      if ($cek){
        $update = CekKonsistensi::where('id_user', $idUser)->update([
          'ci' => $ci,
          'ri' => $ri,
          'cr' => $cr,
          'p' => $p,
          'cr_persen' => $cr_persen
        ]);
      } else {
        $new = new CekKonsistensi();
        $new->id_user = $idUser;
        $new->ci = $ci;
        $new->ri = $ri;
        $new->cr = $cr;
        $new->p = $p;
        $new->cr_persen = $cr_persen;
        $new->save();
      }

      for ($i=0; $i < sizeof($kriteria); $i++) {
        $sum = NilaiAlternatif::where('id_kriteria', $kriteria[$i]['id'])->sum('nilai');
        for ($j=0; $j < sizeof($properties); $j++) {
          $nilai = NilaiAlternatif::where('id_kriteria', $kriteria[$i]['id'])->where('property_id', $properties[$j]['id'])->first();
          $nilai = $nilai->nilai / $sum;

          $cek = PembobotanAlternatif::where('id_kriteria', $kriteria[$i]['id'])->where('property_id', $properties[$j]['id'])->first();
          if ($cek){
            $update = PembobotanAlternatif::where('id', $cek->id)->update([
              'nilai' => $nilai
            ]);
          } else {
            $new = new PembobotanAlternatif();
            $new->id_kriteria = $kriteria[$i]['id'];
            $new->property_id = $properties[$j]['id'];
            $new->nilai = $nilai;
            $new->save();
          }
        }
      }

      for ($i=0; $i < sizeof($properties); $i++) {
        $total = 0;
        for ($j=0; $j < sizeof($kriteria); $j++) {
          $nilai = PembobotanAlternatif::where('id_kriteria', $kriteria[$j]['id'])->where('property_id', $properties[$i]['id'])->first();
          $skor = SkorNormalisasiKriteria::where('id_kriteria', $kriteria[$j]['id'])->first();
          $total = $total + ($nilai->nilai * $skor->skor);
        }

        $cek = Ranking::where('property_id', $properties[$i]['id'])->first();
        if ($cek){
          $update = Ranking::where('id', $cek->id)->update([
            'nilai' => $total
          ]);
        } else {
          $new = new Ranking();
          $new->property_id = $properties[$i]['id'];
          $new->nilai = $total;
          $new->save();
        }
      }


      return redirect()->route('user.nilai-kriteria.hasil');
    }
}
