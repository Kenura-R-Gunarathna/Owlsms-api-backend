<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Role;
use App\Models\Api\v1\InstitutionsHasUsersHasRoles;
use Illuminate\Http\Request;
use App\Http\Requests\Api\v1\StoreUserRoleRequest;
use App\Http\Requests\Api\v1\UpdateUserRoleRequest;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'roles' => InstitutionsHasUsersHasRoles::Join('roles', 'institutions_has_users_has_roles.role_id', '=', 'roles.id')->where('user_id', $request->user()->id)->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRoleRequest $request)
    {
        $roles = InstitutionsHasUsersHasRoles::create([
            'user_id' => $request->user_id,
            'institution_id' => $request->institution_id,
            'role_id' => $request->role_id,
            'details' => json_encode($request->details),
        ]);

        return response()->json([
            'status' => 200,
            'message' => $roles
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRoleRequest $request, Role $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $roles)
    {
        //
    }
}
