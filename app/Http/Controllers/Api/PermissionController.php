<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return response()->json(Permission::latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $permission = Permission::create($request->all());

        return response()->json([
            'message' => 'Permission created successfully',
            'data' => $permission
        ]);
    }

    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return response()->json($permission);
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

        $permission->update($request->all());

        return response()->json([
            'message' => 'Permission updated successfully',
            'data' => $permission
        ]);
    }

    public function destroy($id)
{
    $permission = Permission::findOrFail($id);

    $permission->delete();

    return response()->json([
        'status' => true,
        'message' => 'Permission deleted successfully'
    ], 200);
}

}
