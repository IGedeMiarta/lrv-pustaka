@extends('layouts.master')
@section('content')
    <!-- Page Content-->
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
                                <?php if(auth()->user()->role == 'Petugas'){ ?>
                                <a href="#" class="btn btn-success float-right mb-3" data-toggle="modal"
                                    data-target="#modalAdd"><i class="ti ti-plus"></i> Add</a>
                                <?php }?>

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
                                            <th width="10px">Detail</th>
                                            <th>Opsi</th>
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
                                            <td>

                                                <div class="btn-group btn-group-toggle">

                                                    <?php if(auth()->user()->role == 'Petugas'){ ?>
                                                    <a class="btn btn-primary btn-sm detail-buku" href="#"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="<?= $b->isbn ?>"><i class="fas fa-fw fa-plus"></i></a>

                                                    <?php } elseif(auth()->user()->role == 'Petugas') { ?>
                                                    <a class="btn btn-primary btn-sm detail-buku" href="#"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="<?= $b->isbn ?>"><i class="fas fa-fw fa-plus"></i></a>
                                                    <?php } ?>
                                                    <?php if ($b->status == 1) { ?>
                                                    <a href="{{ url('details') . '/' . $b->isbn }}"
                                                        class="btn btn-success btn-sm"><i class="far fa-fw fa-eye"></i></a>

                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <?php if(auth()->user()->role == 'Petugas'){ ?>
                                            <td>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <a href="" data-id="{{ $b->isbn }}"
                                                        class="btn btn-warning btn-sm edit" data-toggle="modal"
                                                        data-target="#modalEdt"><i class="ti ti-marker-alt"></i></a>
                                                    <a href="#" data-id="{{ $b->isbn }}"
                                                        class="btn btn-danger btn-sm delete"><i
                                                            class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                            <?php }else{ ?>
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

                    </div>
                </div>

            </div>
        </div><!-- container -->
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" id="form_buku">
                            <div class="form-group row">
                                <label for="horizontalInput1" class="col-sm-2 col-form-label">Kode Buku</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kd_buku" class="form-control" value="{{ $kode_buku }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="judul" placeholder="Judul Buku">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="th_terbit">
                                        <option value="">- Pilih tahun</option>
                                        <?php for ($tahun = date('Y'); $tahun >= 2010; $tahun--) { ?>
                                        <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pengarang</label>
                                <div class="col-sm-10">
                                    <select name="pengarang" id="" class="form-control">
                                        <option value="">--Pilih</option>
                                        <?php foreach ($pengarang as $k) : ?>
                                        <option value="<?= $k->kd_pengarang ?>"><?= $k->nama_pengarang ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Penerbit</label>
                                <div class="col-sm-10">
                                    <select name="penerbit" id="" class="form-control">
                                        <option value="">--Pilih</option>
                                        <?php foreach ($penerbit as $k) : ?>
                                        <option value="<?= $k->kd_penerbit ?>"><?= $k->nama_penerbit ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kategori" id="" class="form-control">
                                        <option value="">--Pilih</option>
                                        <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k->kd_kategori ?>"><?= $k->nama_kategori ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalEdt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" id="form_buku_update">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group row">
                                <label for="horizontalInput1" class="col-sm-2 col-form-label">Kode Buku</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kd_buku" class="form-control" id="e_kd_buku">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="judul" placeholder="Judul Buku"
                                        id="e_judul">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="th_terbit" id="e_th_terbit">
                                        <option value="">- Pilih tahun</option>
                                        <?php for ($tahun = date('Y'); $tahun >= 2010; $tahun--) { ?>
                                        <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pengarang</label>
                                <div class="col-sm-10">
                                    <select name="pengarang" class="form-control" id="e_pengarang">
                                        <option value="">--Pilih</option>
                                        <?php foreach ($pengarang as $k) : ?>
                                        <option value="<?= $k->kd_pengarang ?>"><?= $k->nama_pengarang ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Penerbit</label>
                                <div class="col-sm-10">
                                    <select name="penerbit" class="form-control" id="e_penerbit">
                                        <option value="">--Pilih</option>
                                        <?php foreach ($penerbit as $k) : ?>
                                        <option value="<?= $k->kd_penerbit ?>"><?= $k->nama_penerbit ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kategori" class="form-control" id="e_kategori">
                                        <option value="">--Pilih</option>
                                        <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k->kd_kategori ?>"><?= $k->nama_kategori ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" id="form_buku_detail">
                            <input type="text" name="isbn" id="isbn">
                            <div class="form-group">
                                <label class="font-weight-bold" for="cari">Kode Buku</label>
                                <input type="text" class="form-control" id="kd_buku" name="kd_buku" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="cari">Kode Detail Buku</label>
                                <input type="text" class="form-control" id="kd_detail" name="kd_detail" value=""
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="judul">Rak Buku</label>
                                <select name="rak" class="form-control" id="">
                                    <option value="">--pilih</option>
                                    <?php foreach ($rak as $r) : ?>
                                    <option value="<?= $r->id_rak ?>"><?= $r->nama_rak . ' - ' . $r->detail ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $('.detail-buku').click(function() {
                const id = $(this).data('id');
                $.ajax({
                    url: "{{ url('kode-buku') }}/" + id,
                    type: 'GET',
                    dataType: 'json',
                    async: true,
                    success: function(rs) {
                        $('#isbn').val(rs.data.isbn);
                        $('#kd_buku').val(rs.data.id);
                        $('#kd_detail').val(rs.data.kd);

                    }
                });
            });
            $('#form_buku_detail').on('submit', function(e) {
                e.preventDefault();
                var id = $('#id').val();
                Swal.fire({
                    title: 'Yakin Menyimpan?',
                    text: "Anda akan menyimpan data buku",
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
                            type: 'POST',
                            data: $(this).serialize(),
                            dataType: 'JSON',
                            url: "{{ url('detail-buku') }}",
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

            $('.edit').click(function() {
                const id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ url('buku') }}/" + id,
                    async: true,
                    success: function(rs) {
                        console.log(rs);
                        $('#id').val(rs.data.isbn);
                        $('#e_kd_buku').val(rs.data.kd_buku);
                        $('#e_judul').val(rs.data.judul);
                        $('#e_pengarang').val(rs.data.pengarang);
                        $('#e_penerbit').val(rs.data.penerbit);
                        $('#e_th_terbit').val(rs.data.th_terbit);
                        $('#e_kategori').val(rs.data.kategori);
                    }
                });
            });

            $('#form_buku_update').on('submit', function(e) {
                e.preventDefault();
                var id = $('#id').val();
                Swal.fire({
                    title: 'Yakin Merubah?',
                    text: "Anda akan merubah data buku",
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
                            url: "{{ url('buku') }}/" + id,
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

            $('#form_buku').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin Menyimpan?',
                    text: "Anda akan menyimpan data buku",
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
                            url: "{{ url('buku') }}",
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
                            url: "{{ url('buku') }}/" + id,
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
