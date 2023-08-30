<?php

namespace App\Http\Controllers\API;

use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\register_request;
use App\Mail\erficationemailorker;
use App\Traits_function\upload_Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;

class workerAuthController extends Controller
{
    use upload_Attachment;
    public function __construct()
    {
        $this->middleware('auth:worker', ['except' => ['login', 'register','vefication']]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $token = Auth::guard('worker')->attempt($credentials);
if(!Worker::whereEmail($request->email)->first()->status){
return response()->json(["message"=>"your emial is not worked"],422);
}
        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $Worker = Auth::guard('worker')->user();

        return response()->json([
            'Worker' => $Worker,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                ]
            ]);
        }

        public function register(register_request $request)
        {

try{
    DB::beginTransaction();
            $token_hash=substr(md5(random_int(0,9).$request->email.time()),0,32);
            // dd($token_hash);
            $Worker = Worker::create([
                'name' => $request->name,
                'email' => $request->email,
                'location' => $request->location,
                'phone' => $request->phone,
                'verificatio_token'=>$token_hash,
                'password' => Hash::make($request->password),
            ]);
            $this->upload_Attachment_photo($request,"photo","App\Models\Worker",$Worker->id,"Worker","Worker");
            Mail::to($request->email)->send(new erficationemailorker( $Worker->name, $Worker->verificatio_token));
            DB::commit();
            return response()->json([
                'message' => 'Worker created successfully',
                'Worker' => $Worker
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
        }

        public function logout()
        {
            Auth::guard('worker')->logout();
            return response()->json([
                'message' => 'Successfully logged out',
            ]);
        }

        public function refresh()
        {
            return response()->json([
                'Worker' => Auth::guard('worker')->user(),
                'authorisation' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
        ]);
}
public function vefication($toke){
    $tokem=Worker::where('verificatio_token',$toke)->first();
    if(!$tokem){
        return response()->json(["message"=>"this is Email Not token in this App"],401);
    }
    $tokem->update([
        'verificatio_token'=>null,
        'status'=>1,
        'verified_at'=>now()
    ]);
    return response()->json([
        "message"=>"succefull",
        'message' => 'Worker created successfully',
        'Worker' => $tokem
],404);
}
}
