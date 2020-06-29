@extends('frontend.layouts.search')

@section('styles')
@endsection

@section('content')

    <section class="section">
        <div class="container">
            <div class="row">

                <div class="col s12 m3">
                    <div class="agent-sidebar">
                        @include('agent.sidebar')
                    </div>
                </div>

                <div class="col s12 m9">

                    <h4 class="agent-title">DATA RUMAH</h4>
                    
                    <div class="agent-content">
                        <table class="striped responsive-table">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA RUMAH</th>
                                    <th>DESAIN</th>
                                    <th>KOTA</th>
                                    <th><i class="material-icons small-star p-t-10">comment</i></th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                    
                            <tbody>
                                @foreach( $properties as $key => $property )
                                    <tr>
                                        <td class="right-align">{{$key+1}}.</td>
                                        <td>
                                            <span class="tooltipped" data-position="bottom" data-tooltip="{{$property->nama_rumah}}">
                                                {{ str_limit($property->nama_rumah,30) }}
                                            </span>
                                        </td>
                                        
                                        <td>{{ ucfirst($property->desain) }}</td>
                                        <td>{{ ucfirst($property->kota) }}</td>

                                        <td class="center">
                                            <span><i class="material-icons small-comment left">comment</i>{{ $property->comments_count }}</span>
                                        </td>
    
                                        <td class="center">
                                            <a href="{{route('property.show',$property->slug)}}" target="_blank" class="btn btn-small green waves-effect">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{route('agent.properties.edit',$property->slug)}}" class="btn btn-small orange waves-effect">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button type="button" class="btn btn-small deep-orange accent-3 waves-effect" onclick="deletePost({{$property->id}})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form action="{{route('agent.properties.destroy',$property->slug)}}" method="POST" id="del-post-{{$property->id}}" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="center">
                            {{ $properties->links() }}
                        </div>
                    </div>
        
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function deletePost(id){
            
            swal({
                title: 'Yakin Ingin Hapus Data INI?',
                text: "",
                type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del-post-'+id).submit();
                    swal(
                        'Data Berhasil Di Hapus!',
                        '',
                        'success'
                    )
                }
            })
        }
        
    </script>
@endsection