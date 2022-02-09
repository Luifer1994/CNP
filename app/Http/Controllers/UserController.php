<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $rules = [
            'name'      => 'required',
            'password'  => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // Obtenemos al usuario a autenticar
        $user = User::where('email', $request->email)->first();

        // Vemos si las credenciales son erróneas para retornar un mensaje de error
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Laravel')->accessToken;
            return response()->json([
                'res' => true,
                'token' => $user->createToken('CNP')->plainTextToken,
                'message' => 'Bienvenido al sistema',
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Email o password incorrecto',
            ], 400);
        }
    }

    public function logout()
    {
        //Obtenemos usuario logeado
        $user = Auth::user();
        //Busca todos los token del usuario en la base de datos y los eliminamos;
        $user->tokens->each(function ($token) {
            $token->delete();
        });
        return response()->json([
            'res' => true,
            'message' => 'Hasta la vista Baby',
        ], 200);
    }
}