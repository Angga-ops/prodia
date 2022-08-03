<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
class NewsController extends Controller
{
    private $BASE_URL = 'http://103.214.53.148:51999/v1/news';
    public function index(){
        $request = Http::withHeaders([
            'Accept' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
        ])->get($BASE_URL.'news');
        $response = $request->getBody()->getContents();
        $data = json_decode($response,true);
        return View::make('content.news')->with(compact('data'));
    }
}
