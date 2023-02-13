<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        //register user
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'telpon' => 'required|numeric|'
        ]);
        $user = new User([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'gender' => $request->gender,
            'telpon' => $request->telpon
        ]);

        $role = Role::firstOrCreate(['name' => 'pembeli', 'guard_name' => 'web']);
        $user->assignRole($role);

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
    //admin

    //product
    public function addProduct(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        if (!Auth::user()->hasRole('penjual')) {
            return response()->json(['message' => 'need admin permissions'], 403);
        }
        $product = new product;
        $product->image = $request->file('image')->store('images');
        $product->nameProduct = $request->input('nameProduct');
        $product->save();
        return response()->json([
            'message' => 'product add successfully'
        ]);
    }
    public function listProduct()
    {
        $products = product::select('nameProduct')->get();
        return response()->json($products);
    }
}