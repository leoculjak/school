<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudent;
use App\mClass;
use App\Student;
use DB;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Student::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudent $request)
    {
        // Get free classes
        $classes = DB::table('classes AS c')
            ->join('students AS s', 's.class_id', '=', 'c.id', 'left')
            ->groupBy('c.id', 'c.max_students')
            ->having(DB::raw('COUNT(s.id)'), '<', DB::raw('c.max_students'))
            ->select('c.id', 'c.max_students', DB::raw('COUNT(s.id) as total_students'))
            ->pluck('id')
            ->toArray();

        // Create student instance
        $student = (new Student())->fill($request->all());

        // Check if the class has room for the student
        if( ! in_array($request->input('class_id'), $classes))
        {
            // If there are no classes with available places...
            if(empty($classes))
            {
                // Create new class
                $class = mClass::create(['year' => '1', 'max_students' => '3']);
                $student->class_id = $class->id;
            }
            else
            {
                // Use first available class
                $student->class_id = $classes[0];
            }
        }

        // Save it to the database
        $student->save();

        return response()->json($student);
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
}
