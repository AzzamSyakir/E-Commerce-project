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

if (!Auth::attempt($credentials))
    return response()->json([
        'message' => 'Unauthorized'
    ], 401);

$user = $request->user();
$tokenResult = $user->createToken('Personal Access Token');
$token = $tokenResult->token;

if ($request->remember_me)
    $token->expires_at = Carbon::now()->addWeeks(1);

$token->save();

return response()->json([
    'access_token' => $tokenResult->accessToken,
    'token_type' => 'Bearer',
    'expires_at' => Carbon::parse(
        $tokenResult->token->expires_at
    )->toDateTimeString()
]);
}
}

