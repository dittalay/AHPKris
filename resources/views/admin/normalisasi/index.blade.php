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
              <h2>FORM NORMALISASI</h2>
          </div>
          <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th style="text-align:center">-</th>
                                @foreach($kriteria as $i)
                                <th style="text-align:center" class="uppercase">{{ $i->kriteria }}</th>
                                @endforeach
                                <th style="text-align:center" class="uppercase">Skor</th>
                                <th style="text-align:center" class="uppercase">Persen</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $sumSkor = 0; $sumPersen = 0; ?>

                            @foreach($nilai as $i)
                            <tr>
                                <th style="text-align:center" class="uppercase">{{ $i->kriteria }}</th>
                                @foreach($i->NilaiNormalisasi1 as $j)
                                <td style="text-align:center">{{ $j->nilai }}</td>
                                @endforeach
                                @if($i->SkorNormalisasiKriteria != null)
                                <td style="text-align:center">{{ $i->SkorNormalisasiKriteria->skor }}</td>
                                <td style="text-align:center">{{ $i->SkorNormalisasiKriteria->persen }} %</td>
                                @endif
                            </tr>
                                @if($i->SkorNormalisasiKriteria != null)
                                <?php $sumSkor = $sumSkor + $i->SkorNormalisasiKriteria->skor; $sumPersen = $sumPersen + $i->SkorNormalisasiKriteria->persen ?>
                                @endif
                            @endforeach

                            <tr>
                                <th></th>
                                @foreach($kriteria as $i)
                                @if($i->TotalNormalisasiKriteria != null)
                                <th style="text-align:center">{{ $i->TotalNormalisasiKriteria->nilai }}</th>
                                @endif
                                @endforeach
                                <th style="text-align:center">{{ $sumSkor }}</th>
                                <th style="text-align:center">{{ $sumPersen }} %</th>
                            </tr>
                            
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
