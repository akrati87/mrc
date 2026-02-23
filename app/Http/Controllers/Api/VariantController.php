<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variant;

class VariantController extends Controller
{
    public function index()
    {
        return response()->json(
            Variant::with('product')->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'sku' => 'required|unique:variants,sku',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'status' => 'required|boolean'
        ]);

        $variant = Variant::create($validated);

        return response()->json([
            'message' => 'Variant created successfully',
            'data' => $variant
        ], 201);
    }

    public function show($id)
    {
        return response()->json(
            Variant::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $variant = Variant::findOrFail($id);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'sku' => 'required|unique:variants,sku,' . $id,
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'status' => 'required|boolean'
        ]);

        $variant->update($validated);

        return response()->json([
            'message' => 'Variant updated successfully',
            'data' => $variant
        ]);
    }

    public function destroy($id)
    {
        Variant::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Variant deleted successfully'
        ]);
    }
}