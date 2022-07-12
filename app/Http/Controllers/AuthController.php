<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required'
            ]);
            // Return error messages and old data
            if ($validator->fails()) {
                return redirect('/login')
                            ->withErrors($validator)
                            ->withInput();
            }
            // Request to API 
            $requestAPI = Http::withHeaders([
                'Content-type' =>  'application/json',
                'Authorization' => ' Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiOTBiOWUxMzEtNjU3My00NzJlLTlhZjktNzU2NDNjYzNiYTQ0IiwicGFydG5lcl9pZCI6IjhhOWUwYWExLTE4YTMtNDIzYS1hN2M3LTQzY2JiOTk1ZjMxZCIsImVtYWlsIjoiYWRtaW5AcGVyc2FkaWEuY28uaWQiLCJpYXQiOjE2NTc1MTI0Mzh9.vRKKbO4Mm8DlY5NTcgXFTKBD5dt02onFvx8I9o4M0Ss',
            ])->post('http://103.214.53.148:51999/v1/login',[
                'email' => $request->email,
                'password' => $request->password
            ]);
            $response = $requestAPI->getBody()->getContents();
            $data = json_decode($response,true);
            // If request from API is false
            if ($data['success'] == false) {
                // Return message fail from API
                return redirect('/login')
                        ->with('failed',$data['message'])
                        ->withInput();
            }
            // Save token to global
            session(['token' => $data['currentUser']['token']]);
            return redirect('/');
        }
        return view('auth.login');
    }

    public function logout()
    {
        session()->forget('token');
        return redirect('/login');
    }
}
