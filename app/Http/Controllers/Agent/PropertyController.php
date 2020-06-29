<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Property;
use App\Feature;
use App\PropertyImageGallery;
use Carbon\Carbon;
use Toastr;
use Auth;
use File;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()
                              ->withCount('comments')
                              ->where('agent_id', Auth::id())
                              ->paginate(10);
        
        return view('agent.properties.index',compact('properties'));
    }

    public function create()
    {   
        $features = Feature::all();

        return view('agent.properties.create',compact('features'));
    }


    public function store(Request $request)
    { 
        $request->validate([
            'nama_rumah'     => 'required|unique:properties|max:255',
            'harga_rumah'     => 'required|unique:properties|max:255',
            'kategori'   => 'required',
            'desain'      => 'required',
            'kamar_tidur'   => 'required',
            'kamar_mandi'  => 'required',
            'kota'      => 'required',
            'alamat'   => 'required',
            'jumlah_lantai'      => 'required',
            'image'     => 'required|image|mimes:jpeg,jpg,png',
            'deskripsi'        => 'required',
        ]);

        $image = $request->file('image');
        $slug  = str_slug($request->nama_rumah);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('property')){
                Storage::disk('public')->makeDirectory('property');
            }
            $propertyimage = Image::make($image)->stream();
            Storage::disk('public')->put('property/'.$imagename, $propertyimage);

        }

        $property = new Property();
        $property->nama_rumah    = $request->nama_rumah;
        $property->slug     = $slug;
        $property->harga_rumah    = $request->harga_rumah;
        $property->kategori  = $request->kategori;
        $property->desain     = $request->desain;
        $property->image    = $imagename;
        $property->kamar_tidur  = $request->kamar_tidur;
        $property->kamar_mandi = $request->kamar_mandi;
        $property->kota     = $request->kota;
        $property->kota_slug= str_slug($request->kota);
        $property->alamat  = $request->alamat;
        $property->jumlah_lantai     = $request->jumlah_lantai;

        if(isset($request->featured)){
            $property->featured = true;
        }
        $property->agent_id           = Auth::id();
        $property->video              = $request->video;
        $property->deskripsi        = $request->deskripsi;
        $property->lokasi_strategis             = $request->lokasi_strategis;
        $property->save();

        $property->features()->attach($request->features);


        $gallary = $request->file('gallaryimage');

        if($gallary)
        {
            foreach($gallary as $images)
            {
                $currentDate = Carbon::now()->toDateString();
                $galimage['name'] = 'gallary-'.$currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
                $galimage['size'] = $images->getClientSize();
                $galimage['property_id'] = $property->id;
                
                if(!Storage::disk('public')->exists('property/gallery')){
                    Storage::disk('public')->makeDirectory('property/gallery');
                }
                $propertyimage = Image::make($images)->stream();
                Storage::disk('public')->put('property/gallery/'.$galimage['name'], $propertyimage);

                $property->gallery()->create($galimage);
            }
        }

        Toastr::success('Data Rumah Berhasil di Tambahkan');
        return redirect()->route('agent.properties.index');
    }


    public function edit(Property $property)
    {   
        $features = Feature::all();
        $property = Property::where('slug',$property->slug)->first();

        return view('agent.properties.edit',compact('property','features'));
    }


    public function update(Request $request, $property)
    {   
        $request->validate([
            'nama_rumah'     => 'required|max:255',
            'harga_rumah'     => 'required',
            'kategori'   => 'required',
            'desain'      => 'required',
            'kamar_tidur'   => 'required',
            'kamar_mandi'  => 'required',
            'kota'      => 'required',
            'alamat'   => 'required',
            'jumlah_lantai'      => 'required',
            'image'     => 'image|mimes:jpeg,jpg,png',
            'deskripsi'        => 'required'
        ]);

        $image = $request->file('image');
        $slug  = str_slug($request->nama_rumah);

        $property = Property::find($property->id);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('property')){
                Storage::disk('public')->makeDirectory('property');
            }
            if(Storage::disk('public')->exists('property/'.$property->image)){
                Storage::disk('public')->delete('property/'.$property->image);
            }
            $propertyimage = Image::make($image)->stream();
            Storage::disk('public')->put('property/'.$imagename, $propertyimage);

        }else{
            $imagename = $property->image;
        }

        $property->nama_rumah    = $request->nama_rumah;
        $property->slug     = $slug;
        $property->harga_rumah    = $request->harga_rumah;
        $property->kategori  = $request->kategori;
        $property->desain     = $request->desain;
        $property->image    = $imagename;
        $property->kamar_tidur  = $request->kamar_tidur;
        $property->kamar_mandi = $request->kamar_mandi;
        $property->kota     = $request->kota;
        $property->kota_slug= str_slug($request->kota);
        $property->alamat  = $request->alamat;
        $property->jumlah_lantai     = $request->jumlah_lantai;

        if(isset($request->featured)){
            $property->featured = true;
        }else{
            $property->featured = false;
        }

        $property->deskripsi          = $request->deskripsi;
        $property->video                = $request->video;
        $property->lokasi_strategis               = $request->lokasi_strategis;
        $property->save();

        $property->features()->sync($request->features);

        $gallary = $request->file('gallaryimage'); 
        if($gallary){
            foreach($gallary as $images){
                if(isset($images))
                {
                    $currentDate = Carbon::now()->toDateString();
                    $galimage['name'] = 'gallary-'.$currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
                    $galimage['size'] = $images->getClientSize();
                    $galimage['property_id'] = $property->id;
                    
                    if(!Storage::disk('public')->exists('property/gallery')){
                        Storage::disk('public')->makeDirectory('property/gallery');
                    }
                    $propertyimage = Image::make($images)->stream();
                    Storage::disk('public')->put('property/gallery/'.$galimage['name'], $propertyimage);

                    $property->gallery()->create($galimage);
                }
            }
        }

        Toastr::success('Data Rumah Berhasil di Rubah');
        return redirect()->route('agent.properties.index');
    }

    public function destroy(Property $property)
    {
        $property = Property::find($property->id);

        if(Storage::disk('public')->exists('property/'.$property->image)){
            Storage::disk('public')->delete('property/'.$property->image);
        }
        if(Storage::disk('public')->exists('property/'.$property->floor_plan)){
            Storage::disk('public')->delete('property/'.$property->floor_plan);
        }

        $property->delete();
        
        $galleries = $property->gallery;
        if($galleries)
        {
            foreach ($galleries as $key => $gallery) {
                if(Storage::disk('public')->exists('property/gallery/'.$gallery->name)){
                    Storage::disk('public')->delete('property/gallery/'.$gallery->name);
                }
                PropertyImageGallery::destroy($gallery->id);
            }
        }

        $property->features()->detach();
        $property->comments()->delete();

        Toastr::success('Data Rumah Berhasil di Hapus');
        return back();
    }


    // DELETE GALERY IMAGE ON EDIT
    public function galleryImageDelete(Request $request){

        $gallaryimg = PropertyImageGallery::find($request->id)->delete();

        if(Storage::disk('public')->exists('property/gallery/'.$request->image)){
            Storage::disk('public')->delete('property/gallery/'.$request->image);
        }

        if($request->ajax()){

            return response()->json(['msg' => true]);
        }
    }
}
