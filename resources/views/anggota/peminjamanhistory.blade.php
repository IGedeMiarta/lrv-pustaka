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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Transaksi</a></li>
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
                    <h4 class="text-light">Tabel History Peminjaman</h4>
                </div>
                <div class="card-body bg-white">
                    <a href="" class="btn btn-success float-right mb-3" data-toggle="modal"
                        data-target="#modalPeminjaman"><i class="fas fa-plus"></i> Add</a>

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
                            <?php if($b->detail == 1 || $b->detail == 4 ){ ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $b->tgl_perpanjang ? date('d M Y', strtotime($b->tgl_perpanjang)) : date('d M Y', strtotime($b->tgl_pinjam)) ?>
                                </td>
                                <td><?= $b->kd_peminjaman != null ? $b->kd_peminjaman : '-' ?></td>
                                <td><?= $b->nama ?></td>
                                <td><?= $b->judul ?></td>
                                <td><?= date('d M Y', strtotime($b->batas_pinjam)) ?></td>
                                <td><?= $b->status_pinjam ?></td>

                            </tr>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div><!-- container -->



    @endsection
    @section('script')
        <script>
            $('#form_peminjaman').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin Menyimpan?',
                    text: "Anda akan menyimpan data transaksi",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            data: $(this).serialize(),
                            dataType: 'JSON',
                            url: "{{ url('peminjaman') }}",
                            async: true,
                            success: function(rs) {
                                console.log(rs);
                                if (rs.status == 401) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: rs.title,
                                        text: rs.text
                                    }).then((result) => {
                                        $('#form_peminjaman').trigger("reset");
                                        $('modalPeminjaman').modal('hide');
                                        location.reload();
                                    });
                                } else if (rs.status == 500) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: rs.title,
                                        text: rs.text
                                    }).then((result) => {
                                        $('#form_peminjaman').trigger("reset");
                                        $('modalPeminjaman').modal('hide');
                                        location.reload();
                                    });
                                } else if (rs.status == 201) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: rs.title,
                                        text: rs.text
                                    }).then((result) => {
                                        $('#form_peminjaman').trigger("reset");
                                        $('modalPeminjaman').modal('hide');
                                        location.reload();
                                    });
                                }

                            }
                        })
                    }
                })

            })
        </script>

    @endsection
