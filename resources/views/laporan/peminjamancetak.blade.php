@extends('laporan.master')
@section('content')
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

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $b->tgl_perpanjang ? date('d M Y', strtotime($b->tgl_perpanjang)) : date('d M Y', strtotime($b->tgl_pinjam)) ?>
                </td>
                <td><?= $b->kd_peminjaman ?></td>
                <td><?= $b->nama ?></td>
                <td><?= $b->judul ?></td>
                <td><?= date('d M Y', strtotime($b->batas_pinjam)) ?></td>
                <td><?= $b->status_pinjam ?></td>
            </tr>
            </tr>
            <?php } ?>
        </tbody>
    </table>

@endsection
