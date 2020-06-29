@extends('backend.layouts.app')

@section('title', 'Show Property')

@push('styles')


@endpush


@section('content')

    <div class="block-header"></div>

    <div class="row clearfix">

        <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
            <div class="card">

                <div class="header bg-indigo">
                    <h2>DETAIL DATA RUMAH</h2>
                </div>

                <div class="header">
                    <h2>
                        {{$property->nama_rumah}}
                        <br>
                        <small>Developer Perumahan : <strong>{{$property->user->nama}}</strong></small>
                    </h2>
                </div>

                <div class="header">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Harga Rumah : </strong>
                            <span class="right"> Rp.{{$property->harga_rumah}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Kamar Tidur : </strong>
                            <span class="right">{{$property->kamar_tidur}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Kamar Mandi : </strong>
                            <span class="right">{{$property->kamar_mandi}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Kota : </strong>
                            <span class="right">{{$property->kota}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Alamat : </strong>
                            <span class="left">{{$property->alamat}}</span>
                        </li>
                    </ul>
                </div>

                <div class="body">
                    <h5>Deskripsi</h5>
                    {!!$property->deskripsi!!}
                </div>

            </div>

            @if($videoembed)
            <div class="card">
                <div class="header">
                    <h2>VIDEO</h2>
                </div>
                <div class="body text-center">
                    {!! $videoembed !!}
                </div>
            </div>
            @endif

            @if(!$property->gallery->isEmpty())
            <div class="card">
                <div class="header bg-red">
                    <h2>IMAGE</h2>
                </div>
                <div class="body">
                    <div class="gallery-box">
                        @foreach($property->gallery as $gallery)
                        <div class="gallery-image">
                            <img class="img-responsive" src="{{Storage::url('property/gallery/'.$gallery->name)}}" alt="{{$property->title}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- COMMENTS --}}
            <div class="card">
                <div class="header">
                    <h2>{{ $property->comments_count }} Comments</h2>
                </div>
                <div class="body">

                    @foreach($property->comments as $comment)
                    
                        @if($comment->parent_id == NULL)
                            <div class="comment">
                                <div class="author-image">
                                    <span style="background-image:url({{ Storage::url('users/'.$comment->users->image) }});"></span>
                                </div>
                                <div class="content">
                                    <div class="author-name">
                                        <strong>{{ $comment->users->name }}</strong>
                                        <span class="right">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="author-comment">
                                        {{ $comment->body }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @foreach($comment->children as $comment)
                            <div class="comment children">
                                <div class="author-image">
                                    <span style="background-image:url({{ Storage::url('users/'.$comment->users->image) }});"></span>
                                </div>
                                <div class="content">
                                    <div class="author-name">
                                        <strong>{{ $comment->users->name }}</strong>
                                        <span class="right">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="author-comment">
                                        {{ $comment->body }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endforeach
                    
                </div>
            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-red">
                    <h2>KATEGORI</h2>
                </div>
                <div class="body">
                    Di <strong class="label bg-blue">{{$property->kategori}}</strong>
                </div>
            </div>

            <div class="card">
                <div class="header bg-cyan">
                    <h2>DESAIN</h2>
                </div>
                <div class="body">
                    <strong class="label bg-red">{{$property->desain}}</strong>
                </div>
            </div>

            <div class="card">
                <div class="header bg-green">
                    <h2>FEATURES</h2>
                </div>
                <div class="body">
                    @foreach($property->features as $feature)
                        <span class="label bg-green">{{$feature->nama}}</span>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="header bg-amber">
                    <h2>IMAGE</h2>
                </div>
                <div class="body">

                    <img class="img-responsive thumbnail" src="{{Storage::url('property/'.$property->image)}}" alt="{{$property->title}}">
                    
                    <a href="{{route('admin.properties.index')}}" class="btn btn-danger btn-lg waves-effect">
                        <i class="material-icons left">arrow_back</i>
                        <span>KEMBALI</span>
                    </a>

                </div>
            </div>
        </div>

    </div>


@endsection


@push('scripts')

    <script src="https://maps.google.com/maps/api/js?v=3&sensor=false"></script>
    <script src="{{ asset('backend/plugins/gmaps/gmaps.js') }}"></script>
    <script>
        //Markers
        var markers = new GMaps({
            div: '#gmap_markers',
            lat: '<?php echo $property->location_latitude; ?>',
            lng: '<?php echo $property->location_longitude; ?>'
        });
        markers.addMarker({
            lat: '<?php echo $property->location_latitude; ?>',
            lng: '<?php echo $property->location_longitude; ?>',
            title: '<?php echo $property->title; ?>',
        });
        
    </script>


@endpush
