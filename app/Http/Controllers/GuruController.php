<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Menampilkan view guru
    function index(){
        // echo 'Selamat datang';
        // echo '<h1>'. Auth::user()->nama .'</h1>';
        // echo "<br><a href='logout'>logout</a>";
        return view('guru.index');
    }
}
