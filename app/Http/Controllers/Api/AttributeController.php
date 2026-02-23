<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    // 🔹 GET All
    public function index()
    {
        $attributes = Attribute::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $attributes
        ]);
    }

    // 🔹 STORE
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'nullable|boolean'
        ]);

        $attribute = Attribute::create([
            'name'   => $request->name,
            'status' => $request->status ?? true
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Attribute created successfully',
            'data' => $attribute
        ], 201);
    }

    // 🔹 SHOW
    public function show($id)
    {
        $attribute = Attribute::find($id);

        if (!$attribute) {
            return response()->json([
                'status' => false,
                'message' => 'Attribute not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $attribute
        ]);
    }

    // 🔹 UPDATE
    public function update(Request $request, $id)
    {
        $attribute = Attribute::find($id);

        if (!$attribute) {
            return response()->json([
                'status' => false,
                'message' => 'Attribute not found'
            ], 404);
        }

        $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'nullable|boolean'
        ]);

        $attribute->update([
            'name'   => $request->name,
            'status' => $request->status ?? $attribute->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Attribute updated successfully',
            'data' => $attribute
        ]);
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        $attribute = Attribute::find($id);

        if (!$attribute) {
            return response()->json([
                'status' => false,
                'message' => 'Attribute not found'
            ], 404);
        }

        $attribute->delete();

        return response()->json([
            'status' => true,
            'message' => 'Attribute deleted successfully'
        ]);
    }
}