<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Teacher_Subjects;
use Illuminate\Http\Request;

 
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $teacher = Teacher::all();
        return response()->json([
        "success" => true,
        "message" => "Teacher List",
        "data" => $teacher
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
        'name' => 'required',
        'email' => 'required|email|unique',
        'teacher_id_for_subjects' => 'required',
        'status' => 'required',
        ]);
        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }
        $teacher = Teacher::create($input);
        $teacher_id_for_subjects = $input->teacher_id_for_subjects;

        foreach ($input->teacher_id_for_subjects as $value){ 
            $teacher_Subjects = new Teacher_Subjects();
            $teacher_Subjects->teacher_id = $teacher->id;
            $teacher_Subjects->subject_id = $value;
            $teacher_Subjects->save();
        }

        return response()->json([
        "success" => true,
        "message" => "Teacher created successfully.",
        "data" => $teacher
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $teacher = Teacher::find($id);
        if (is_null($teacher)) {
        return $this->sendError('Subject not found.');
        }
        return response()->json([
        "success" => true,
        "message" => "Teacher retrieved successfully.",
        "data" => $teacher
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique',
            'teacher_id_for_subjects' => 'required',
            'status' => 'required',
            ]);

        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }
        $teacher->name = $input['name'];
        $teacher->email = $input['email'];
        $teacher->teacher_id_for_subjects = $teacher->id;
        $teacher->status = $input['status'];
        $teacher->save();

        foreach ($input->teacher_id_for_subjects as $value){ 
            $teacher_Subjects = Teacher_Subjects::where('teacher_id',$teacher->id);
            $teacher_Subjects->teacher_id = $teacher->id;
            $teacher_Subjects->subject_id = $value;
            $teacher_Subjects->save();
        }

        return response()->json([
        "success" => true,
        "message" => "Teacher updated successfully.",
        "data" => $teacher
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json([
        "success" => true,
        "message" => "Teacher deleted successfully.",
        "data" => $teacher
        ]);
    }
}
