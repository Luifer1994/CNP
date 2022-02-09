<?php

namespace App\Http\Controllers;

use App\Models\Cnp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CnpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "product_id"            => "required|exists:products,id",
            "center_operation_id"   => "required|exists:center_operations,id",
            "gondola"               => "required",
            "body_gondola"          => "required",
            "faces"                 => "required",
            "level"                 => "required",
            "depth"                 => "required",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (DB::table('cnps')->insert($request->all())) {
            return response()->json([
                "res" => true,
                "message" => "Registro exitoso"
            ], 200);
        } else {
            return response()->json([
                "res" => false,
                "message" => "Error al registrar"
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cnp  $cnp
     * @return \Illuminate\Http\Response
     */
    public function show(Cnp $cnp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cnp  $cnp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cnp $cnp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cnp  $cnp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cnp $cnp)
    {
        //
    }
}