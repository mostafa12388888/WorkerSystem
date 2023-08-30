<?php

namespace App\Http\Controllers\API;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login', 'register']]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $admin = Auth::user();

        return response()->json([
            'admin' => $admin,
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
                'email' => 'required|string|email|max:255|unique:admins',
                'password' => 'required|string|min:6',
            ]);

            $admin = admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'message' => 'admin created successfully',
                'admin' => $admin
            ]);
        }

        public function logout()
        {
            Auth::logout();
            return response()->json([
                'message' => 'Successfully logged out',
            ]);
        }

        public function refresh()
        {
            return response()->json([
                'admin' => Auth::user(),
                'authorisation' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
        ]);
}
}
