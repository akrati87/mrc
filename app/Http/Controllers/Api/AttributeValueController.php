<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $values = AttributeValue::with('attribute')->get();
        return response()->json($values);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string',
            'status' => 'required|boolean'
        ]);

        $value = AttributeValue::create($request->all());

        return response()->json([
            'message' => 'Attribute value created successfully',
            'data' => $value
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $value = AttributeValue::findOrFail($id);
        return response()->json($value);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $value = AttributeValue::findOrFail($id);

        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string',
            'status' => 'required|boolean'
        ]);

        $value->update($request->all());

        return response()->json([
            'message' => 'Attribute value updated successfully',
            'data' => $value
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $value = AttributeValue::findOrFail($id);
        $value->delete();

        return response()->json([
            'message' => 'Attribute value deleted successfully'
        ]);
    }
}
