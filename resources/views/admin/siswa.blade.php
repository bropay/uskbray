@extends('layouts.user') @section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Siswa &nbsp;<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#siswa">Tambah</button>
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
                        <th>Proses Data</th>
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
                        <td>
                            <a class="btn btn-warning btn-sm" href="/admin/siswa/edit/{{ $dt->id }}"data-bs-toggle="modal" data-bs-target="#ubah{{ $dt->id }}">Ubah</a>
                            <a class="btn btn-danger btn-sm" href="/admin/siswa/delete/{{ $dt->id }}"data-bs-toggle="modal" data-bs-target="#hapus{{ $dt->id }}">Hapus</a>
                        </td>
                    </tr>
<!-- Modal Hapus -->
<div class="modal fade" id="hapus{{ $dt->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title fs-5">Hapus Data Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">
                    Apakah anda yakin menghapus siswa
                    <span> <font color="blue">{{ $dt->nama }} </font> </span>
                </h4>
            </div>
            <div class="modal-footer">
                <form action="/admin/siswa/{{ $dt->id }}" method="POST">
                    @csrf @method('delete')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak Jadi</button>
                    <button type="submit" class="btn btn-danger">Hapus!</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ubah Siswa-->

<div class="modal fade" id="ubah{{ $dt->id }}" tabindex="-1" data-bs- backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Siswa</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-depot-form" action="/admin/siswa/{{ $dt->id }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nis" value="{{ $dt->nis }}" />
                                <label for="floatingInputGrid">NIS Siswa</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row g-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nm" value="{{ $dt->nama }}" />
                                <label for="floatingInputGrid">Nama Siswa</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row g-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="kls" value="{{ $dt->kelas }}" />
                                <label for="floatingInputGrid">Kelas</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>Tidak ada Data</p>
        @endif
    </div>
</div>
<!-- Modal Input Siswa-->

<div class="modal fade" id="siswa" tabindex="-1" data-bs-backdrop="static" data- bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria- label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-depot-form" action="/admin/siswa" method="POST">
                    @csrf
                    <div class="row g-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nis" placeholder="masukkan nis siswa" />

                                <label for="floatingInputGrid">NIS Siswa</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row g-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nm" placeholder="masukkan nama siswa" />

                                <label for="floatingInputGrid">Nama Siswa</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row g-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="kls" placeholder="masukkan kelas" />

                                <label for="floatingInputGrid">Kelas</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs- dismiss="modal">Tutup</button>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endsection