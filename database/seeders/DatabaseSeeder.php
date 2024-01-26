<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatePetugasSeeder extends Seeder
{
    /**
    * Run the database seeds.
    */
    public function run(): void
    {
    //
    $users =[
        [
            'id_petugas' => 'admin1',
            'nama' => 'Administrator',
            'username' =>'admin',
            'password' => bcrypt('admin123'),
            'telp' => '08561329833',
            'level'=>'admin',
        ],
        [
            'id_petugas' => 'gurubk1',
            'nama' => 'Guru BK',
            'username' =>'grbk',
            'password' => bcrypt('guru123'),
            'telp' => '085693941041',
            'level'=>'gurubk',
        ],
    ];
    foreach ($users as $key =>$val){
        Petugas::create($val);
        }
    }
}