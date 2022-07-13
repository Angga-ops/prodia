<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
class PromoController extends Controller
{
    private $base_url = 'http://103.214.53.148:51999/v1/promo';

    public function index(Request $request){
        
        if ($request->isMethod('post')) {
            $this->add($request);
            return;
        }

        $request = Http::withHeaders([
            'Content-type' =>  'application/json',
            'Authorization' => ' Bearer '. session('token'),
        ])->get($this->base_url);
        $response = json_decode($request->getBody()->getContents(),true);
        return View::make('content.promo',['data' => $response]);
    }

    public function delete($promo_id)
    {
        $request = Http::withHeaders([
            'Content-type' =>  'application/json',
            'Authorization' => ' Bearer '. session('token'),
        ])->withOptions([
            'query' => [
                'promotion_id' => $promo_id
            ]
        ])->delete($this->base_url);
        $response = json_decode($request->getBody()->getContents(),true);
        return redirect()->back()->with('success',$response['message']);
    }

    private function add(Request $request)
    {
        $requestApi = Http::withHeaders([
            'Accept' =>  'application/json',
            'Content-Type' => 'multipart/form-data',
            'Authorization' => ' Bearer '. session('token'),
        ])->post($this->base_url,[
            'multipart' => [
                'title' => $request->title,
                'content' => $request->content,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'image' => $request->file('image')
            ]
        ]);
        $response = json_decode($requestApi->getBody()->getContents(),true);
        dd($response);
        return redirect()->back()->with('success',$response['message']);
    }

}