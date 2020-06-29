@extends('backend.layouts.app')

@section('title', 'Properties')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')

<div class="block-header">
  <a href="{{ route('admin.nilai-alternatif.new') }}" class="waves-effect waves-light btn right m-b-15 addbtn">
      <i class="material-icons left">add</i>
      <span>MEMBUAT DATA ALTERNATIF BARU </span>
  </a>
</div>

  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header bg-indigo">
                  <h2>FORM NILAI ALTERNATIF</h2>
              </div>
              <div class="body">
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col" style="text-align:center">-</th>
                          @foreach($kriteria as $i)
                          <th scope="col" style="text-align:center" class="text-white uppercase">{{ $i->kriteria }}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($properties as $i)
                        <tr class="text-dark">
                          <th style="text-align:center" class="text-dark uppercase">{{ $i->nama_rumah }}</th>
                          @foreach($i->NilaiAlternatif as $j)
                          <td style="text-align:center" class="text-dark">{{ $j->nilai }}</td>
                          @endforeach
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
          </div>
      </div>
    </div>

@endsection


@push('scripts')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>

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


@endpush

