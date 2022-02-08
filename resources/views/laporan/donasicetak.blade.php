@extends('laporan.master')
@section('content')
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

            </tr>
            </tr>
            <?php } ?>
        </tbody>
    </table>

@endsection
