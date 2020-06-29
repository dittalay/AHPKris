@extends('backend.layouts.app')

@section('title', 'Properties')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
          <div class="header bg-indigo">
              <h2>FORM CHECK KONSISTENSI</h2>
          </div>
          <div class="body">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col" class="text-white uppercase">Nama</th>
                        <th scope="col" class="text-white uppercase">Hasil</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($cekKonsistensi != null)
                      <tr class="text-white">
                        <th>P</th>
                        <td>{{ $cekKonsistensi->p }}</td>
                      </tr>
                      <tr class="text-white">
                        <th>CI</th>
                        <td>{{ $cekKonsistensi->ci }}</td>
                      </tr>
                      <tr class="text-white">
                        <th>RI</th>
                        <td>{{ $cekKonsistensi->ri }}</td>
                      </tr>
                      <tr class="text-white">
                        <th>CR</th>
                        <td>{{ $cekKonsistensi->cr }}</td>
                      </tr>
                      <tr class="text-white">
                        <th>CR %</th>
                        <td>{{ $cekKonsistensi->cr_persen }}%  < 10% (
                          @if($cekKonsistensi->cr_persen < 10)
                          Fill the Requirement
                          @else
                          No Fill the requirement
                          @endif
                          )</td>
                      </tr>
                      @endif
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
  function deleteKriteria(id){
      
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
              document.getElementById('del-kriteria-'+id).submit();
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