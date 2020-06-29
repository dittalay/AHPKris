@extends('frontend.layouts.search')

@section('styles')

@endsection

@section('content')

    <section>
        <div class="container">
            <div class="row">

                <div class="col s12 m4 card">

                    <h2 class="sidebar-title">MENCARI RUMAH</h2>

                    <form class="sidebar-search" action="{{ route('search')}}" method="GET">

                        <div class="searchbar">
                            <div class="input-field col s12">
                                <input type="text" name="kota" id="autocomplete-input-sidebar" class="autocomplete custominputbox" autocomplete="off">
                                <label for="autocomplete-input-sidebar">Ketik kota yang ingin di cari...</label>
                            </div>
    
                            <div class="input-field col s12">
                                <select name="desain" class="browser-default">
                                    <option value="" disabled selected>Pilih Desain Rumah</option>
                                    <option value="biasa">Biasa</option>
                                    <option value="lumayan">Lumayan</option>
                                    <option value="bagus">Bagus</option>
                                </select>
                            </div>
    
                            <div class="input-field col s12">
                                <select name="kategori" class="browser-default">
                                    <option value="" disabled selected>Pilih Kategori Rumah</option>
                                    <option value="jual">Jual</option>
                                    <option value="sewa">Sewa</option>
                                </select>
                            </div>
    
                            <div class="input-field col s12">
                                <select name="kamar_tidur" class="browser-default">
                                    <option value="" disabled selected>Pilih Jumlah Kamar Tidur</option>
                                    @foreach($bedroomdistinct as $kamar_tidur)
                                        <option value="{{$kamar_tidur->kamar_tidur}}">{{$kamar_tidur->kamar_tidur}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-field col s12">
                                <select name="kamar_mandi" class="browser-default">
                                    <option value="" disabled selected>Pilih Jumlah Kamar Mandi</option>
                                    @foreach($bathroomdistinct as $kamar_mandi)
                                        <option value="{{$kamar_mandi->kamar_mandi}}">{{$kamar_mandi->kamar_mandi}}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="input-field col s12">
                                <input type="number" name="minharga_rumah" id="minharga_rumah" class="custominputbox">
                                <label for="minharga_rumah">Ketik Minimal Harga Rumah...</label>
                            </div>
    
                            <div class="input-field col s12">
                                <input type="number" name="maxharga_rumah" id="maxharga_rumah" class="custominputbox">
                                <label for="maxharga_rumah">Ketik Maksimal Harga Rumah...</label>
                            </div>
    
                            <div class="input-field col s12">
                                <input type="number" name="minjumlah_lantai" id="minjumlah_lantai" class="custominputbox">
                                <label for="minjumlah_lantai">Ketik Minimal Jumlah Lantai...</label>
                            </div>
    
                            <div class="input-field col s12">
                                <input type="number" name="maxjumlah_lantai" id="maxjumlah_lantai" class="custominputbox">
                                <label for="maxjumlah_lantai">Ketik Maksimal Jumlah Lantai...</label>
                            </div>
                            
                            <div class="input-field col s12">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox" name="featured">
                                        <span class="lever"></span>
                                        Featured
                                    </label>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <button class="btn btnsearch indigo" type="submit">
                                    <i class="material-icons left">search</i>
                                    <span>SEARCH</span>
                                </button>
                            </div>
                        </div>
    
                    </form>

                </div>

                <div class="col s12 m8">

                    @foreach($properties as $property)
                        <div class="card horizontal">
                            <div>
                                <div class="card-content property-content">
                                    @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                        <div class="card-image blog-content-image">
                                            <img src="{{Storage::url('property/'.$property->image)}}" alt="{{$property->nama_rumah}}">
                                        </div>
                                    @endif
                                    <span class="card-title search-title" title="{{$property->nama_rumah}}">
                                        <a href="{{ route('property.show',$property->slug) }}">{{ $property->nama_rumah }}</a>
                                    </span>
                                    
                                    <div class="address">
                                        <i class="small material-icons left">location_city</i>
                                        <span>Kota : {{ ucfirst($property->kota) }}</span>
                                    </div>
                                    <div class="address">
                                        <i class="small material-icons left">place</i>
                                        <span>Alamat : {{ ucfirst($property->alamat) }}</span>
                                    </div>
                                    <div class="address">
                                        <i class="small material-icons left">check_box</i>
                                        <span>Desain Rumah : {{ ucfirst($property->desain) }}</span>
                                    </div>
                                    <div class="address">
                                        <i class="small material-icons left">check_box</i>
                                        <span>Kategori Rumah : {{ $property->kategori }}</span>
                                    </div>
                                    <div class="address">
                                        <i class="small material-icons left">check_box</i>
                                        <span>Kamar Tidur : {{ $property->kamar_tidur}}</span>
                                    </div>
                                    <div class="address">
                                        <i class="small material-icons left">check_box</i>
                                        <span>Kamar Mandi : {{ $property->kamar_mandi}}</span>
                                    </div>
                                    <div class="address">
                                        <i class="small material-icons left">check_box</i>
                                        <span>Jumlah Lantai : {{ $property->jumlah_lantai}}</span>
                                    </div>
                                    <div class="address">
                                        <i class="small material-icons left">comment</i>
                                        <span>Jumlah Komentar : {{ $property->comments_count}}</span>
                                    </div>
                                </div>
                                <div class="card-action property-action">
                                    <h5>
                                        Rp.{{ $property->harga_rumah }}
                                        <div class="right" id="{{$property->id}}"></div>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <div class="m-t-30 m-b-60 center">
                        {{ 
                            $properties->appends([
                                'kota'      => Request::get('kota'),
                                'desain'      => Request::get('desain'),
                                'kategori'   => Request::get('kategori'),
                                'kamar_tidur'   => Request::get('kamar_tidur'),
                                'kamar_mandi'  => Request::get('kamar_mandi'),
                                'minharga_rumah'  => Request::get('minharga_rumah'),
                                'maxharga_rumah'  => Request::get('maxharga_rumah'),
                                'minjumlah_lantai'   => Request::get('minjumlah_lantai'),
                                'maxjumlah_lantai'   => Request::get('maxjumlah_lantai'),
                                'featured'  => Request::get('featured')
                            ])->links() 
                        }}
                    </div>
        
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')

@endsection