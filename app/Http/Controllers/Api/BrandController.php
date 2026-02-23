<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    // 🔹 GET All Brands
    public function index()
    {
        $brands = Brand::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $brands
        ]);
    }

    // 🔹 STORE Brand
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'logo'   => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'status' => 'nullable|boolean'
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
        }

        $brand = Brand::create([
            'name'   => $request->name,
            'logo'   => $logoPath,
            'status' => $request->status ?? true
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Brand created successfully',
            'data' => $brand
        ], 201);
    }

    // 🔹 SHOW Single Brand
    public function show($id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json([
                'status' => false,
                'message' => 'Brand not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $brand
        ]);
    }

    // 🔹 UPDATE Brand
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json([
                'status' => false,
                'message' => 'Brand not found'
            ], 404);
        }

        $request->validate([
            'name'   => 'required|string|max:255',
            'logo'   => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('logo')) {

            // delete old logo
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }

            $brand->logo = $request->file('logo')->store('brands', 'public');
        }

        $brand->update([
            'name'   => $request->name,
            'status' => $request->status ?? $brand->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Brand updated successfully',
            'data' => $brand
        ]);
    }

    // 🔹 DELETE Brand
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            return response()->json([
                'status' => false,
                'message' => 'Brand not found'
            ], 404);
        }

        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return response()->json([
            'status' => true,
            'message' => 'Brand deleted successfully'
        ]);
    }
}