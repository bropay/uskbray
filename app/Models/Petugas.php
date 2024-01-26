<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Petugas extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded =['id'];
    protected $table = 'petugas';//agar nama tabel tetap
    public $timestamps =false;//agar tidak menambahkan created_at updated_at
    
    protected $fillable = [
    'id_petugas',
    'nama',
    'username',
    'password',
    'telp',
    'level',
];
    protected $hidden = [
    'password',
    'remember_token',
];
    protected $casts = [
    'password' => 'hashed',
];

//Mengirim relasi ke tanggapan
public function tanggapan():HasMany
    {
        return $this->hasMany(Tanggapan::class,'id_petugas','id_petugas');
    }
}