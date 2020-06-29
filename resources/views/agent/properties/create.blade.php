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
                    <div class="agent-content">
                        <h4 class="agent-title">MEMBUAT DATA RUMAH BARU</h4>

                        <form action="{{route('agent.properties.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">title</i>
                                    <input id="nama_rumah" name="nama_rumah" type="text" class="validate" data-length="200">
                                    <label for="nama_rumah">Nama Rumah</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">mode_edit</i>
                                    <textarea id="deskripsi" name="deskripsi" class="materialize-textarea"></textarea>
                                    <label for="deskripsi">Deskripsi</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">monetization_on</i>
                                    <input id="harga_rumah" name="harga_rumah" type="number" class="validate">
                                    <label for="harga_rumah">Harga Rumah</label>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">business</i>
                                    <input id="jumlah_lantai" name="jumlah_lantai" type="number" class="validate">
                                    <label for="jumlah_lantai">Jumlah Lantai</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">airline_seat_flat</i>
                                    <input id="kamar_tidur" name="kamar_tidur" type="number" class="validate">
                                    <label for="kamar_tidur">Kamar Tidur</label>
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">event_seat</i>
                                    <input id="kamar_mandi" name="kamar_mandi" type="number" class="validate">
                                    <label for="kamar_mandi">Kamar Mandi</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s4">
                                    <i class="material-icons prefix">location_city</i>
                                    <input id="kota" name="kota" type="text" class="validate">
                                    <label for="kota">Kota</label>
                                </div>
                                <div class="input-field col s8">
                                    <i class="material-icons prefix">account_balance</i>
                                    <textarea id="alamat" name="alamat" class="materialize-textarea"></textarea>
                                    <label for="alamat">Alamat</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s3">
                                    <label class="label-custom" for="desain">Pilih Desain Rumah</label>
                                    <p>
                                        <label>
                                            <input class="with-gap" name="desain" value="biasa" type="radio"  />
                                            <span>Biasa</span>
                                        </label>
                                    <p>
                                    </p>
                                        <label>
                                            <input class="with-gap" name="desain" value="lumayan" type="radio"  />
                                            <span>Lumayan</span>
                                        </label>
                                    </p>
                                    </p>
                                        <label>
                                            <input class="with-gap" name="desain" value="bagus" type="radio"  />
                                            <span>Bagus</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="col s3">
                                    <label class="label-custom" for="kategori">Pilih Kategori</label>
                                    <p>
                                        <label>
                                            <input class="with-gap" name="kategori" value="jual" type="radio"  />
                                            <span>JUAL</span>
                                        </label>
                                    <p>
                                    </p>
                                        <label>
                                            <input class="with-gap" name="kategori" value="sewa" type="radio"  />
                                            <span>SEWA</span>
                                        </label>
                                    </p>
                                </div>
                                <div class="input-field col s6">
                                    <select multiple name="features[]">
                                        <option value="" disabled selected>Pilih Features</option>
                                        @foreach($features as $feature)
                                            <option value="{{ $feature->id }}">{{ $feature->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label class="label-custom">Pilih Features</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">place</i>
                                    <textarea id="lokasi_strategis" name="lokasi_strategis" class="materialize-textarea"></textarea>
                                    <label for="lokasi_strategis">Lokasi Strategis</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">voice_chat</i>
                                    <input id="video" name="video" type="text" class="validate">
                                    <label for="video">Link Youtube</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="file-field input-field col s12">
                                    <div class="btn indigo">
                                        <span>UPLOAD IMAGE HOME</span>
                                        <input type="file" name="image">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="file-field input-field col s12">
                                    <div class="btn indigo">
                                        <span>UPLOAD IMAGE DETAIL HOME</span>
                                        <input type="file" name="gallaryimage[]" multiple>
                                        <span class="helper-text" data-error="wrong" data-success="right">Upload bisa lebih dari 1</span>
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12 m-t-30">
                                    <button class="btn waves-effect waves-light btn-large indigo darken-4" type="submit">
                                        SIMPAN
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div> <!-- /.col -->

            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('input#title, textarea#nearby').characterCounter();
        $('select').formSelect();
    });

</script>
@endsection