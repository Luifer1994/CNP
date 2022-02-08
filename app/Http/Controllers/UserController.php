<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function list()
    {
        $users = User::all();
        return response()->json([
            'res' => true,
            'data' => $users
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'is_admin'  => 'required|boolean',
            'password'  => 'required|min:5'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $newUser = new User();
        $newUser->name      = $request->name;
        $newUser->email     = $request->email;
        $newUser->is_admin  = $request->is_admin;
        $newUser->password  = Hash::make($request->password);

        if ($newUser->save()) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso'
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar'
            ], 400);
        }
    }

    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Laravel')->accessToken;
            return response()->json([
                'res' => true,
                'token' => $token,
                'message' => 'Bienvenido al sistema',
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Email o password incorrecto',
            ], 400);
        }
    }
}