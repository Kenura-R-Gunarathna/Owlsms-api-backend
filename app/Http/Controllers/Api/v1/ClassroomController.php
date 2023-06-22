<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Classroom;
use App\Models\Api\v1\AuthCategories;
use Illuminate\Http\Request;
use App\Http\Requests\Api\v1\StoreClassroomRequest;
use App\Http\Requests\Api\v1\UpdateClassroomRequest;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $access = 'classrooms.index';

        return $this->check_auth_categories($request);

        try {

            return response()->json([
                'status' => 200,
                'classrooms' => Classroom::all()
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'internal server error'
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
    public function store(StoreClassroomRequest $request)
    {
        $classrooms = Classroom::create($request->all());

        return response()->json([
            'status' => 200,
            'message' => $classrooms
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $class)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classrooms)
    {
        $classrooms->update($request->all());

        return response()->json([
            'status' => true,
            'message' => $classrooms
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $class)
    {
        $class->delete();

        return response()->json([
            'status' => true,
            'message' => 'post deleted successfully'
        ], 200);
    }

    protected function check_auth_categories($request)
    {
        $auth_categories_id = $request->user()->auth_categories_id;

        return AuthCategories::where('id', $auth_categories_id)->value('name');
    }
}
