<div class="page-wrapper">
    <!-- Left Sidenav -->
    <div class="left-sidenav">
        <ul class="metismenu left-sidenav-menu">


            <li>
                <a href="{{ url('dashboard') }}"><i class="ti-dashboard"></i><span>Dashboard</span></a>
            </li>
            @if (auth()->user()->role == 'Admin')
                <li>
                    <a href="javascript: void(0);"><i class="ti-user"></i><span>Management User</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a href="{{ url('petugas') }}"><i
                                    class="ti-control-record"></i>Petugas</a></li>
                        <li class="nav-item"><a href="{{ url('anggota') }}"><i
                                    class="ti-control-record"></i>Anggota</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="dripicons-user-group"></i><span>Laporan</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a href="{{ url('laporan-buku') }}"><i
                                    class="ti-control-record"></i>Laporan Buku</a>
                        </li>
                        <li class="nav-item"><a href="{{ url('laporan-peminjaman') }}"><i
                                    class="ti-control-record"></i>Laporan Peminjaman</a>
                        </li>
                        <li class="nav-item"><a href="{{ url('laporan-perpanjangan') }}"><i
                                    class="   ti-control-record"></i>Laporan
                                Perpanjangan</a></li>
                        <li class="nav-item"><a href="{{ route('laporan.pengembalian') }}"><i
                                    class="ti-control-record"></i>Laporan Pengembalian</a>
                        </li>
                        <li class="nav-item"><a href="{{ url('laporan-donasi') }}"><i
                                    class="ti-control-record"></i>Laporan Donasi</a></li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->role == 'Petugas')
                <li>
                    <a href="javascript: void(0);"><i class="ti-book"></i><span>Management Buku</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a href="{{ url('buku') }}"><i
                                    class="ti-control-record"></i>Buku</a></li>
                        <li class="nav-item"><a href="{{ url('kategori') }}"><i
                                    class="ti-control-record"></i>Kategori</a></li>
                        <li class="nav-item"><a href="{{ url('pengarang') }}"><i
                                    class="ti-control-record"></i>Pengarang</a></li>
                        <li class="nav-item"><a href="{{ url('penerbit') }}"><i
                                    class="ti-control-record"></i>Penerbit</a></li>
                        <li class="nav-item"><a href="{{ url('rak') }}"><i
                                    class="ti-control-record"></i>Rak</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="dripicons-user-group"></i><span>Managemet
                            Anggota</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a href="{{ url('/anggota') }}"><i
                                    class="ti-control-record"></i>Pendaftaran</a></li>
                        <li class="nav-item"><a href="{{ url('donatur') }}"><i
                                    class="ti-control-record"></i>Donatur</a></li>
                        <li class="nav-item"><a href="{{ url('kartu-anggota') }}"><i
                                    class="ti-control-record"></i>Cetak Kartu Anggota</a>
                        </li>
                        <li class="nav-item"><a href="{{ url('status-anggota') }}"><i
                                    class="ti-control-record"></i>Status Anggota</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="ti-wallet"></i><span>Transaksi</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a href="{{ url('peminjaman') }}"><i
                                    class="ti-control-record"></i>Peminjaman</a></li>
                        <li class="nav-item"><a href="{{ url('perpanjangan') }}"><i
                                    class="ti-control-record"></i>Perpanjangan</a></li>
                        <li class="nav-item"><a href="{{ url('pengembalian') }}"><i
                                    class="ti-control-record"></i>Pengembalian</a></li>
                        <li class="nav-item"><a href="{{ url('donasi') }}"><i
                                    class="ti-control-record"></i>Donasi</a></li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->role == 'Anggota')
                <li>
                    <a href="javascript: void(0);"><i class="ti-book"></i><span>Data Buku</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a href="{{ url('buku') }}"><i
                                    class="ti-control-record"></i>Buku</a></li>
                        <li class="nav-item"><a href="{{ url('kategori') }}"><i
                                    class="ti-control-record"></i>Kategori</a></li>
                        <li class="nav-item"><a href="{{ url('pengarang') }}"><i
                                    class="ti-control-record"></i>Pengarang</a></li>
                        <li class="nav-item"><a href="{{ url('penerbit') }}"><i
                                    class="ti-control-record"></i>Penerbit</a></li>
                        <li class="nav-item"><a href="{{ url('rak') }}"><i
                                    class="ti-control-record"></i>Rak</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);"><i class="ti-book"></i><span>Peminjaman</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="nav-item"><a href="{{ url('peminjaman-aktif') }}"><i
                                    class="ti-control-record"></i>Peminjaman Aktif</a>
                        </li>
                        <li class="nav-item"><a href="{{ url('peminjaman-history') }}"><i
                                    class="ti-control-record"></i>History Peminjaman</a>
                        </li>

                    </ul>
                </li>
            @endif
        </ul>
    </div>
    <!-- end left-sidenav-->
