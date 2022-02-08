@extends('layouts.master')
@section('content')
    <!-- Page Content-->
    <div class="page-content">

        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Laporan</a></li>
                                <li class="breadcrumb-item active">Perpanjangan</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Perpanjangan</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->
            <div class="card">
                <div class="card-header bg-primary text-center">
                    <h4 class="text-light">Tabel Perpanjangan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h6>Filter Berdasarkan Tanggal</h6>
                                </div>
                                <div class="card-body">

                                    <form method="get" action="">
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="tanggal_mulai">Tanggal Mulai Pinjam</label>
                                            <input type="date" class="form-control" name="tanggal_mulai"
                                                placeholder="Masukkan tanggal mulai pinjam"
                                                value="<?= isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : '' ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="tanggal_sampai">Tanggal Pinjam
                                                Sampai</label>
                                            <input type="date" class="form-control" name="tanggal_sampai"
                                                placeholder="Masukkan tanggal pinjam sampai"
                                                value="<?= isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '' ?>">
                                        </div>
                                        <input type="submit" class="btn btn-primary" value="Filter">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <?php
                    // membuat tombol cetak jika data sudah di filter
                    if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
                        $mulai = $_GET['tanggal_mulai'];
                        $sampai = $_GET['tanggal_sampai'];
                    ?>
                    <a class='btn btn-danger' target="_blank"
                        href="{{ url('cetak-perpanjangan') . '?tanggal_mulai=' . $mulai . '&tanggal_sampai=' . $sampai }}"><i
                            class='fas fa-file-pdf'></i>
                        Import PDF</a>
                    <?php
                    }
                    ?>
                </div>
                <div class="card-body bg-white">

                    <table id="datatable2" class="table table-bordered table-striped table-hover table-datatable"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Tanggal perpanjangan </th>
                                <th>Nama Peminjam </th>
                                <th>Judul Buku</th>
                                <th>Batas Pinjam</th>
                                <th>Status</th>
                                <!-- <th>Opsi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                        foreach ($perpanjangan as $b) { ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= date('d M Y', strtotime($b->tgl_perpanjang)) ?></td>
                                <td><?= $b->nama ?></td>
                                <td><?= $b->judul ?></td>
                                <td><?= date('d M Y', strtotime($b->batas_pinjam)) ?></td>
                                <td><?= $b->status_pinjam ?></td>

                            </tr>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>

            </div><!-- container -->

        @endsection
