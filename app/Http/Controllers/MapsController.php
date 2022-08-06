<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function index(){
        return view('content.maps');
    }
    public function add(){
        return view('form.maps.tambah.index');
    }
    public function store(){

    }
}
