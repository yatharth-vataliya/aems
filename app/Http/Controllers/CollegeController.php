<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colleges=College::orderBy('id','asc')->paginate(10);
        return view('college.show_college',compact('colleges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('college.create_college');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'college_name'=>'required|string|max:150',
            'department'=>'required|string|max:150',
            'course'=>'required|array'
        ],
        [
            'college_name.required'=>"College Name Is Required",
        ]
    );

        foreach($request->input('course') as $course){
            if($course==NULL){
                $errors[]="All The Fields are Required";
                return back()->withErrors(compact('errors'));
            }
        }

        foreach($request->input('course') as $course){
            College::create([
                'college_name'=>$request->input('college_name'),
                'department'=>$request->input('department'),
                'course'=>$course
            ]);
        }

        return redirect()->route('college.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(College $college)
    {
        $college->changeStatus();
        return redirect()->route('college.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getColleges(){
        $colleges=College::select('college_name')->distinct()->where('status','active')->get();
        echo "<option value=''>-select-College</option>";
        foreach($colleges as $college){
            echo "<option value='{$college->college_name}'>{$college->college_name}</option>";
        }
    }

    public function getDepartments(){
        $departments=College::select('department')->distinct()->where('status','active')->get();
        echo "<option value=''>-select-Department</option>";
        foreach($departments as $department){
            echo "<option value='{$department->department}'>{$department->department}</option>";
        }
    }

    public function getCourses(){
        $courses=College::select('course')->distinct()->where('status','active')->get();
        echo "<option value=''>-select-Course</option>";
        foreach($courses as $course){
            echo "<option value='{$course->course}'>{$course->course}</option>";
        }
    }

    public function getDepartment(Request $request){
        $departments=College::select('department')->distinct()->where('status','active')->where('college_name',$request->input('collegeName'))->get();
        echo "<option value=''>--select--</option>";
        foreach($departments as $department){
            echo "<option value='{$department->department}'>{$department->department}</option>";
        }
    }

    public function getCourse(Request $request){
        $courses=College::select('course')->distinct()->where(['college_name'=>$request->input('collegeName'),'department'=>$request->input('department'),'status'=>'active'])->get();
        echo "<option value=''>--select--</option>";
        foreach($courses as $course){
            echo "<option value='{$course->course}'>{$course->course}</option>";
        }   
    }
}
