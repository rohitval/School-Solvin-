<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Subject = Subject::all();
        return response()->json([
        "success" => true,
        "message" => "Product List",
        "data" => $products
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
        'status' => 'required'
        ]);
        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }
        $Subject = Subject::create($input);
        return response()->json([
        "success" => true,
        "message" => "Subject created successfully.",
        "data" => $Subject
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id);
        if (is_null($subject)) {
        return $this->sendError('Subject not found.');
        }
        return response()->json([
        "success" => true,
        "message" => "Subject retrieved successfully.",
        "data" => $subject
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
        'name' => 'required',
        'status' => 'required'
        ]);
        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }
        $subject->name = $input['name'];
        $subject->status = $input['status'];
        $subject->save();
        return response()->json([
        "success" => true,
        "message" => "Subject updated successfully.",
        "data" => $subject
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json([
        "success" => true,
        "message" => "Subject deleted successfully.",
        "data" => $subject
        ]);
    }
}
