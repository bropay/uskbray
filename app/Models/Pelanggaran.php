<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pelanggaran extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $table = 'pelanggaran';
    public $timestamps =false;
    
    protected $casts =[
        'tgl_pelanggaran' =>'date',
    ];
    
    //Menangkap relasi dari siswa
    public function siswa():BelongsTo
    {
        return $this->belongsTo(Siswa::class,'nis','nis');
    }
    
    //Mengirim relasi ke tanggapan
    public function tanggapan():HasOne
    {
        return $this->hasOne(Tanggapan::class,'id_pelanggaran','id_pelanggaran');
    }
}