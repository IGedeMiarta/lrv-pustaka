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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Buku</a></li>
                                <li class="breadcrumb-item active">Pengarang</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Pengarang</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>

            <div class="card">
                <div class="card-header bg-primary text-center">
                    <h4 class="text-light">Tabel Pengarang</h4>
                </div>
                <div class="card-body bg-white">
                    <?php if(auth()->user()->role){ ?>
                    <!-- <button class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add</button> -->
                    <a href="" class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#exampleModal"><i
                            class="fas fa-plus"></i> Add</a>
                    <?php }?>
                    <table id="datatable2" class="table table-bordered table-striped table-hover table-datatable"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Pengarang</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;

                        foreach ($pengarang as $b) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $b->kd_pengarang ?></td>
                                <td><?= $b->nama_pengarang ?></td>
                                <?php if(auth()->user()->role == 'Petugas'){ ?>

                                <td>
                                    <a href="" class="btn btn-warning edit" data-id="{{ $b->id_pengarang }}"
                                        data-toggle="modal" data-target="#modalEdit"> <i class="fas fa-edit "></i></a>

                                    <a href="" data-id="{{ $b->id_pengarang }}" class="btn btn-danger delete"> <i
                                            class="fas fa-trash"></i></a>
                                </td>
                                <?php }else{?>
                                <td>
                                    <p class="text-center">-</p>
                                </td>
                                <?php }?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div><!-- container -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengarang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form_pengarang" method="POST" action="">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Pengarang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kd_pengarang" name="kd_pengarang"
                                        value="<?= $kd_pengarang ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pengarang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang">
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

        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengarang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form_pengarang_update" method="POST" action="">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Pengarang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="e_kd_pengarang" name="kd_pengarang">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pengarang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="e_nama_pengarang" name="nama_pengarang">
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
            $('.edit').click(function() {
                const id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ url('pengarang') }}/" + id,
                    async: true,
                    success: function(rs) {
                        $('#id').val(rs.data.id_pengarang);
                        $('#e_kd_pengarang').val(rs.data.kd_pengarang);
                        $('#e_nama_pengarang').val(rs.data.nama_pengarang);
                    }
                });
            });

            $('#form_pengarang_update').on('submit', function(e) {
                e.preventDefault();
                var id = $('#id').val();
                Swal.fire({
                    title: 'Yakin Merubah?',
                    text: "Anda akan merubah data pengarang",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Update'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'PUT',
                            data: $(this).serialize(),
                            dataType: 'JSON',
                            url: "{{ url('pengarang') }}/" + id,
                            async: true,
                            success: function(rs) {
                                console.log(rs);
                                if (rs.status == 500) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: rs.title,
                                        text: rs.text
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else if (rs.status == 201) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: rs.title,
                                        text: rs.text
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }

                            }
                        })
                    }
                })
            })

            $('#form_pengarang').on('submit', function(e) {
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
                            url: "{{ url('pengarang') }}",
                            async: true,
                            success: function(rs) {
                                console.log(rs);
                                if (rs.status == 500) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: rs.title,
                                        text: rs.text
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else if (rs.status == 201) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: rs.title,
                                        text: rs.text
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }

                            }
                        })
                    }
                })

            })

            $('.delete').on('click', function(e) {
                e.preventDefault();

                const id = $(this).data('id');
                Swal.fire({
                    title: 'yakin Hapus?',
                    text: "Anda tidak dapat mengembalikan data yang terhapus",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'DELETE',
                            dataType: 'JSON',
                            url: "{{ url('pengarang') }}/" + id,
                            async: true,
                            success: function(rs) {
                                console.log(rs);
                                if (rs.status == 500) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: rs.title,
                                        text: rs.text
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else if (rs.status == 201) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: rs.title,
                                        text: rs.text
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else if (rs.status == 404) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: rs.title,
                                        text: rs.text
                                    }).then((result) => {
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
