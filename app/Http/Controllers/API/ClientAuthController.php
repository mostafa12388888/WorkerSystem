<?php

namespace App\Http\Controllers\API;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits_function\upload_Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    use upload_Attachment;
    public function __construct()
    {
        $this->middleware('auth:clinet', ['except' => ['login', 'register']]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $token = Auth::guard('clinet')->attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $clinet = Auth::guard('clinet')->user();

        return response()->json([
            'clinet' => $clinet,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                ]
            ]);
        }

        public function register(Request $request)
        {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:clients',
                'password' => 'required|string|min:6',
                'photo.*' => 'required|image|mimes:jpg,bmp,png'

            ]);
// dd(34);
// this
            $clinet = Client::create([
                'name' => $request->name,
                'email' => $request->email,

                'password' => Hash::make($request->password),
            ]);
            $this->upload_Attachment_photo($request,"photo","App\Models\clinet",$clinet->id,"Worker","clinet");
            return response()->json([
                'message' => 'clinet created successfully',
                'clinet' => $clinet
            ]);
        }

        public function logout()
        {
            Auth::guard('clinet')->logout();
            return response()->json([
                'message' => 'Successfully logged out',
            ]);
        }

        public function refresh()
        {
            return response()->json([
                'clinet' => Auth::guard('clinet')->user(),
                'authorisation' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
        ]);
}
}
