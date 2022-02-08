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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">{{ auth()->user()->role }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Anggota</a></li>
                                <li class="breadcrumb-item active">Cetak Kartu</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Cetak Kartu</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->

            <div class="card">
                <div class="card-header bg-primary text-center">
                    <h4 class="text-light">Tabel Anggota</h4>
                </div>
                <div class="card-body bg-white">

                    <table id="datatable2" class="table table-bordered table-striped table-hover table-datatable"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama </th>
                                <th>Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;

                        foreach ($anggota as $b) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $b->nis ?></td>
                                <td><?= $b->nama ?></td>

                                <td>
                                    <a href="{{ url('cetak-anggota') . '/' . $b->id_anggota }}" target=" _blank"
                                        class="btn btn-warning"> <i class="fas fa-print"></i></a>
                                </td>
                            </tr>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div><!-- container -->
    @endsection
