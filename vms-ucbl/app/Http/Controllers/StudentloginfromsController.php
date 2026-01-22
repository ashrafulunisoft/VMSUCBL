<?php

namespace App\Http\Controllers;

use App\Models\studentloginfroms;
use Illuminate\Http\Request;
use App\Models\Student;



class StudentloginfromsController extends Controller
{
 public function index() // or create() depending on your route
{
    $studentloginfroms = StudentLoginFroms::all(); // get all students
    return view('student.create');

}
    
public function create() // or index, depending on your route
{
    $studentloginfroms = StudentLoginFroms::all(); // get all records
    return view('student.create'); // pass it to Blade
}
    public function store(Request $request)
    {
      $validateData= $request ->validate([

      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'email' => 'required|email|unique:studentloginfroms,email',
      ]);
      studentloginfroms::create($validateData);
    return redirect()->route('student.create')->with('success', 'Student added successfully');
    }
    // Delete student
    public function destroy($id)
    {
    $student=studentloginfroms::findOrFail($id);
    $student->delete();
    return redirect()->back()->with('sucess','Student deleted successfully');
    }


}
