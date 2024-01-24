<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {

            $user = Auth::user();
            $success['token'] = $user->createToken('User Token')->accessToken;
            $success['data'] = $user;

            return $this->successResponse($success);
        }

        return $this->failureResponse(['error' => 'Unauthorization or user is not found.']);


    }

    public function register(Request $request)
    {
        $user = new User;
        $user->name = $request->get('login');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        $token = $user->createToken('Access Token')->accessToken;
        $data = [
            'user' => $user,
            'access_token' => $token,
        ];

        return $this->successResponse($data);
    }

    public function getBasket(Request $request)
    {
        $products = json_decode($request->get('products'));


        $basket = Product::products($products);

        return $this->successResponse([
            'count' => count($products),
            'basket' => $basket
        ]);
    }
}
