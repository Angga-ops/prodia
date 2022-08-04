<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
class ArtikelController extends Controller
{
    private $baseUrl =  'http://103.214.53.148:51999/v1/article';
    public function index(Request $request){
        $request = Http::withToken(session('token'))->get($this->baseUrl);
        $response = $request->getBody()->getContents();
        $data = json_decode($response,true);
        $cr = new Carbon();
        $cr::setLocale('id');
        return View::make('content.artikel',[
            'data' => $data,
            'carbon' => $cr
        ]);
    }

    public function addArticle(Request $request){
        $addArticle =  Http::withToken(session('token'))
        ->acceptJson()
        ->send('POST',$this->baseUrl,[
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => Utils::tryFopen($request->file('foto')->getRealPath(),'r')
                ],
                [
                    'name' => 'title',
                    'contents' => $request->judul
                ],
                [
                    'name' => 'content',
                    'contents' => $request->konten
                ],
                [
                    'name' => 'publish_date',
                    'contents' => $request->tgl_publish
                ]
            ]
        ]);
        $response = json_decode($addArticle->getBody()->getContents(),true);
        if($response['success']){
            return redirect()->back()->with('success',$response['message']);
        }
        
    }

    public function editArticle(Request $request,$article_id)
    {
        if ($request->file('foto') != null) {
            $requestApi = Http::withToken(session('token'))->acceptJson()->withOptions([
                'query' => [
                    'article_id' => $article_id
                ],
            ])->send('PUT',$this->baseUrl,[
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => Utils::tryFopen($request->file('foto')->getRealPath(),'r')
                    ],
                    [
                        'name' => 'title',
                        'contents' => $request->judul
                    ],
                    [
                        'name' => 'content',
                        'contents' => $request->konten
                    ],
                    [
                        'name' => 'publish_date',
                        'contents' => $request->tgl_publish
                    ]
                ]
            ]);
            $response = $requestApi->getBody()->getContents();
            $data = json_decode($response,true);
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