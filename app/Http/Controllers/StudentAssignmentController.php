<?php

namespace App\Http\Controllers;

use App\Models\StudentAssignment;
use Illuminate\Http\Request;

class StudentAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentAssignment = StudentAssignment::all();
        return response()->json([
        "success" => true,
        "message" => "studentAssignment List",
        "data" => $studentAssignment
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
        'teacher_id' => 'required',
        'subject_id' => 'required|unique',
        'assigned_students' => 'required',
        'status' => 'required',
        ]);
        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }
        $studentAssignment = StudentAssignment::create($input);
        return response()->json([
        "success" => true,
        "message" => "StudentAssignment created successfully.",
        "data" => $studentAssignment
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentAssignment  $studentAssignment
     * @return \Illuminate\Http\Response
     */
    public function show(StudentAssignment $studentAssignment)
    {
        $studentAssignment = StudentAssignment::find($id);
        if (is_null($studentAssignment)) {
        return $this->sendError('Subject not found.');
        }
        return response()->json([
        "success" => true,
        "message" => "StudentAssignment retrieved successfully.",
        "data" => $studentAssignment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentAssignment  $studentAssignment
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentAssignment $studentAssignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentAssignment  $studentAssignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentAssignment $studentAssignment)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'teacher_id' => 'required',
            'subject_id' => 'required|unique',
            'assigned_students' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }
        $studentAssignment->teacher_id = $input['teacher_id'];
        $studentAssignment->subject_id = $input['subject_id'];
        $studentAssignment->assigned_students = $input['assigned_students'];
        $studentAssignment->status = $input['status'];
        $studentAssignment->save();
        
        return response()->json([
        "success" => true,
        "message" => "StudentAssignment updated successfully.",
        "data" => $studentAssignment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentAssignment  $studentAssignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentAssignment $studentAssignment)
    {
        $studentAssignment->delete();
        return response()->json([
        "success" => true,
        "message" => "studentAssignment deleted successfully.",
        "data" => $studentAssignment
        ]);
    }
}
