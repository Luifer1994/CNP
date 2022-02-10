<?php

namespace App\Http\Controllers;

use App\Http\Requests\CnpRequest;
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
    public function store(CnpRequest $request)
    {
        $newCnp = new Cnp();
        $newCnp->product_id             = $request->product_id;
        $newCnp->center_operation_id    = $request->center_operation_id;
        $newCnp->gondola                = $request->gondola;
        $newCnp->body_gondola           = $request->body_gondola;
        $newCnp->faces                  = $request->faces;
        $newCnp->level                  = $request->level;
        $newCnp->depth                  = $request->depth;

        if ($newCnp->save()) {
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