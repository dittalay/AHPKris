<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Feature;
use Toastr;

class FeatureController extends Controller
{

    public function index()
    {
        $features = Feature::latest()->get();

        return view('admin.features.index',compact('features'));
    }


    public function create()
    {
        return view('admin.features.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:features|max:255'
        ]);

        $tag = new Feature();
        $tag->nama = $request->nama;
        $tag->slug = str_slug($request->nama);
        $tag->save();

        Toastr::success('message', 'Data Feature Berhasil di Tambahkan.');
        return redirect()->route('admin.features.index');
    }


    public function edit($id)
    {
        $feature = Feature::find($id);

        return view('admin.features.edit',compact('feature'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255'
        ]);

        $feature = Feature::find($id);
        $feature->nama = $request->nama;
        $feature->slug = str_slug($request->nama);
        $feature->save();

        Toastr::success('message', 'Data Feature Berhasil di Rubah.');
        return redirect()->route('admin.features.index');
    }


    public function destroy($id)
    {
        $feature = Feature::find($id);
        $feature->delete();

        Toastr::success('message', 'Data Feature Berhasil di Hapus.');
        return back();
    }
}
