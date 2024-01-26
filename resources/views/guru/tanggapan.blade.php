@extends('layouts.user') @section('content')
<div class="card mb-4">
    <div class="card-header"><i class="fas fa-table me-1"></i>DataTable Tanggapan &nbsp;<a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahTanggapan">Tambah</a></div>
    <div class="card-body">
        <form role="search" method="get" action="/guru/tanggapan">
            @csrf Cari data &nbsp;<input type="text" name="search" class="form-control d-inline" id="search" placeholder="ID Pelanggaran" maxlength="10" style="width: 150px; height: 32px; border-radius: 4px; -moz-border-radius: 4px;" />

            <button type="submit" class="btn btn-success btn-sm">Cari</button>
        </form>
        <br />
        @if ($data->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="datatablesSimple">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>ID Tanggapan</th>
                        <th>ID Pelanggaran</th>
                        <th>NIS Siswa</th>
                        <th>Tanggal Tanggapan</th>
                        <th>Pelanggaran</th>
                        <th>Isi Tanggapan</th>
                        <th>ID Petugas</th>
                        <th>Petugas</th>
                        <th>Proses Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($data as $dt)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $dt->id_tanggapan }}</td>
                        <td>{{ $dt->id_pelanggaran }}</td>
                        <td>{{ $dt->pelanggaran->nis }}</td>
                        <td>{{ $dt->tgl_tanggapan }}</td>
                        <td>{{ $dt->pelanggaran->isi_pelanggaran }}</td>
                        <td>{{ $dt->isi_tanggapan }}</td>
                        <td>{{ $dt->id_petugas }}</td>
                        <td>{{ $dt->petugas->nama }}</td>
                        <td>
                            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah{{ $dt->id }}">Ubah</a>

                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus{{ $dt->id }}">Hapus</a>
                        </td>
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
<!-- Modal Input Tanggapan-->
<div class="modal fade" id="tambahTanggapan" tabindex="-1" data-bsbackdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tanggapan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-depot-form" action="/guru/tanggapan" method="POST">
                    @csrf
                    <div class="row g-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-control" name="idpel">
                                    <option> -- pilih id pelanggaran --</option>
                                    @foreach ($dapel as $pel)
                                    <option value="{{ $pel->id_pelanggaran }}" name="id">
                                        {{ $pel->id_pelanggaran }} => {{ $pel->nis }} => {{$pel->isi_pelanggaran}}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="floatingInputGrid">Pelanggaran oleh Siswa:</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="idtang" placeholder="id tanggapan" />
                                <label for="floatingInputGrid">Id Tanggapan:</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input min="2021-01-01" type="date" class="form-control" name="tgl" placeholder="tanggal tanggapan" />
                                <label for="floatingInputGrid">Tanggal Tanggapan:</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row g-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="idp" value="{{ Auth::user()->id_petugas }}" disabled />
                                <label for="floatingInputGrid">Id Petugas:</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row g-1">
                        <div class="col-md">
                            <label>Isi Tanggapan:</label>
                            <textarea class="form-control scrollable" rows="5" name="isi"></textarea>
                        </div>
                    </div>
                    <br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($data as $dt)
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
<!-- Modal Ubah Tanggapan-->
<div class="modal fade" id="ubah{{ $dt->id }}" tabindex="-1" data-bsbackdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Tanggapan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-depot-form" action="/guru/tanggapan/{{ $dt->id }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <select class="form-control" name="idpel">
                                    <option value="{{ $dt->id_pelanggaran }}">
                                        {{ $dt->id_pelanggaran }} => {{ $dt->pelanggaran->nis }} => {{ $dt->pelanggaran->isi_pelanggaran }}
                                    </option>
                                    @foreach ($dapel as $pel)
                                    <option value="{{ $pel->id_pelanggaran }}" name="id">
                                        {{ $pel->id_pelanggaran }} => {{ $pel->nis }} => {{ $pel->isi_pelanggaran }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="floatingInputGrid">Pelanggaran oleh Siswa:</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="idtang" value="{{ $dt->id_tanggapan }}" />
                                <label for="floatingInputGrid">Id Tanggapan:</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input min="2021-01-01" type="date" class="form-control" name="tgl" value="{{ $dt->tgl_tanggapan }}" />
                                <label for="floatingInputGrid">Tanggal Tanggapan:</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    {{-- <div class="row g-1">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="idp" value="{{ Auth::user()->id_petugas }}" disabled />
                                <label for="floatingInputGrid">Id Petugas:</label>
                            </div>
                        </div>
                    </div> --}}
                    <br />
                    <div class="row g-1">
                        <div class="col-md">
                            <label>Isi Tanggapan:</label>
                            @isset($dt)
                            <textarea class="form-control scrollable" name="isi" rows="5" required>{{ $dt->isi_tanggapan }}</textarea>
                            @else
                            <textarea class="form-control scrollable" name="isi" rows="5" required></textarea>
                            @endIf
                        </div>
                    </div>
                    <br />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach @endsection
