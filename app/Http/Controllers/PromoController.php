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

        $request = Http::withHeaders([
            'Content-type' =>  'application/json',
            'Authorization' => ' Bearer '. session('token'),
        ])->get($this->base_url);
        $response = $request->getBody()->getContents();
        $data = json_decode($response,true);
        return View::make('content.promo')->with(compact('data'));
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

    public function add(Request $request)
    {
        // dd([
        //     'title' => $request->title,
        //     'content' => $request->content,
        //     'end_date' => $request->date_start,
        //     'start_date' => $request->date_end,
        //     'image' => $request->file('image')
        // ]);
        // storage_path('app/').$path
        // dd(file_get_contents($request->file('image')->getPathname()));
        $path = $request->file('image')->store('images');
    
        $requestApi = Http::withHeaders([
            'Accept' =>  'application/json',
            'Authorization' => ' Bearer '. session('token'),
        ])->attach('image',file_get_contents($request->file('image')))->
            post($this->base_url,[
            'title' => $request->title,
            'content' => $request->content,
            'end_date' => $request->date_start,
            'start_date' => $request->date_end
        ]);
        $response = json_decode($requestApi->getBody()->getContents(),true);
        return redirect('/content/promo')->with('success',$response['message']);
    }

}