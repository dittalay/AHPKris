@extends('frontend.layouts.search')

@section('styles')

@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col s12 m8">

                    <div class="card horizontal card-no-shadow m-b-60">
                        <div class="card-image agent-image">
                            <img src="{{Storage::url('users/'.$agent->image)}}" alt="{{ $agent->username }}" class="imgresponsive">
                        </div>
                        <div class="card-stacked p-l-15">
                            <div class="">
                                <h5 class="">{{ $agent->nama }}</h5>
                                <strong>{{ $agent->email }}</strong>
                            </div>
                            <div class="">
                                <p>{{ $agent->deskripsi }}</p>
                            </div>
                        </div>
                    </div>

                    <h5 class="uppercase">DAFTAR RUMAH YANG TERSEDIA DI {{ $agent->nama }}</h5>

                    {{-- AGENT PROPERTIES --}}
                    @foreach($properties as $property)

                        <div class="card horizontal card-no-shadow border1">
                            <div class="card-image horizontal-bg-image">
                                <span class="card-image-bg" style="background-image:url({{Storage::url('property/'.$property->image)}});"></span>
                            </div>
                            <div class="card-stacked">
                                <div class="p-20 property-content">
                                    <span class="card-title search-title" title="{{$property->nama_rumah}}">
                                        <a href="{{ route('property.show',$property->slug) }}">{{ str_limit($property->nama_rumah,25) }}</a>
                                    </span>
                                    <h5>
                                        Rp.{{ $property->harga_rumah }}
                                    </h5>
                                </div>

                                <div class="card-action property-action">
                                    <span class="btn-flat">
                                        <i class="material-icons">check_box</i>
                                        Kamar Tidur : <strong>{{ $property->kamar_tidur}}</strong> 
                                    </span>
                                    <br>
                                    <span class="btn-flat">
                                        <i class="material-icons">check_box</i>
                                        Kamar Mandi : <strong>{{ $property->kamar_mandi}}</strong> 
                                    </span>
                                    <br>
                                    <span class="btn-flat">
                                        <i class="material-icons">check_box</i>
                                        Jumlah Lantai : <strong>{{ $property->jumlah_lantai}}</strong>
                                    </span>
                                    <br>
                                    <span class="btn-flat">
                                        <i class="material-icons">check_box</i>
                                        Desain Rumah : <strong>{{ $property->desain}}</strong>
                                    </span>
                                    <br>
                                    <span class="btn-flat">
                                        <i class="material-icons">check_box</i>
                                        Di : <strong>{{ $property->kategori}}</strong>
                                    </span>
                                    
                                    @if($property->featured == 1)
                                        <span class="right featured-stars">
                                            <i class="material-icons">stars</i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @endforeach

                    <div class="m-t-30 m-b-60 center">
                        {{ $properties->links() }}
                    </div>

                </div>

                <div class="col s12 m4">
                    <div class="clearfix">

                        <div>
                            <ul class="collection with-header m-t-0">
                                <li class="collection-header grey lighten-4">
                                    <h5 class="m-0">HUBUNGI DEVELOPER PERUMAHAN</h5>
                                </li>
                                <li class="collection agent-message">
                                    <form class="agent-message-box" action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                            
                                        <div class="box">
                                            <input type="text" name="nama" placeholder="Ketik Nama Kamu...">
                                        </div>
                                        <div class="box">
                                            <input type="email" name="email" placeholder="Ketik E-Mail Kamu...">
                                        </div>
                                        <div class="box">
                                            <input type="number" name="phone" placeholder="Ketik Phone Kamu...">
                                        </div>
                                        <div class="box">
                                            <textarea name="message" placeholder="Tuliskan Pesan..."></textarea>
                                        </div>
                                        <div class="box">
                                            <button id="msgsubmitbtn" class="btn waves-effect waves-light w100 indigo" type="submit">
                                                KIRIM
                                                <i class="material-icons left">send</i>
                                            </button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $(function(){
            $(document).on('submit','.agent-message-box',function(e){
                e.preventDefault();

                var data = $(this).serialize();
                var url = "{{ route('property.message') }}";
                var btn = $('#msgsubmitbtn');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    beforeSend: function() {
                        $(btn).addClass('disabled');
                        $(btn).empty().append('LOADING...<i class="material-icons left">rotate_right</i>');
                    },
                    success: function(data) {
                        if (data.message) {
                            M.toast({html: data.message, classes:'green darken-4'})
                        }
                    },
                    error: function(xhr) {
                        M.toast({html: xhr.statusText, classes: 'red darken-4'})
                    },
                    complete: function() {
                        $('form.agent-message-box')[0].reset();
                        $(btn).removeClass('disabled');
                        $(btn).empty().append('SEND<i class="material-icons left">send</i>');
                    },
                    dataType: 'json'
                });

            })
        })
    </script>
@endsection