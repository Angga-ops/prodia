<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
class NewsController extends Controller
{
    public function index(){
        $request = Http::withHeaders([
            'Content-type' =>  'application/json',
            'Authorization' => ' Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiOTBiOWUxMzEtNjU3My00NzJlLTlhZjktNzU2NDNjYzNiYTQ0IiwicGFydG5lcl9pZCI6IjhhOWUwYWExLTE4YTMtNDIzYS1hN2M3LTQzY2JiOTk1ZjMxZCIsImVtYWlsIjoiYWRtaW5AcGVyc2FkaWEuY28uaWQiLCJpYXQiOjE2NTc1MTI0Mzh9.vRKKbO4Mm8DlY5NTcgXFTKBD5dt02onFvx8I9o4M0Ss',
        ])->get('http://103.214.53.148:51999/v1/news');
        $response = $request->getBody()->getContents();
        $data = json_decode($response,true);
        return View::make('content.news')->with(compact('data'));
    }
}
