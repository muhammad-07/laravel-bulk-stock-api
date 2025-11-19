<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ])->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('vue-token')->accessToken;
        return response()->json(['user'=>$user,'token'=>$token], 201);
    }

    public function login(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!auth()->attempt($request->only('email','password'))) {
            return response()->json(['message'=>'Invalid credentials'], 401);
        }
        $user = auth()->user();
        $token = $user->createToken('vue-token')->accessToken;
        return response()->json(['user'=>$user,'token'=>$token]);
    }

    public function logout(Request $request)
    {
        if ($request->user() && $request->user()->token()) {
            $request->user()->token()->revoke();
        }
        return response()->json(['message'=>'Logged out']);
    }
}
