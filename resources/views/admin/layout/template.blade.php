<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AHP - KRISMA</title>
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/pnj.jpg') }}" rel="icon" type="image/jpg"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('css/argon.css?v=1.0.0') }}" rel="stylesheet">
  </head>

  <body>
    <div class="container-scroller">
    <div class="horizontal-menu">

        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
            <div class="container-fluid">
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                <span class="nav-profile-name" >{{ Auth::getUser()->username }}</span>
                                <span class="online-status"></span>
                                <img src="images/faces/face28.png" alt="profile"/>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item">
                                    <i class="mdi mdi-settings text-primary"></i>
                                    Settings
                                </a>
                                <a href="{{ route('logout') }}">
                                    <i class="mdi mdi-logout text-primary"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <nav class="bottom-navbar">
            <div class="container">
                <ul class="nav page-navigation">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="mdi mdi-finance menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                        <i class="menu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manage-kriteria.index') }}">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Kriteria</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                        <span class="menu-title">Alternatif</span>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="{{ route('nilai-alternatif.new') }}">Menambahkan Nilai Alternatif</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('nilai-alternatif.index') }}">Data Alternatif & Hasil Nilai Alternatif</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="mdi mdi-cube-outline menu-icon"></i>
                        <span class="menu-title">NBR</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul>
                            <li class="nav-item"><a class="nav-link" href="{{ route('normalisasi') }}">Normalisasi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('bobot-alternatif.index') }}">Bobot Alternatif</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('ranking.index') }}">Ranking</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="account.html" class="nav-link">
                        <i class="mdi mdi-emoticon menu-icon"></i>
                        <span class="menu-title">Manage ALL Account</span>
                        <i class="menu-arrow"></i>
                    </a>
                </li>
                </ul>
            </div>
        </nav>
        
        <!-- Main content -->
        <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-white pb-1 pt-5 pt-md-8">
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7 bg-gradient-white">
        @yield('content')
        </div>
        <!--- Footer contenct -->
        <div>
        <div class="footer bg-gradient-white pb-1 pt-5 pt-md-5">
        </div>

    </div>
    <script src="{{ asset('vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>
		<script src="{{ asset('vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
		<script src="{{ asset('vendors/justgage/raphael-2.1.4.min.js') }}"></script>
        <script src="{{ asset('vendors/justgage/justgage.js') }}"></script>

        <script src="{{ asset('vendor/chart.js/dist/Chart.min.js') }}"></script>
        <script src="{{ asset('vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/argon.js?v=1.0.0') }}"></script>
    @yield('script')
  </body>
</html>