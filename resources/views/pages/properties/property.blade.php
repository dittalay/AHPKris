@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')

    <section class="section">
        <div class="container">
            
            <div class="row">
                <h4 class="section-heading">DATA SEMUA RUMAH</h4>
            </div>

            <div class="row">
                <div class="city-categories">
                    @foreach($cities as $kota)
                        <div class="col s12 m3">
                            <a href="{{ route('property.city',$kota->kota_slug) }}">
                                <div class="city-category">
                                    <span>{{ $kota->kota }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row">

                @foreach($properties as $property)
                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-image">
                                @if(Storage::disk('public')->exists('property/'.$property->image) && $property->image)
                                    <span class="card-image-bg" style="background-image:url({{Storage::url('property/'.$property->image)}});"></span>
                                @else
                                    <span class="card-image-bg"><span>
                                @endif
                                @if($property->featured == 1)
                                    <a class="btn-floating halfway-fab waves-effect waves-light indigo"><i class="small material-icons">star</i></a>
                                @endif
                            </div>
                            <div class="card-content property-content">
                                <a href="{{ route('property.show',$property->slug) }}">
                                    <span class="card-title tooltipped" data-position="bottom" data-tooltip="{{ $property->nama_rumah }}">{{ str_limit( $property->nama_rumah, 18 ) }}</span>
                                </a>

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

            </div>

            <div class="m-t-30 m-b-60 center">
                {{ $properties->links() }}
            </div>

        </div>
    </section>

@endsection

@section('scripts')

<script>

    $(function(){
        var js_properties = <?php echo json_encode($properties);?>;
        js_properties.data.forEach(element => {
            if(element.rating){
                var elmt = element.rating;
                var sum = 0;
                for( var i = 0; i < elmt.length; i++ ){
                    sum += parseFloat( elmt[i].rating ); 
                }
                var avg = sum/elmt.length;
                if(isNaN(avg) == false){
                    $("#propertyrating-"+element.id).rateYo({
                        rating: avg,
                        starWidth: "20px",
                        readOnly: true
                    });
                }else{
                    $("#propertyrating-"+element.id).rateYo({
                        rating: 0,
                        starWidth: "20px",
                        readOnly: true
                    });
                }
            }
        });
    })
</script>
@endsection