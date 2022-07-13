<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
class PromoController extends Controller
{
    public function index(){
        $request = Http::withHeaders([
            'Content-type' =>  'application/json',
            'Authorization' => ' Bearer '. session('token'),
        ])->get('http://103.214.53.148:51999/v1/promo');
        $response = $request->getBody()->getContents();
        $data = json_decode($response,true);
        
        return View::make('content.promo')->with(compact('data'));
    }
    public function dtPromo(){
        $request = Http::withHeaders([
            'Content-type' =>  'application/json',
            'Authorization' => ' Bearer'.session('token'),
        ])->get('http://103.214.53.148:51999/v1/promo');
        $response = $request->getBody()->getContents();
        $json = json_decode($response,true);
        $json['data'] = $json['data'];
        $json['draw'] = 0;
        $json['recordsTotal'] = count($json['data']);
        $json['recordsFiltered'] = count($json['data']);
        unset($json['status']);
        unset($json['success']);
        return json_encode($json);
    }
}
