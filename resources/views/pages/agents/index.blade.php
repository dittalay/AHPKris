@extends('frontend.layouts.search')

@section('styles')

@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">
                <h4 class="section-heading">DATA SEMUA DEVELOPER PERUMAHAN</h4>
            </div>
            <div class="row">

                @foreach($agents as $agent)
                    <div class="col s12 m4">
                        <div class="card-panel center card-agent">
                            <span class="card-image-bg" style="background-image:url({{Storage::url('users/'.$agent->image)}});"></span>
                            <h5 class="m-b-0">
                                <a href="{{ route('agents.show',$agent->id) }}" class="truncate">{{ $agent->nama }}</a>
                            </h5>
                            <h6 class="email">{{ $agent->email }}</h6>
                            <p class="deskripsi">{{ str_limit($agent->deskripsi,50) }}</p>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="m-t-30 m-b-60 center">
                {{ $agents->links() }}
            </div>

        </div>
    </section>

@endsection

@section('scripts')

@endsection