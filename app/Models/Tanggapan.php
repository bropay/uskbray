<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Tanggapan extends Model
{

    use HasFactory;
    protected $guarded =['id'];
    protected $table = 'tanggapan';//agar nama tabel tetap
    public $timestamps =false;
    
    //Menangkap relasi dari petugas
    public function petugas():BelongsTo
    {
        return $this->belongsTo(Petugas::class,'id_petugas','id_petugas');
    }
    
    //Menangkap relasi dari pelanggaran
    public function pelanggaran():BelongsTo
    {
        return $this->belongsTo(Pelanggaran::class,'id_pelanggaran','id_pelanggaran');
    }
}