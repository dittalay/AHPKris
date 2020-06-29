@extends('backend.layouts.app')

@section('title', 'Dashboard')

@push('styles')

@endpush


@section('content')

    <div class="block-header">
        <h2>DASHBOARD ADMIN</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL RUMAH</div>
                    <div class="number count-to" data-from="0" data-to="{{ $propertycount }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL COMMENT</div>
                    <div class="number count-to" data-from="0" data-to="{{ $commentcount }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL AKUN</div>
                    <div class="number count-to" data-from="0" data-to="{{ $usercount }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->

    <div class="row clearfix">
        <!-- RUMAH -->
            <div class="card">
                <div class="header">
                    <h2>RUMAH</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA RUMAH</th>
                                    <th>HARGA RUMAH</th>
                                    <th>KOTA</th>
                                    <th><i class="material-icons small">star</i></th>
                                    <th>DEVELOPER PERUMAHAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($properties as $key => $property)
                                <tr>
                                    <td>{{ ++$key }}.</td>
                                    <td>
                                        <span title="{{ $property->nama_rumah }}">
                                            {{ str_limit($property->nama_rumah, 10) }}
                                        </span>
                                    </td>
                                    <td>Rp.{{ $property->harga_rumah }}</td>
                                    <td>{{ $property->kota }}</td>
                                    <td>
                                        @if($property->featured == 1)
                                            <span class="label bg-green">F</span>
                                        @endif
                                    </td>
                                    <td>{{ strtok($property->user->nama, " ")}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>

    <div class="row clearfix">
        <!-- AKUN -->
            <div class="card">
                <div class="header">
                    <h2>AKUN</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA</th>
                                    <th>E-MAIL</th>
                                    <th>ROLE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ ++$key }}.</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->nama }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <!-- #END# USER LIST -->

        <!-- COMMENTS -->
            <div class="card">
                <div class="header">
                    <h2>COMMENTS</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>COMMENT</th>
                                    <th><i class="material-icons small">check</i></th>
                                    <th>AUTHOR</th>
                                    <th>TIME</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $key => $comment)
                                <tr>
                                    <td>{{ ++$key }}.</td>
                                    <td>
                                        <span title="{{ $comment->body }}">
                                            {{ str_limit($comment->body, 10) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($comment->approved == 1)
                                            <span class="label bg-green">A</span>
                                        @else
                                            <span class="label bg-red">N</span>
                                        @endif
                                    </td>
                                    <td>{{ strtok($comment->users->name, " ")}}</td>
                                    <td>{{ $comment->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        <!-- #END# RECENT COMMENTS -->
    </div>


@endsection

@push('scripts')

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('backend/js/pages/index.js') }}"></script>

@endpush
