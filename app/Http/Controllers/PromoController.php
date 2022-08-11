<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;
class PromoController extends Controller
{
    private $base_url = 'http://103.214.53.148:51999/v1/promo';

    public function index(Request $request){

        // $request = Http::withToken(session('token'))->get($this->base_url);
        //     $response = $request->getBody()->getContents();
        //     $data = json_decode($response,true);
        //     return DataTables::of($data['promotion'])
        //     ->addIndexColumn()
        //     ->addColumn('action', function($row){
        //         $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
        //         return $btn;
        //     })
        //     ->rawColumns(['action'])
        //     ->make(true);

        $request = Http::withHeaders([
            'Content-type' =>  'application/json',
            'Authorization' => ' Bearer '. session('token'),
        ])->get($this->base_url);
        $response = $request->getBody()->getContents();
        $data = json_decode($response,true);
        $cr = new Carbon();
        $cr::setLocale('id');
        return View::make('content.promo',[
            'data' => $data,
            'carbon' => $cr
        ]);
    }

    public function tables()
    {
        $request = Http::withToken(session('token'))->get($this->base_url);
            $response = $request->getBody()->getContents();
            $data = json_decode($response,true);

            return DataTables::of($data['promotion'])
            ->addIndexColumn()
            ->addColumn('action', function($row){
                '<div class="d-flex flex-sm-column flex-md-row justify-content-center">';
                $btn = '<a href="javascript:void(0)" class="btn btn-xs mx-1 btn-info">Sunting</a>';
                $btn = $btn.'<a href="javascript:void(0)" class="btn btn-danger btn-xs mx-1">Hapus</a>';
                '</div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
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
    public function datatable(){
        $request = Http::withToken(session('token'))->get($this->baseUrl);
            $response = $request->getBody()->getContents();
            $data = json_decode($response,true);
            dd($data);
            return DataTables::of($result)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function add(Request $request)
    {
        
        if ($request->file('image') != null) {
            $requestApi = Http::withToken(session('token'))
            ->send('POST',$this->base_url,[
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => Utils::tryFopen($request->file('image')->getRealPath(),'r')
                    ],
                    [
                        'name' => 'title',
                        'contents' => $request->title
                    ],
                    [
                        'name' => 'content',
                        'contents' => $request->content
                    ],
                    [
                        'name' => 'date_start',
                        'contents' => $request->date_start
                    ],
                    [
                        'name' => 'date_end',
                        'contents' => $request->date_end
                    ]
                ]
            ]);
            $response = json_decode($requestApi->getBody()->getContents(),true);
            return redirect('/content/promo')->with('success',$response['message']);
        }    
        $requestApi = Http::withToken(session('token'))->post($this->base_url,[
            'title' => $request->title,
            'content' => $request->content,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end
        ]);
        $response = json_decode($requestApi->getBody()->getContents(),true);
        return redirect('/content/promo')->with('success',$response['message']);
    }

    
    public function edit(Request $request,$promo_id)
    {
        // dd($request);
        if ($request->file('image') != null) {
            $requestApi = Http::withToken(session('token'))->withOptions([
                'query' => [
                    'promotion_id' => $promo_id 
                ]
            ])->send('PUT',$this->base_url,[
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => Utils::tryFopen($request->file('image')->getRealPath(),'r')
                    ],
                    [
                        'name' => 'title',
                        'contents' => $request->title
                    ],
                    [
                        'name' => 'content',
                        'contents' => $request->content
                    ],
                    [
                        'name' => 'date_start',
                        'contents' => $request->date_start
                    ],
                    [
                        'name' => 'date_end',
                        'contents' => $request->date_end
                    ]
                ]
            ]);
            $response = json_decode($requestApi->getBody()->getContents(),true);
            if ($response['success']) {
                return redirect()->back()->with('success',$response['message']);
            }
            return redirect()->back()->with('error',$response['message']);
        }    
        $requestApi = Http::withToken(session('token'))->withOptions([
            'query' => [
                'promotion_id' => $promo_id 
            ]
        ])->put($this->base_url,[
            'title' => $request->title,
            'content' => $request->content,
            'date_end' => $request->date_start,
            'date_start' => $request->date_end
        ]);
        $response = json_decode($requestApi->getBody()->getContents(),true);
        if ($response['success']) {
            return redirect()->back()->with('success',$response['message']);
        }
        return redirect()->back()->with('error',$response['message']);
    }

}