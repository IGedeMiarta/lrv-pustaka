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
                                <li class="breadcrumb-item active">Data Anggota</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Data Anggota</h4>
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
                    <?php 
                    if(auth()->user()->role){ ?>
                    <a href="" class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#exampleModal"><i
                            class="fas fa-plus"></i> Add</a>
                    <?php } ?>
                    <table id="datatable2" class="table table-bordered table-striped table-hover table-datatable"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama </th>
                                <th>Jenis Kelamin</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <?php if(auth()->user()->role){ ?>
                                <th>Akun</th>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;
                        foreach ($anggota as $b) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $b->nis ?></td>
                                <td><?= $b->nama ?></td>
                                <td><?php
                                if ($b->jenis_kel == 'L') {
                                    echo 'Laki - Laki';
                                } else {
                                    echo 'Perempuan';
                                }
                                ?></td>
                                <td><?= $b->no_hp ?></td>
                                <td><?= $b->alamat ?></td>
                                <td><?= $b->status ?></td>
                                <?php if(auth()->user()->role){ ?>
                                <td class="text-center" width="100px">
                                    <?php if ($b->user == 'null') { ?>
                                    <a href="#" class="btn btn-success btn-sm btn-create" data-id="<?= $b->id_anggota ?>"><i
                                            class="fas fa-user"></i> Buat</a>
                                    <?php } else {
                                                echo $b->username;
                                            } ?>
                                </td>
                                <td width="12%">
                                    <a href="" class="btn btn-warning edit-anggota" data-toggle="modal"
                                        data-id="<?= $b->id_anggota ?>" data-target="#modelEdit"> <i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger delete" data-id="{{ $b->id_anggota }}"> <i
                                            class="fas fa-trash"></i></a>
                                </td>
                                <?php } ?>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form_anggota" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nomer Induk</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nis" name="nis">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jenkel" id="jenkel" class="form-control">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">No Hp</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="hp" name="hp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat" id="alamat" class="form-control" cols="30"
                                        rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Status Anggota</label>
                                <div class="col-sm-10">
                                    <select name="status" id="status" class="form-control">
                                        <option value="L">--Pilih</option>
                                        <?php foreach ($status as $s) : ?>
                                        <option value="<?= $s->id_status_anggota ?>"><?= $s->status ?></option>
                                        <?php endforeach ?>
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

        <div class="modal fade" id="modelEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit_petugas" method="POST" action="#">
                            <input type="text" class="form-control" id="e_id" name="id" hidden>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">NIS</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="e_nip" name="nis">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="e_nama" name="nama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jenkel" id="e_jenkel" class="form-control">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">No Hp</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="e_hp" name="hp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat" id="e_alamat" class="form-control" cols="30"
                                        rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="e_status" class="form-control">
                                        <option value="L">--Pilih</option>
                                        <?php foreach ($status as $s) : ?>
                                        <option value="<?= $s->id_status_anggota ?>"><?= $s->status ?></option>
                                        <?php endforeach ?>
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

        <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="regist" class="mt-3" method="POST">
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="password" name="password">
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
            $('.btn-create').on('click', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $('#user_id').val(id);
                $('#modalUser').modal('show');
            })
            $('#regist').on('submit', function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    url: "{{ route('anggota.user') }}",
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
            })
            $('.edit-anggota').click(function() {
                const id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ url('anggota') }}/" + id,
                    async: true,
                    success: function(rs) {
                        $('#e_id').val(rs.data.id_anggota);
                        $('#e_nip').val(rs.data.nis);
                        $('#e_nama').val(rs.data.nama);
                        $('#e_jenkel').val(rs.data.jenis_kel);
                        $('#e_hp').val(rs.data.no_hp);
                        $('#e_alamat').val(rs.data.alamat);
                        $('#e_status').val(rs.data.status);
                    }
                });
            });

            $('#edit_petugas').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin Merubah?',
                    text: "Anda akan Merubah data transaksi",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Ubah'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $('#e_id').val();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'PUT',
                            data: $(this).serialize(),
                            dataType: 'JSON',
                            url: "{{ url('anggota') }}/" + id,
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

            });

            $('#form_anggota').on('submit', function(e) {
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
                            url: "{{ url('anggota') }}",
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
                            url: "{{ url('anggota') }}/" + id,
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
