<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Validator;
use App\Models\Student_Subjects;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::all();
        return response()->json([
        "success" => true,
        "message" => "Student List",
        "data" => $student
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
        'student_id_for_subjects' => 'required',
        'status' => 'required',
        ]);
        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }
        $student = Student::create($input);
        $student_id_for_subjects = $input->student_id_for_subjects;

        foreach ($input->student_id_for_subjects as $value){ 
            $student_Subjects = new Student_Subjects();
            $student_Subjects->student_id = $student->id;
            $student_Subjects->subject_id = $value;
            $student_Subjects->save();
        }

        return response()->json([
        "success" => true,
        "message" => "Student created successfully.",
        "data" => $student
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student = Student::find($id);
        if (is_null($subject)) {
        return $this->sendError('Subject not found.');
        }
        return response()->json([
        "success" => true,
        "message" => "Student retrieved successfully.",
        "data" => $student
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique',
            'student_id_for_subjects' => 'required',
            'status' => 'required',
        ]);
        
        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }
        $student->name = $input['name'];
        $student->email = $input['email'];
        $student->student_id_for_subjects = $student->id;
        $student->status = $input['status'];
        $student->save();

        foreach ($input->student_id_for_subjects as $value){ 
            $student_Subjects = Student_Subjects::where('student_id',$student->id);
            $student_Subjects->student_id = $student->id;
            $student_Subjects->subject_id = $value;
            $student_Subjects->save();
        }

        return response()->json([
        "success" => true,
        "message" => "student updated successfully.",
        "data" => $student
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json([
        "success" => true,
        "message" => " deleted successfully.",
        "data" => $student
        ]);
    }
}
