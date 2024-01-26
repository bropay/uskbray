@extends('layouts.user') @section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Siswa &nbsp;
    </div>
    <div class="card-body">
        <form role="search" method="get" action="/admin/siswa">
            @csrf Cari data &nbsp;<input type="text" name="search" class="form-control d- inline" id="search" placeholder="Masukkan NIS" maxlength="10" style="width:150px; height:32px; border-radius:4px; -moz-border-radius:4px;"">
            <button type="submit" class="btn btn-success btn-sm">Cari</button>
        </form>
        <br />
        @if ($data->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="datatablesSimple">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($data as $dt)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $dt->nis }}</td>
                        <td>{{ $dt->nama }}</td>
                        <td>{{ $dt->kelas }}</td>
                        
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
