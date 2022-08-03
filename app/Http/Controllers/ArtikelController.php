<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
class ArtikelController extends Controller
{
    private $baseUrl =  'http://103.214.53.148:51999/v1/article';
    public function index(Request $request){
        $request = Http::withHeaders([
            'Content-type' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
        ])->get($this->baseUrl);
        $response = $request->getBody()->getContents();
        $data = json_decode($response,true);
        
        return View::make('content.artikel')->with(compact('data'));
    }

    public function addArticle(){

    }

    public function editArticle(Request $request,$article_id)
    {
        $path = $request->file('foto')->store('images');
        if ($request->file('foto') != null) {
            $requestApi = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'multipart/form-data',
                'Authorization' => ' Bearer '.session('token'),
            ])->withOptions([
                'query' => [
                    'article_id' => $article_id
                ]
            ])->put($this->baseUrl,[
                'title' => $request->judul,
                'content' => $request->konten,
                'publish_date' => $request->tgl_publish,
                'file' => $request->file('foto')
            ]);
            $response = $requestApi->getBody()->getContents();
            $data = json_decode($response,true);
            dd($response);
            if ($data['success']) {
                return redirect()->back()->with('success',$data['message']);
            }
            return redirect()->back()->with('error',$data['message']);
        }
        $requestApi = Http::withHeaders([
            'Content-type' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
        ])->withOptions([
            'query' => [
                'article_id' => $article_id
            ]
        ])->put($this->baseUrl,[
            'title' => $request->judul,
            'content' => $request->konten,
            'publish_date' => $request->tgl_publish
        ]);
        $response = $requestApi->getBody()->getContents();
        $data = json_decode($response,true);
        if ($data['success']) {
            return redirect()->back()->with('success',$data['message']);
        }
        return redirect()->back()->with('error',$data['message']);
    }

    public function destroy($article_id){
        $request = Http::withHeaders([
            'Accept' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
            ])->withOptions([
                'query' => [
                    'article_id' => $article_id
                    ]
                    ])->delete($this->baseUrl);
                    $response = $request->getStatusCode();
                    $data = json_decode($request->getBody(),true);
                    
                    // dd($data);
                    if($data['success']){
                        return redirect()->back()
                        ->with('success',$data['message']);
                    }
                }
            }
            
            // public function datatables()
            // {
            //     $request = Http::withHeaders([
            //         'Content-type' =>  'application/json',
            //         'Authorization' => ' Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiOTBiOWUxMzEtNjU3My00NzJlLTlhZjktNzU2NDNjYzNiYTQ0IiwicGFydG5lcl9pZCI6IjhhOWUwYWExLTE4YTMtNDIzYS1hN2M3LTQzY2JiOTk1ZjMxZCIsImVtYWlsIjoiYWRtaW5AcGVyc2FkaWEuY28uaWQiLCJpYXQiOjE2NTc1MTI0Mzh9.vRKKbO4Mm8DlY5NTcgXFTKBD5dt02onFvx8I9o4M0Ss',
            //     ])->get('http://103.214.53.148:51999/v1/article');
            //     $response = $request->getBody()->getContents();
            //     $json = json_decode($response,true);
            //     $json['data'] = $json['data']['fb'];
            //     $json['draw'] = 0;
            //     $json['recordsTotal'] = count($json['data']);
            //     $json['recordsFiltered'] = count($json['data']);
            //     unset($json['status']);
            //     unset($json['success']);
            //     return json_encode($json);
            // }