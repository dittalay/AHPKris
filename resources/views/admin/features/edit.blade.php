@extends('backend.layouts.app')

@section('title', 'Edit Feature')

@push('styles')

    
@endpush


@section('content')

    <div class="block-header">
        <a href="{{route('admin.features.index')}}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">arrow_back</i>
            <span>KEMBALI</span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>EDIT DATA FEATURE</h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.features.update',$feature->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="nama" class="form-control" value="{{$feature->nama}}">
                                <label class="form-label">Nama Feature</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                            <i class="material-icons">update</i>
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
