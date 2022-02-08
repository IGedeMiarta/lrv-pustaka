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
                                <li class="breadcrumb-item active">Peminjaman</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Peminjaman</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->
            <div class="card">
                <div class="card-header bg-primary text-center">
                    <h4 class="text-light">Tabel Pengembalian</h4>
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
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-secondary" id="start_date"><i
                                                            class="fas fa-calendar-alt"></i></button>
                                                </div>
                                                <!-- <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username"> -->
                                                <input type="date" id="date_start" class="form-control"
                                                    name="tanggal_mulai" placeholder="Masukkan tanggal mulai pinjam"
                                                    value="<?= isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : '' ?>"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="tanggal_sampai">Tanggal Pinjam
                                                Sampai</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-secondary" id="end_date"><i
                                                            class="fas fa-calendar-alt"></i></button>
                                                </div>
                                                <!-- <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username"> -->
                                                <input type="date" id="date_end" class="form-control"
                                                    name="tanggal_sampai" placeholder="Masukkan tanggal pinjam sampai"
                                                    value="<?= isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '' ?>"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <!-- <input type="submit" class="btn btn-primary" value="Filter"> -->

                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h6>Filter Berdasarkan Anggota</h6>
                                </div>
                                <div class="card-body">


                                    <div class="form-group">
                                        <label class="font-weight-bold" for="tanggal_mulai">Anggota</label>
                                        <select name="anggota" id="" class="form-select select2">
                                            <option selected disabled>-Pilih Anggota</option>

                                            <?php foreach ($anggota as $d) : ?>
                                            <option value="<?= $d->id_anggota ?>"
                                                <?= isset($_GET['anggota']) == $d->id_anggota ? 'selected' : '' ?>>
                                                <?= $d->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- <input type="submit" class="btn btn-primary" value="Filter"> -->
                                    <!-- </form> -->
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h6>Filter Berdasarkan Buku</h6>
                                </div>
                                <div class="card-body">


                                    <div class="form-group">
                                        <label class="font-weight-bold" for="tanggal_mulai">Buku</label>
                                        <select name="buku" id="" class="form-select select2">
                                            <option selected disabled>-Pilih Buku</option>
                                            <?php foreach ($book as $d) : ?>
                                            <option value="<?= $d->isbn ?>"
                                                <?= isset($_GET['buku']) == $d->isbn ? 'selected' : '' ?>><?= $d->judul ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br />
                    <input type="submit" class="btn btn-primary" value="Filter">
                    <!-- <button type="submit"  onclick="this.form.reset();"></button> -->
                    <a href="{{ url('laporan-peminjaman') }}" class="btn btn-warning"> Reset</a>
                    </form>


                    <?php
                    // membuat tombol cetak jika data sudah di filter
                    if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
                        $mulai = $_GET['tanggal_mulai'];
                        $sampai = $_GET['tanggal_sampai'];
                        ?>
                    <a class='btn btn-danger' target="_blank"
                        href="{{ url('cetak-peminjaman') . '?tanggal_mulai=' . $mulai . '&tanggal_sampai=' . $sampai }}"><i
                            class='fas fa-file-pdf'></i>
                        Import PDF</a>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_GET['anggota'])) {
                        $anggota = $_GET['anggota'];
                        ?>
                    <a class='btn btn-danger' target="_blank"
                        href="{{ url('cetak-peminjaman') . '?anggota=' . $anggota }}"><i class='fas fa-file-pdf'></i>
                        Import PDF</a>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_GET['buku'])) {
                        $buku = $_GET['buku'];
                        ?>
                    <a class='btn btn-danger' target="_blank" href="{{ url('cetak-peminjaman') . '?buku=' . $buku }}"><i
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
                                <th>Tanggal Pinjam </th>
                                <th>Nomer peminjaman</th>
                                <th>Nama Peminjam </th>
                                <th>Judul Buku</th>
                                <th>Batas Pinjam</th>
                                <th>Status</th>
                                <!-- <th>Opsi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($peminjaman as $b) { ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $b->tgl_perpanjang ? date('d M Y', strtotime($b->tgl_perpanjang)) : date('d M Y', strtotime($b->tgl_pinjam)) ?>
                                </td>
                                <td><?= $b->kd_peminjaman ?></td>
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
            </div>

        </div><!-- container -->


    @endsection
