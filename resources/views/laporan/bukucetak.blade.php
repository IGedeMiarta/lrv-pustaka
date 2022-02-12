@extends('laporan.master')
@section('content')

    <table cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th width="1px">No</th>
                <th>Kode</th>
                <th width="30%">Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Kategori</th>
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

            </tr>
            <?php } ?>
        </tbody>
    </table>

@endsection
