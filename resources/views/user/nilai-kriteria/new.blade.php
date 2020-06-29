@extends('admin.layout.user')
@section("content")
<div style="padding: 0px 20px 20px 0px" class="text-center">
  <a class="btn btn-danger" href="{{ route('admin.dashboard')}}">KEMBALI</a>
</div>
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Isi kuesioner terlebih dahulu untuk mendapatkan rumah yang sesuai dengan keinginan anda...</h3>
            </div>
        </div>
    </div>
    <div class="table-responsive" style="padding: 5px 25px 20px 25px">
        <form action="{{ route('user.nilai-kriteria.create') }}" method="post">
            {{ csrf_field() }}
            <table class="table align-items-center table-flush">
                <tbody>
                  @for($l = 0; $l < sizeof($kriteria); $l++)
                    @for($r = ($l+1); $r < sizeof($kriteria); $r++)
                    <tr>
                      <th>{{ $kriteria[$l]['kriteria'] }}</th>
                      <td>
                        <select name="{{ $kriteria[$l]['id'] . '_' .$kriteria[$r]['id'] }}" class="form-control opt-select">
                          <option value="0" selected>Pilih...</option>
                          <option value="1">1. Sama Penting</option>
                          <option value="3">3. Cukup Penting</option>
                          <option value="5">5. Lebih Penting</option>
                          <option value="7">7. Mutlak Lebih Penting</option>
                        </select>
                      </td>
                      <th>Dari Pada {{ $kriteria[$r]['kriteria'] }}</th>
                    </tr>
                    @endfor
                  @endfor
                </tbody>
            </table>
            <div class="" style="margin-top: 20px">
              <button name="btn_kategori" type="submit" class="btn btn-primary">Proses</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
  $(document).ready(function(){
    $('.opt-select').change(function(){
      if ($(this).val() == 1){
        var arr = $(this).attr('name').split('_');
        var name = 'select[name=' + arr[1] + '_' + arr[0] + ']';
        $(name).val(1);
      } else {
        var arr = $(this).attr('name').split('_');
        var name = 'select[name=' + arr[1] + '_' + arr[0] + ']';
        $(name).val(0);
      }
    });
  });
</script>
@endsection
