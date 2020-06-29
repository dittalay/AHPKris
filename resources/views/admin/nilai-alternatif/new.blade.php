@extends('backend.layouts.app')

@section('title', 'Create Service')

@push('styles')

    
@endpush


@section('content')

    <div class="block-header">
        <a href="{{route('admin.nilai-alternatif.index')}}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">arrow_back</i>
            <span>KEMBALI</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>FORM DATA RUMAH</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>IMAGE</th>
                                    <th>NAMA RUMAH</th>
                                    <th>HARGA RUMAH</th>
                                    <th>DESKRIPSI</th>
                                    <th>KOTA</th>
                                    <th>DESAIN</th>
                                    <th>FASILITAS</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $properties as $key => $property )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                            <img src="{{Storage::url('property/'.$property->image)}}" alt="{{$property->nama_rumah}}" width="60" class="img-responsive img-rounded">
                                        @endif
                                    </td>
                                    <td>
                                        <span title="{{$property->nama_rumah}}">
                                            {{ str_limit($property->nama_rumah,10) }}
                                        </span>
                                    </td>
                                    <td>Rp.{{$property->harga_rumah}}</td>
                                    <td>{{$property->deskripsi}}</td>
                                    <td>{{$property->kota}}</td>
                                    <td>{{$property->desain}}</td>
                                    <td>@foreach($property->features as $feature)
                                        <span>{{$feature->nama}}</span>
                                    @endforeach</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>MEMBUAT DATA ALTERNATIF BARU</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.nilai-alternatif.create')}}" method="POST">
                        {{ csrf_field() }}

                        <table class="table align-items-center table-flush">
                          <thead>
                            <th scope="col">-</th>
                            @foreach($kriteria as $i)
                            <th class="text-dark">{{ $i->kriteria }}</th>
                            @endforeach
                          </thead>
                          <tbody>
                            @foreach($properties as $i)
                            <tr>
                              <td class="text-dark">{{ $i->nama_rumah }}</td>
                              @foreach($kriteria as $j)
                              <td><input type="text" required class="form-control text-dark" name="{{ $i->id . '_' . $j->id }}" value=""></td>
                              @endforeach
                            </tr>
                            @endforeach
                            <td></td>
                          </tbody>
                        </table>

                        <button name="btn_kategori" type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">save</i>
                            <span>SIMPAN</span>
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

@endpush
