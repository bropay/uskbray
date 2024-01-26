@extends('layouts.user') @section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Tanggapan
    </div>
    <div class="card-body">
        @if ($data->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="datatablesSimple">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Tanggapan</th>
                        <th>ID Pelanggaran</th>
                        <th>Tanggal Tanggapan</th>
                        <th>Isi Tanggapan</th>
                        <th>ID Petugas</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($data as $dt)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $dt->id_tanggapan }}</td>
                        <td>{{ $dt->id_pelanggaran }}</td>
                        <td>{{ $dt->tgl_tanggapan }}</td>
                        <td>{{ $dt->isi_tanggapan }}</td>
                        <td>{{ $dt->id_petugas }}</td>
                        <td>{{ $dt->petugas->nama }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>Tidak ada Data</p>
        @endif
    </div>
</div>
@endsection