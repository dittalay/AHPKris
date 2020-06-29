@extends('backend.layouts.app')

@section('title', 'Properties')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')

<div class="block-header">
  <a href="{{ route('admin.manage-kriteria.new') }}" class="waves-effect waves-light btn right m-b-15 addbtn">
      <i class="material-icons left">add</i>
      <span>MEMBUAT DATA KRITERIA BARU </span>
  </a>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
          <div class="header bg-indigo">
              <h2>FORM MANAGE KRITERIA</h2>
          </div>
          <div class="body">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                      <thead>
                          <tr>
                              <th>NO.</th>
                              <th>NAMA KRITERIA</th>
                              <th width="100px">ACTION</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach( $kriteria as $key => $i)
                          <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$i->kriteria}}</td>

                              <td class="text-center">
                                  <a href="{{route('admin.manage-kriteria.edit',$i->id)}}" class="btn btn-info btn-sm waves-effect">
                                      <i class="material-icons">edit</i>
                                  </a>
                                  <form class="" style="display:inline" action="{{ route('admin.manage-kriteria.delete') }}" method="post" id="del-kriteria-{{$i->id}}">
                                    {{ csrf_field() }}
                                    <input type="text" hidden="hidden" name="id" value="{{ $i->id }}">
                                    <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deleteKriteria({{$i->id}})" name="button"><i class="material-icons">delete</i></button>
                                  </form>
                              </td>
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
              <h2>FORM NILAI KRITERIA YANG TELAH DI ISI OLEH CUSTOMER</h2>
          </div>
          <div class="body">
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col" style="text-align:center">-</th>
                      @foreach($kriteria as $i)
                      <th scope="col" style="text-align:center" class="text-white">{{ $i->kriteria }}</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($nilai as $i)
                    <tr class="text-dark">
                      <th style="text-align:center" class="text-dark">{{ $i->kriteria }}</th>
                      @foreach($i->NilaiKriteria1 as $j)
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