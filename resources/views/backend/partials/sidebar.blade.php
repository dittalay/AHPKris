    <aside id="leftsidebar" class="sidebar">

        <!-- Menu -->
        <div class="menu">
            <ul class="list">

                <li class="header">DASHBOARD</li>
                
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="header">MANAGE WEBSITE</li>

                <li class="{{ Request::is('admin/sliders*') ? 'active' : '' }}">
                    <a href="{{ route('admin.sliders.index') }}">
                        <i class="material-icons">burst_mode</i>
                        <span>Manage Sliders</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/services*') ? 'active' : '' }}">
                    <a href="{{ route('admin.services.index') }}">
                        <i class="material-icons">wb_sunny</i>
                        <span>Manage Services</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonials.index') }}">
                        <i class="material-icons">view_carousel</i>
                        <span>Manage Testimonials</span>
                    </a>
                </li>

                <li class="header">MANAGE KRITERIA DAN ALTERNATIF</li>

                <li class="{{ Request::is('admin/manage-kriteria*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage-kriteria.index') }}">
                        <i class="material-icons">home</i>
                        <span>Manage Kriteria</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/properties*') ? 'active' : '' }}">
                    <a href="{{ route('admin.properties.index') }}">
                        <i class="material-icons">home</i>
                        <span>Manage Rumah</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/features*') ? 'active' : '' }}">
                    <a href="{{ route('admin.features.index') }}">
                        <i class="material-icons">star</i>
                        <span>Manage Features</span>
                    </a>
                </li>

                <li class="header">MANAGE NILAI KRITERIA DAN NILAI ALTERNATIF</li>

                <li class="{{ Request::is('admin/konsistensi-kriteria*') ? 'active' : '' }}">
                    <a href="{{ route('admin.konsistensi-kriteria.hasil') }}">
                        <i class="material-icons">star</i>
                        <span>Hasil Konsistensi Kriteria</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/nilai-alternatif*') ? 'active' : '' }}">
                    <a href="{{ route('admin.nilai-alternatif.index') }}">
                        <i class="material-icons">star</i>
                        <span>Manage Nilai Alternatif</span>
                    </a>
                </li>

                <li class="header">MANAGE AHP</li>

                <li class="{{ Request::is('admin/cek-konsistensi*') ? 'active' : '' }}">
                    <a href="{{ route('admin.cek-konsistensi.hasil') }}">
                        <i class="material-icons">view_carousel</i>
                        <span>Cek Konsistensi</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/normalisasi*') ? 'active' : '' }}">
                    <a href="{{ route('admin.normalisasi.index') }}">
                        <i class="material-icons">view_carousel</i>
                        <span>Hasil Normalisasi</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/bobot-alternatif*') ? 'active' : '' }}">
                    <a href="{{ route('admin.bobot-alternatif.index') }}">
                        <i class="material-icons">view_carousel</i>
                        <span>Weight Alternative</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/ranking*') ? 'active' : '' }}">
                    <a href="{{ route('admin.ranking.index') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Ranking</span>
                    </a>
                </li>

                <li class="header">MANAGE PROFILE</li>
 
                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::is('admin/profile') ? 'active' : '' }}">
                            <a href="{{ route('admin.profile') }}">
                                <span>Profile Admin</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/changepassword') ? 'active' : '' }}">
                            <a href="{{ route('admin.changepassword') }}">
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/message*') ? 'active' : '' }}">
                            <a href="{{ route('admin.message') }}">
                                <span>Pesan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                

            </ul>
        </div>
        <!-- #Menu -->
        
    </aside>