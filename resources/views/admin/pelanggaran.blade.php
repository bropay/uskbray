@extends('layouts.user') @section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Pelanggaran
    </div>
    <div class="card-body">
        @if ($data->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="datatablesSimple">
                <thead class="table-dark">			{{-- judul dari setiap kolom tabel --}}
			{{-- judul dari setiap kolom tabel --}}
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>NIS</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>ID Pelanggaran</th>
                        <th>Tanggal Pelanggaran</th>
                        <th>Isi Pelanggaran</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- isi tabel --}}
                    <?php $no = 1; ?>
                    @foreach ($data as $dt)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>foto</td>
                        <td>{{ $dt->nis }}</td>
                        <td>{{ $dt->siswa->nama }}</td>
                        <td>{{ $dt->siswa->kelas }}</td>
                        <td>{{ $dt->id_pelanggaran }}</td>
                        <td>{{ $dt->tgl_pelanggaran }}</td>
                        <td>{{ $dt->isi_pelanggaran }}</td>
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