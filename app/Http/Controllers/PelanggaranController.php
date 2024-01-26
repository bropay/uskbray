<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     //Memanggil data pelanggaran dan menampilkan view halaman pelanggaran
    public function index()
    {
        //
        $data = Pelanggaran::paginate(10);
        $dataSiswa = Siswa::all();
        $user = Auth::user();
        if ($user->level == 'admin') {
            return view('admin.pelanggaran', compact('data'));
        } elseif ($user->level == 'gurubk') {
            return view('guru.pelanggaran', compact('data', 'dataSiswa'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    
     //Menyimpan data pelanggaran
    public function store(Request $request)
    {
        $this->validate($request, [
            'idpel' => 'required',
            'nis' => 'required',
            'tgl' => 'required',
            'isi' => 'required',
            'foto' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
                //proses upload gambar
        if (Pelanggaran::where('id_pelanggaran', '=', $request->idpel)->count() > 0) {
            toastr()->error('Id Pelanggaran sudah ada');
            return redirect('/guru/pelanggaran');
        } else {
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $image->move(public_path('foto'), $image->getClientOriginalName());
                $simpan = Pelanggaran::create([
                    'id_pelanggaran' => $request->idpel,
                    'nis' => $request->nis,
                    'tgl_pelanggaran' => $request->tgl,
                    'isi_pelanggaran' => $request->isi,
                    'foto' => $image->getClientOriginalName(),
                ]);
            } elseif ($request->file('foto') == "") {
                toastr()->error('Foto pelanggaran wajib dilampirkan');
                return redirect('/guru/pelanggaran');
            }
        }
        if ($simpan) {
            //redirect dengan pesan sukses
            toastr()->success('data pelanggaran sukses di simpan');
            return redirect('/guru/pelanggaran');
        } else {
            //redirect dengan pesan error
            toastr()->error('data pelanggaran gagal di simpan');
            return redirect('/guru/pelanggaran');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

     //Mengubah data pelanggaran
     public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    //Mencari data pelanggaran
    public function search(Request $request)
    {
        $keyword = $request->search;
        $data = Pelanggaran::where('nis', 'like', "%" . $keyword . "%")->paginate(5);
        $dataSiswa = Siswa::all();
        return view('guru.pelanggaran', compact(['data','dataSiswa']))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
