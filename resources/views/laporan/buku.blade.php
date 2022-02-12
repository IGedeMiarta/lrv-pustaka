<!-- Page Content-->
@extends('layouts.master')
@section('content')
    <div class="page-content">

        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-right">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="javascript:void(0);">{{ auth()->user()->role }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Buku</a></li>
                                    <li class="breadcrumb-item active">Data Buku</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Data Buku</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header bg-primary text-center">
                                <h4 class="text-light mb-2">Tabel Buku</h4>
                            </div>
                            <div class="card-body bg-white">
                                <a href="{{ route('buku.cetak') }}" target="_blank"
                                    class="btn btn-danger float-left mr-2 mb-3"><i class="fas fa-file-pdf"></i></i> Import
                                    PDF</a>

                                <table id="datatable2"
                                    class="table table-bordered table-striped table-hover table-datatable"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="1px">No</th>
                                            <th>Kode</th>
                                            <th width="30%">Judul</th>
                                            <th>Pengarang</th>
                                            <th>Penerbit</th>
                                            <th>Tahun</th>
                                            <th>Kategori</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $no = 1;

                                    foreach ($book as $b) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $b->kd_buku ?></td>
                                            <td><?= $b->judul ?></td>
                                            <td><?= $b->nama_pengarang ?></td>
                                            <td><?= $b->nama_penerbit ?></td>
                                            <td><?= $b->th_terbit ?></td>
                                            <td><?= $b->nama_kategori ?></td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div><!-- container -->

    @endsection
