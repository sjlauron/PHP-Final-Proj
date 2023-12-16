<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function getAllStudents()
    {
        return Student::all();
    }

    public function addStudent(Request $request)
    {
        try
        {
            $student = new Student;
            $student->name = $request->name;
            $student->grade = $request->grade;
            
            $student->save();

            return response()->json(["message"=>"successfully added student."], 201);
        }
        
        catch(\Exception $e)
        {
            return response()->json(["message"=>$e->getMessage()], 500);
        }
    }

    public function updateStudent(Request $request, $id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                return response()->json(["message" => "Student not found"], 404);
            }

            $student->name = $request->name;
            $student->grade = $request->grade;

            $student->save();

            return response()->json(["message" => "Successfully updated student."], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function deleteStudent($id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                return response()->json(["message" => "Student not found"], 404);
            }

            $student->delete();

            return response()->json(["message" => "Successfully deleted student."], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function generateCsrfToken()
    {
        // Use the csrf_token() function to generate the CSRF token
        $token = csrf_token();
        
        // If you want to store it in the session for later use
        Session::put('_token', $token);

        return $token;
    }
}
