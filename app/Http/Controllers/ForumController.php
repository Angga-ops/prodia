<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
class ForumController extends Controller
{
    private $base_forum = 'http://103.214.53.148:51999/v1/forum';
    private $category = 'http://103.214.53.148:51999/v1/category';

    public function index(){
        $request = Http::withHeaders([
            'Accept' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
        ])->get($this->base_forum);
        $response = $request->getBody()->getContents();
        $forum = json_decode($response,true);
        return View::make('content.forum')->with(compact('forum'));
    }
    public function post(Request $request){
        $response = Http::withHeaders([
            'Accept' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
        ])->post($this->base_forum,[
            'title' => $request->judul,
            'category' => $request->category,
            'content' => $request->konten,
        ]);
        return json_decode($response->getBody()->getContents(),true);
        
    }
    public function add(){
        $reqCat = Http::withHeaders([
            'Accept' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
        ])->get($this->category);
        $response = $reqCat->getBody()->getContents();
        $cat = json_decode($response,true);
        
        return View::make('form.forum.tambah.index')->with(compact('cat'));
     }
     public function detail($forum_id){
        $request = Http::withHeaders([
            'Accept' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
        ])->withOptions([
            'query' => [
                'forum_id' => $forum_id
            ]
        ])->get($this->base_forum.'/reply');
        $response = $request->getBody()->getContents();
        $detail['data'] = json_decode($response,true);
    
        return View::make('form.forum.detail.index')->with(compact('detail'));
     }

     public function reply($forum_id, Request $request){
        $reply = Http::withHeaders([
            'Accept' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
        ])->withOptions([
            'query' => [
                'forum_id' => $forum_id
            ]
        ])->post($this->base_forum.'/reply', [
            'content' => $request->balas
        ]);
        $response = json_decode($reply->getBody()->getContents(),true);
        if ($response['success']) {
            return redirect()->back();
        }
     }

    public function deleteReply($forum_reply_id){
        $deleteReply = Http::withHeaders([
            'Accept' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
        ])->withOptions([
            'query' => [
                'forum_reply_id' => $forum_reply_id
            ]
        ])->delete($this->base_forum.'/reply/masterdelete');
        $response = $deleteReply->getStatusCode();
        $data = json_decode($deleteReply->getBody(),true);
        if($data['success']){
            return redirect()->back()
                        ->with('success',$data['message']);
        }
    }

    public function delete($forum_id){
        $request = Http::withHeaders([
            'Accept' =>  'application/json',
            'Authorization' => ' Bearer '.session('token'),
        ])->withOptions([
            'query' => [
                'forum_id' => $forum_id
            ]
        ])->delete($this->base_forum.'/masterdelete');
        $response = $request->getStatusCode();
        $data = json_decode($request->getBody(),true);

        if($data['success']){
            return redirect('/content/forum')
                        ->with('success',$data['message']);
        }
    }
}
