<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    //
    public function register(Request $request)

    {
        //register user
        $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|string',
            'password'=> 'required|string',
            'telpon'=>'required|numeric|'
        ]);
        $user = new User([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' =>$request->email,
            'gender'=>$request->gender,
            'telpon'=>$request->telpon
        ]);
      
        
        $user->save();
        return response()->json(['message' => 'user registered']);
}

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        $email = $credentials['email'];
        $password = $credentials['password'];

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email tidak terdaftar'
            ], 401);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'message' => 'Password salah'
            ], 401);
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if (!$tokenResult) {
            return response()->json([
                'message' => 'Gagal membuat token'
            ], 500);
        }

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}

