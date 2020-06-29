<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Ranking;
use App\Property;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    //
    public function index(){
      $idUser = Auth::getUser()->id;
      $properties = Property::join('ranking', 'properties.id', '=', 'ranking.property_id')->orderBy('ranking.nilai', 'DESC')->get();
      return view('admin.ranking.index', compact('properties'));
    }
}
