<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Service;
use App\Kriteria;
use App\NilaiKriteria;
use App\NilaiAlternatif;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Toastr;

class KriteriaController extends Controller
{
    protected $idUser;

    public function __construct(Guard $auth){
      $this->idUser = $auth->id();
    }
    //
    public function index(){
      $idUser = Auth::getUser()->id;
      $kriteria = Kriteria::where('id_user', $idUser)->get();
      return view('admin.manage-kriteria.index', compact('kriteria'));
    }

    public function new(){
      return view('admin.manage-kriteria.new');
    }

    public function edit($id){
      $kriteria = Kriteria::where('id', $id)->first();
      return view('admin.manage-kriteria.edit', compact('kriteria'));
    }

    public function create(Request $req){
      $new = new Kriteria();
      $new->id_user = Auth::getUser()->id;
      $new->kriteria = $req->kriteria;
      $new->save();
      return redirect()->route('admin.manage-kriteria.index');
    }

    public function update(Request $req, $id){
      $update = Kriteria::where('id', $id)->update([
        'kriteria' => $req->kriteria
      ]);
      return redirect()->route('admin.manage-kriteria.index');
    }

    public function delete(Request $req){
      $del = Kriteria::where('id', $req->id)->delete();
      $del = NilaiKriteria::where('id_kriteria_1', $req->id)->delete();
      $del = NilaiKriteria::where('id_kriteria_2', $req->id)->delete();
      $del = NilaiAlternatif::where('id_kriteria', $req->id)->delete();
      return redirect()->route('admin.manage-kriteria.index');
    }
}
