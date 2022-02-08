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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->

            <div class="card jumbotron text-center">
                <div class="col-sm-8 mx-auto">
                    <h1>Selamat datang!</h1>
                    <p>{!! $text !!}</p>
                    <p>
                        Anda telah login sebagai <b>{{ auth()->user()->role }}</b>
                    </p>

                </div>
            </div>
            @if (auth()->user()->role != 'Anggota')

                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="dripicons-user-group report-main-icon"></i>
                                </div>
                                <span class="badge badge-danger">Anggota</span>
                                <h3 class="my-3">{{ $anggota }} Anggota</h3>
                                {{-- <p class="mb-0 text-muted text-truncate"><span class="text-success"><i
                                            class="mdi mdi-trending-up"></i>8.5%</span>New Sessions Today</p> --}}
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-md-3">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="dripicons-box report-main-icon"></i>
                                </div>
                                <span class="badge badge-secondary">Jumlah Buku</span>
                                <h3 class="my-3">{{ $buku }} Buku</h3>
                                {{-- <p class="mb-0 text-muted text-truncate"><span class="text-danger"><i
                                            class="mdi mdi-trending-down"></i>1.5%</span> Weekly Avg.Sessions</p> --}}
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-md-3">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="dripicons-document report-main-icon"></i>
                                </div>
                                <span class="badge badge-warning">Peminjaman Active</span>
                                <h3 class="my-3">{{ $peminjaman }} Active</h3>
                                {{-- <p class="mb-0 text-muted text-truncate"><span class="text-danger"><i
                                            class="mdi mdi-trending-down"></i>35%</span> Bounce Rate Weekly</p> --}}
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-md-3">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="dripicons-wallet report-main-icon"></i>
                                </div>
                                <span class="badge badge-success">Donation</span>
                                <h3 class="my-3">{{ $donasi }}</h3>
                                {{-- <p class="mb-0 text-muted text-truncate"><span class="text-success"><i
                                            class="mdi mdi-trending-up"></i>10.5%</span> Completions Weekly</p> --}}
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
            @endif
            <!--end row-->




        </div><!-- container -->
    @endsection
