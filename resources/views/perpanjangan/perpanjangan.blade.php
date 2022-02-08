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
                <div class="card-body bg-white">
                    <a href="" class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#exampleModal"><i
                            class="fas fa-plus"></i> Add</a>
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
            </div>

        </div><!-- container -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Perpanjangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form_perpanjangan" method="POST" action="">

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Peminjam</label>
                                <div class="col-sm-10">
                                    <select name="peminjaman[]" id="peminjaman" class="form-control select2"
                                        multiple="multiple">
                                        <?php foreach ($peminjaman as $d) : ?>
                                        <option value="<?= $d->id_peminjaman ?>">
                                            <strong><?= $d->kd_peminjaman . ' - ' . $d->nama . ' - ' . $d->judul ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    @endsection
    @section('script')
        <script>
            $('#form_perpanjangan').on('submit', function(e) {
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
                            url: "{{ url('perpanjangan') }}",
                            async: true,
                            success: function(rs) {
                                if (rs.status == 201) {
                                    Swal.fire({
                                        icon: 'success',
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
                                }

                            }
                        })
                    }
                })

            })
        </script>
    @endsection
