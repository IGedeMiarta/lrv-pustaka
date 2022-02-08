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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Donation</a></li>
                                <li class="breadcrumb-item active">Donation</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Donation</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->



            <div class="card">
                <div class="card-header bg-primary text-center">
                    <h4 class="text-light">Tabel Donation</h4>
                </div>
                <div class="card-body bg-white">
                    <a href="" class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#exampleModal"><i
                            class="fas fa-plus"></i> Add</a>
                    <table id="datatable2" class="table table-bordered table-striped table-hover table-datatable"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Tanggal </th>
                                <th>Donatur</th>
                                <th>No Hp</th>
                                <th>Donasi</th>
                                <th>Detail</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;

                        foreach ($donasi as $b) { ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= date('d M Y', strtotime($b->tgl_donasi)) ?></td>
                                <td><?= $b->nama_donatur ?></td>
                                <td><?= $b->no_hp ?></td>
                                <td><?= isset($b->jml_donasi) ? 'Rp ' . number_format($b->jml_donasi) : 'BUKU - [' . $b->buku . '] ' . $b->judul ?>
                                </td>
                                <td><?= $b->keterangan ?></td>
                                <td><?= $b->status_donasi ?></td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <a href="#" class="btn btn-warning btn-sm edit-donasi" data-toggle="modal"
                                            data-id="{{ $b->id_donasi }}" data-target="#modelEdit"> <i
                                                class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $b->id_donasi }}"> <i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Donasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form_donasi" method="POST" action="">

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Donatur</label>
                                <div class="col-sm-10">
                                    <select name="donatur" id="donatur" class="form-control select2">
                                        <option>-Select Donatur</option>
                                        <?php foreach ($donatur as $d) : ?>
                                        <option value="<?= $d->id_donatur ?>"><?= $d->nama_donatur ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Donasi</label>
                                <div class="col-sm-10">
                                    <select name="jenis" id="jenis" class="form control select2" onchange="donasi()">
                                        <option>-Pilih</option>
                                        <option value="uang">Uang</option>
                                        <option value="buku">Buku</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row d-none" id="jumlah-donasi">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Donasi</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jml" name="jml">
                                </div>
                            </div>


                            <div class="form-group row d-none" id="kode-donasi">
                                <label for="horizontalInput1" class="col-sm-2 col-form-label">Kode Buku</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kd_buku" class="form-control" value="BK<?php echo sprintf('%04s', $kd_buku); ?>">
                                </div>
                            </div>

                            <div class="form-group row d-none" id="judul-donasi">
                                <label class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="judul" placeholder="Judul Buku">
                                </div>
                            </div>
                            <div class="form-group row d-none" id="tahun-donasi">
                                <label class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="tahun">
                                        <option value="">- Pilih tahun</option>
                                        <?php for ($tahun = date('Y'); $tahun >= 2010; $tahun--) { ?>
                                        <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row d-none" id="pengarang-donasi">
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
                            <div class="form-group row d-none" id="penerbit-donasi">
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
                            <div class="form-group row d-none" id="kategori-donasi">
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
                            <div class="form-group row d-none" id="rak-donasi">
                                <label class="col-sm-2 col-form-label">Rak</label>
                                <div class="col-sm-10">
                                    <select name="rak" class="form-control" id="">
                                        <option value="">--pilih</option>
                                        <?php foreach ($rak as $r) : ?>
                                        <option value="<?= $r->id_rak ?>"><?= $r->nama_rak . ' - ' . $r->detail ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row " id="keterangan-donasi">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Keterengan</label>
                                <div class="col-sm-10">
                                    <textarea name="ket" id="ket" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" id="status">
                                        <option value="">--Pilih</option>
                                        <option value="sumbangan">Sumbangan</option>
                                        <option value="denda">Denda</option>
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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Donatur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit_donasi" method="POST" action="">
                            <input type="hidden" class="form-control" id="e_id" name="id">
                            <input type="hidden" name="detail_donasi" id="detail_donasi">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Donatur</label>
                                <div class="col-sm-10">
                                    <select name="donatur" id="e_donatur" class="form-control ">
                                        <option>-Select Donatur</option>
                                        <?php foreach ($donatur as $d) : ?>
                                        <option value="<?= $d->id_donatur ?>"><?= $d->nama_donatur ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Donasi</label>
                                <div class="col-sm-10">
                                    <select name="jenis" id="e_jenis" class="form-control " onchange="donasi()">
                                        <option>-Pilih</option>
                                        <option value="uang">Uang</option>
                                        <option value="buku">Buku</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row d-none" id="e_jumlah-donasi">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah Donasi</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="e_jml" name="jml">
                                </div>
                            </div>

                            <input type="hidden" name="isbn" id="isbn">
                            <input type="hidden" name="id_detail" id="id_detail">
                            <div class="form-group row d-none" id="e_kode-donasi">
                                <label for="horizontalInput1" class="col-sm-2 col-form-label">Kode Buku</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kd_buku" class="form-control" id="e_kode" value="">
                                </div>
                            </div>

                            <div class="form-group row d-none" id="e_judul-donasi">
                                <label class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" id="e_judul" class="form-control" name="judul"
                                        placeholder="Judul Buku">
                                </div>
                            </div>
                            <div class="form-group row d-none" id="e_tahun-donasi">
                                <label class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="tahun" id="e_tahun">
                                        <option value="">- Pilih tahun</option>
                                        <?php for ($tahun = date('Y'); $tahun >= 2010; $tahun--) { ?>
                                        <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row d-none" id="e_pengarang-donasi">
                                <label class="col-sm-2 col-form-label">Pengarang</label>
                                <div class="col-sm-10">
                                    <select name="pengarang" id="e_pengarang" class="form-control">
                                        <option value="">--Pilih</option>
                                        <?php foreach ($pengarang as $k) : ?>
                                        <option value="<?= $k->kd_pengarang ?>"><?= $k->nama_pengarang ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row d-none" id="e_penerbit-donasi">
                                <label class="col-sm-2 col-form-label">Penerbit</label>
                                <div class="col-sm-10">
                                    <select name="penerbit" id="e_penerbit" class="form-control">
                                        <option value="">--Pilih</option>
                                        <?php foreach ($penerbit as $k) : ?>
                                        <option value="<?= $k->kd_penerbit ?>"><?= $k->nama_penerbit ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row d-none" id="e_kategori-donasi">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kategori" id="e_kategori" class="form-control">
                                        <option value="">--Pilih</option>
                                        <?php foreach ($kategori as $k) : ?>
                                        <option value="<?= $k->kd_kategori ?>"><?= $k->nama_kategori ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row d-none" id="e_rak-donasi">
                                <label class="col-sm-2 col-form-label">Rak</label>
                                <div class="col-sm-10">
                                    <select name="rak" class="form-control" id="e_rak">
                                        <option value="">--pilih</option>
                                        <?php foreach ($rak as $r) : ?>
                                        <option value="<?= $r->id_rak ?>"><?= $r->nama_rak . ' - ' . $r->detail ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row " id="e_keterangan-donasi">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Keterengan</label>
                                <div class="col-sm-10">
                                    <textarea name="ket" id="e_ket" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" id="e_status">
                                        <option value="">--Pilih</option>
                                        <option value="sumbangan">Sumbangan</option>
                                        <option value="denda">Denda</option>
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
            $('.btn-delete').on('click', function(e) {
                const id = $(this).data('id');
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin Menghapus?',
                    text: "Anda akan Menghapus data transaksi",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'DELETE',
                            data: $(this).serialize(),
                            dataType: 'JSON',
                            url: "{{ url('donasi') }}/" + id,
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

            $('.edit-donasi').on('click', function() {
                const id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ url('donasi') }}/" + id,
                    async: true,
                    success: function(rs) {
                        console.log(rs);
                        if (rs.data.buku === null && rs.data.jml_donasi !== null) {
                            var jenis = 'uang';
                            $('#e_jumlah-donasi').removeClass('d-none');
                            $('#e_judul-donasi').addClass('d-none');
                            $('#e_tahun-donasi').addClass('d-none');
                            $('#e_pengarang-donasi').addClass('d-none');
                            $('#e_penerbit-donasi').addClass('d-none');
                            $('#e_kategori-donasi').addClass('d-none');
                            $('#e_rak-donasi').addClass('d-none');
                            $('#e_jml').val(rs.data.jml_donasi);

                        } else {
                            var jenis = 'buku';
                            $('#e_jumlah-donasi').addClass('d-none');
                            $('#e_judul-donasi').removeClass('d-none');
                            $('#e_tahun-donasi').removeClass('d-none');
                            $('#e_pengarang-donasi').removeClass('d-none');
                            $('#e_penerbit-donasi').removeClass('d-none');
                            $('#e_kategori-donasi').removeClass('d-none');
                            $('#e_rak-donasi').removeClass('d-none');

                            $('#isbn').val(rs.data.buku.isbn);
                            $('#id_detail').val(rs.data.buku.detail_buku.id_detail);
                            $('#e_judul').val(rs.data.buku.judul);
                            $('#e_tahun').val(rs.data.buku.th_terbit);
                            $('#e_pengarang').val(rs.data.buku.pengarang);
                            $('#e_penerbit').val(rs.data.buku.penerbit);
                            $('#e_kategori').val(rs.data.buku.kategori);
                            $('#e_rak').val(rs.data.buku.detail_buku.rak);

                        }
                        $('#e_id').val(rs.data.id_donasi);
                        $('#detail_donasi').val(rs.data.detail.id_detail_donasi);
                        $('#e_donatur').val(rs.data.donatur.id_donatur);
                        $('#e_jenis').val(jenis);
                        $('#e_ket').val(rs.data.detail.keterangan);
                        $('#e_status').val(rs.data.detail.status);

                        // $('#e_nama').val(data.nama_donatur);
                        // $('#e_jenkel').val(data.jenkel);
                        // $('#e_hp').val(data.no_hp);
                        // $('#e_alamat').val(data.alamat);

                    }
                })
            });

            function donasi() {
                var jenis = $('#jenis').val();
                if (jenis == 'uang') {
                    $('#jumlah-donasi').removeClass('d-none');
                    $('#judul-donasi').addClass('d-none');
                    $('#tahun-donasi').addClass('d-none');
                    $('#pengarang-donasi').addClass('d-none');
                    $('#penerbit-donasi').addClass('d-none');
                    $('#kategori-donasi').addClass('d-none');
                    $('#rak-donasi').addClass('d-none');

                }
                if (jenis == 'buku') {
                    $('#jumlah-donasi').addClass('d-none');
                    $('#judul-donasi').removeClass('d-none');
                    $('#tahun-donasi').removeClass('d-none');
                    $('#pengarang-donasi').removeClass('d-none');
                    $('#penerbit-donasi').removeClass('d-none');
                    $('#kategori-donasi').removeClass('d-none');
                    $('#rak-donasi').removeClass('d-none');
                }
            }
            $('#edit_donasi').on('submit', function(e) {
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
                            url: "{{ url('donasi') }}/" + id,
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

            $('#form_donasi').on('submit', function(e) {
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
                            url: "{{ url('donasi') }}",
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
        </script>
    @endsection
