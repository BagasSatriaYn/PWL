<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
class PageController extends Controller
{
    public function index() {
    return 'Selamat Datang';
    }

    public function about(){
        return 'Nama : Bagas Satria YN || NIM : 2341760108';

    }

    public function articles($Id){
        return 'Halaman artikel dengan ID : ' . $Id;
    }  
}