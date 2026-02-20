<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPermission;
use App\Models\User;
use App\Models\Permission;

class UserPermissionController extends Controller
{
    // 🔹 GET All
    public function index()
    {
        $data = UserPermission::with(['user', 'permission'])->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // 🔹 STORE
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $data = UserPermission::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Permission assigned successfully',
            'data' => $data
        ], 201);
    }

    // 🔹 SHOW
    public function show($id)
    {
        $data = UserPermission::with(['user', 'permission'])->find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // 🔹 UPDATE
    public function update(Request $request, $id)
    {
        $data = UserPermission::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $data->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Updated successfully',
            'data' => $data
        ]);
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        $data = UserPermission::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Record not found'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
