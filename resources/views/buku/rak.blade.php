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
                                <li class="breadcrumb-item active">Rak </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Rak Buku</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->
            <div class="card">
                <div class="card-header bg-primary text-center">
                    <h4 class="text-light">Tabel Rak</h4>
                </div>
                <div class="card-body bg-white">
                    <?php if(auth()->user()->role){ ?>
                    <!-- <button class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add</button> -->
                    <a href="#" class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#modalRak"><i
                            class="fas fa-plus"></i> Add</a>
                    <?php }?>
                    <table id="datatable2" class="table table-bordered table-striped table-hover table-datatable"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Rak</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;

                        foreach ($rak as $b) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $b->nama_rak ?></td>
                                <td><?= $b->detail ?></td>
                                <?php if(auth()->user()->role == 'Petugas'){ ?>

                                <td>
                                    <a href="" class="btn btn-warning edit-rak" data-id="{{ $b->id_rak }}"
                                        data-toggle="modal" data-target="#modalRakEdt"> <i class="fas fa-edit"></i></a>
                                    <a href="" data-id="{{ $b->id_rak }}" class="btn btn-danger delete"> <i
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


        <div class="modal fade" id="modalRak" tabindex="-1" aria-labelledby="modalRakLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRakLabel">Tambah Rak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="form_rak">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Rak</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control float-right" id="nama_rak" name="nama_rak">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Rak</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control float-right" id="detail" name="detail">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalRakEdt" tabindex="-1" aria-labelledby="modalRakLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRakLabel">Tambah Rak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="form_rak_update">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Rak</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control float-right" id="e_nama_rak" name="nama_rak">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Rak</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control float-right" id="e_detail" name="detail">
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $('.edit-rak').click(function() {
                const id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ url('rak') }}/" + id,
                    async: true,
                    success: function(rs) {
                        $('#id').val(rs.data.id_rak);
                        $('#e_nama_rak').val(rs.data.nama_rak);
                        $('#e_detail').val(rs.data.detail);
                    }
                });
            });

            $('#form_rak_update').on('submit', function(e) {
                e.preventDefault();
                var id = $('#id').val();
                Swal.fire({
                    title: 'Yakin Merubah?',
                    text: "Anda akan merubah data rak",
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
                            url: "{{ url('rak') }}/" + id,
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

            $('#form_rak').on('submit', function(e) {
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
                            url: "{{ url('rak') }}",
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
                            url: "{{ url('rak') }}/" + id,
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
