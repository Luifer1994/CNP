<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function findBarcode(Request $request)
    {
        $rules = [
            "bar_code" => "required"
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $barcode = Barcode::where('cod', $request->bar_code)->first();
        if ($barcode) {
            return response()->json([
                "res" => true,
                "data" => $barcode->product
            ], 200);
        } else {
            return response()->json([
                "res" => false,
                "menssage" => "No se encontraron registros"
            ], 400);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}