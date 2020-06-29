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
              <h2>FORM RANKING</h2>
          </div>
          <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead class="thead-dark">
                            <tr>
                              <th scope="col" style="text-align:center" class="text-white uppercase">Nama Rumah</th>
                              <th scope="col" style="text-align:center" class="text-white uppercase">Harga Rumah</th>
                              <th scope="col" style="text-align:center" class="text-white uppercase">Deskripsi</th>
                              <th scope="col" style="text-align:center" class="text-white uppercase">Alamat</th>
                              <th scope="col" style="text-align:center" class="text-white uppercase">Desain</th>
                              <th scope="col" style="text-align:center" class="text-white uppercase">Hasil Perhitungan AHP</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($properties as $i)
                            <tr>
                              <th style="text-align:center" class="text-dark">{{ $i->nama_rumah }}</th>
                              <td style="text-align:center" class="text-dark">{{ $i->harga_rumah }}</td>
                              <td style="text-align:center" class="text-dark">{{ $i->deskripsi }}</td>
                              <td style="text-align:center" class="text-dark">{{ $i->alamat }}</td>
                              <td style="text-align:center" class="text-dark">{{ $i->desain }}</td>
                              <td style="text-align:center" class="text-dark">{{ $i->nilai }}</td>
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