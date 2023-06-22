<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Institution;
use App\Models\Api\v1\AuthCategories;
use App\Models\Api\v1\Role;
use App\Models\Api\v1\InstitutionsHasUsersHasRoles;
use Illuminate\Http\Request;
use App\Http\Requests\Api\v1\StoreInstitutionRequest;
use App\Http\Requests\Api\v1\UpdateInstitutionRequest;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $access = 'institutions.index';

        try {
            if ($this->check_auth_categories($request) == "admin") {
                return response()->json([
                    'status' => 200,
                    'institutions' => Institution::all()
                ], 200);
            } else if ($this->check_auth_categories($request) == "user") {

                $permissions = json_decode(InstitutionsHasUsersHasRoles::leftJoin('roles', 'institutions_has_users_has_roles.role_id', '=', 'roles.id')->where('user_id', $request->user()->id)->pluck('permissions'));

                if (in_array($access, $permissions)) {
                    return response()->json([
                        'status' => 200,
                        'institutions' => Institution::leftJoin('institutions_has_users_has_roles', 'institution.id', '=', 'institutions_has_users_has_roles.institution_id')->where('user_id', $request->user()->id)->get()
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 403,
                        'message' => 'forbidden'
                    ], 403);
                }
            } else {
                return response()->json([
                    'status' => 403,
                    'message' => 'forbidden'
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'internal server error : '
            ], 403);
        }
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
    public function store(StoreInstitutionRequest $request)
    {
        try {
            if ($this->check_auth_categories($request) == "admin") {

                $institution = Institution::create($request->all());

                return response()->json([
                    'status' => 200,
                    'message' => $institution
                ], 200);
            } else {
                return response()->json([
                    'status' => 403,
                    'message' => 'forbidden'
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'internal server error'
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            if ($this->check_auth_categories($request) == "admin") {
                return response()->json([
                    'status' => 200,
                    'institutions' => Institution::where('id', $request->institution)->first()
                ], 200);
            } else {
                return response()->json([
                    'status' => 403,
                    'message' => 'forbidden'
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'internal server error'
            ], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institution $institution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstitutionRequest $request, Institution $institution)
    {
        try {
            if ($this->check_auth_categories($request) == "admin") {

                $institution->update($request->all());

                return response()->json([
                    'status' => 200,
                    'message' => $institution
                ], 200);
            } else {
                return response()->json([
                    'status' => 403,
                    'message' => 'forbidden'
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'internal server error'
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Institution $institution)
    {
        try {
            if ($this->check_auth_categories($request) == "admin") {

                $institution->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'institution deleted successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 403,
                    'message' => 'forbidden'
                ], 403);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'internal server error'
            ], 403);
        }
    }

    protected function check_auth_categories($request)
    {
        $auth_categories_id = $request->user()->auth_category_id;

        return AuthCategories::where('id', $auth_categories_id)->value('name');
    }
}
