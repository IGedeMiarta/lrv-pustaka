@extends('layouts.master')
@section('content')
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
                                <li class="breadcrumb-item active">Detail Buku</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Detail Buku</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->

            <div class="card">
                <div class="card-header">

                    <div class="card">
                        <div class="card-header bg-white" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('') }}images/book.png" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body bg-transparent">
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td> <b>Kode</b></td>
                                                <td width="5%"></td>
                                                <td>:</td>
                                                <td><b><?= $buku['kd_buku'] ?></b></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> Judul</td>
                                                <td></td>
                                                <td>:</td>
                                                <td><?= $buku['judul'] ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> Tahun Terbit</td>
                                                <td></td>
                                                <td>:</td>
                                                <td><?= $buku['th_terbit'] ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> Penulis</td>
                                                <td></td>
                                                <td>:</td>
                                                <td>{{ $buku->Pengarang->nama_pengarang }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td> Penerbit</td>
                                                <td></td>
                                                <td>:</td>
                                                <td>{{ $buku->Penerbit->nama_penerbit }}</td>
                                            </tr>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(auth()->user()->role == 'Petugas'){ ?>

                    <a href="#" class="btn btn-sm btn-success detail-buku" href="#" data-toggle="modal"
                        data-target="#exampleModal" data-id="<?= $id ?>"><i class="fa fa-plus"></i> Detail Buku</a>
                    <?php }?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable2" class="table table-bordered table-striped table-hover table-datatable">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="1%">No</th>

                                    <th>Kode</th>
                                    <th>Judul Buku</th>
                                    <th>Tahun Terbit</th>
                                    <th>Rak Buku</th>
                                    <th>Status</th>
                                    <th width="10%">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $no = 1;
                            foreach ($detail as $d) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d->kd_detail; ?></td>
                                    <td><?php echo $d->judul; ?></td>
                                    <td><?php echo $d->th_terbit; ?></td>
                                    <td><?php echo '<b>[ ' . $d->nama_rak . ' ] </b>' . $d->detail; ?></td>
                                    <td>
                                        <?php
                                        if ($d->status_buku == '1') {
                                            echo "<span class='badge badge-success'>Tersedia</span>";
                                        } else {
                                            echo "<span class='badge badge-warning'>Sedang Dipinjam</span>";
                                        }
                                        ?>
                                    </td>

                                    <?php if(auth()->user()->role == 'Petugas'){ ?>

                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <strong>Opsi</strong>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item edit" href="#" data-id="{{ $d->id_detail }}"
                                                    data-toggle="modal" data-target="#modalEdit"><i
                                                        class="far fa-fw fa-edit edit"></i>
                                                    Edit</a>
                                                <a class="dropdown-item delete" href="#" data-id="{{ $d->id_detail }}"><i
                                                        class="fas fa-fw fa-trash-alt "></i>
                                                    Hapus</a>
                                            </div>
                                        </div>
                                    </td>
                                    <?php }else{ ?>
                                    <td>
                                        <p class="text-center">-</p>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php
                                // }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div><!-- container -->


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
                            <input type="hidden" name="isbn" id="isbn">
                            <div class="form-group">
                                <label class="font-weight-bold" for="cari">Kode Buku</label>
                                <input type="text" class="form-control" id="kd_buku" name="kd_buku" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="cari">Kode Detail Buku</label>
                                <input type="text" class="form-control" id="kd_detail" name="kd_detail" value="" readonly>
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
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="form_buku_detail_update">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label class="font-weight-bold" for="cari">Kode Buku</label>
                                <input type="text" class="form-control" id="e_kd_buku" name="kd_buku" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="cari">Kode Detail Buku</label>
                                <input type="text" class="form-control" id="e_kd_detail" name="kd_detail" value=""
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="judul">Rak Buku</label>
                                <select name="rak" class="form-control" id="e_rak">
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
            $('.edit').click(function() {
                const id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ url('detail-buku') }}/" + id,
                    async: true,
                    success: function(rs) {
                        $('#id').val(rs.data.id_detail);
                        $('#e_kd_buku').val(rs.data.kd_buku);
                        $('#e_kd_detail').val(rs.data.kd_detail);
                        $('#e_rak').val(rs.data.rak);
                    }
                });
            });
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

            $('#form_buku_detail_update').on('submit', function(e) {
                e.preventDefault();
                var id = $('#id').val();
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
                            type: 'PUT',
                            data: $(this).serialize(),
                            dataType: 'JSON',
                            url: "{{ url('detail-buku') }}/" + id,
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
                            url: "{{ url('detail-buku') }}/" + id,
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
