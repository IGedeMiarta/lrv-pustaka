@extends('laporan.master')
@section('content')
    <table id="datatable2" class="table table-bordered table-striped table-hover table-datatable"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Tanggal Kembali </th>
                <th>Nomer Induk </th>
                <th>Nama Peminjam </th>
                <th>Kode Buku </th>
                <th>Judul Buku</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
                        foreach ($pengembalian as $b) { ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= date('d F Y', strtotime($b->tgl_kembali)) ?></td>
                <td><?= $b->nis ?></td>
                <td><?= $b->nama ?></td>
                <td><?= $b->kd_detail ?></td>
                <td><?= $b->judul ?></td>
                <td><?= $b->status_kembali ?></td>
            </tr>
            </tr>
            <?php } ?>
        </tbody>
    </table>
@endsection
