@extends('admin.layout.hasil')
@section('content')
<div style="padding: 0px 20px 20px 0px" class="text-center">
  <a class="btn btn-danger" href="{{ route('user.dashboard')}}">KEMBALI</a>
</div>
<div class="row">
  <div class="col-xl">
    <div class="card shadow bg-dark">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="text-uppercase text-white ls-1 mb-1">Ranking</h6>
            <h2 class="mb-0 text-white">Ranking Position</h2>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="chart-rank-pos" class="chart-canvas"></canvas>
        </div>
        <div class="card shadow bg-light">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-dark ls-1 mb-1">Detail</h6>
                <h2 class="mb-0 text-dark">Ranking value</h2>
              </div>
            </div>
          </div>
          <div class="card-body bg-light">
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-white">Rumah</th>
                    <th scope="col" class="text-white">Value</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($properties as $i)
                  <tr class="text-dark">
                    <th>{{ $i->nama_rumah }}</th>
                    <td>{{ $i->nilai }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row mt-5">
  <div class="col-xl-6 mb-5 mb-xl-0">
    <div class="card shadow">
      <div class="card-header border-0 bg-gradient-success">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0 text-white">Check Consistence</h3>
          </div>
        </div>
      </div>
      <div class="table-responsive bg-dark">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-dark">
            <tr>
              <th scope="col" class="text-white">Name</th>
              <th scope="col" class="text-white">Value</th>
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
  <div class="col-xl-6">
    <div class="card shadow">
      <div class="card-header border-0 bg-gradient-indigo">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0 text-white">Criteria Consistence</h3>
          </div>
        </div>
      </div>
      <div class="table-responsive bg-dark">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-dark">
            <tr>
              <th scope="col" class="text-white">Name</th>
              <th scope="col" class="text-white">Value</th>
            </tr>
          </thead>
          <tbody>
            @foreach($konsistensi as $i)
            <tr>
              <th class="text-white">{{ $i->kriteria }}</th>
              <td class="text-white">{{ $i->nilai }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $(document).ready(function(){
    var ctx = $('#chart-rank-pos');
    var properties = {!! $properties !!};
    console.log(properties);

    var label = [];
    var value = [];
    for(var data in properties){
      label.push(properties[data]['nama_rumah']);
      value.push(properties[data]['nilai']);
    }

    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: label,
        datasets: [{
            label: '# of Votes',
            data: value,
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

  });
</script>
@endsection