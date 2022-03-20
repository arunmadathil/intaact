<?php

namespace App\Controller;

use App\Core\Requests;
use App\Core\RouteServiceProvider;
use App\Model\Student;

class StudentController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $students = (new Student)->all(['id','first_name','last_name']);
        
        return $this->view('student/index',compact('students'));
    }

    public function create(){

        return $this->view('student/create');
    }

    public function store(Requests $request)
    {
        $errors = $request->validate([
            
            'first_name' => 'required | string | min:2 | max: 20',

            'last_name' => 'required | string | max: 20',

            'contact_no' => 'required | integer | min:2 | max: 10',

            'dob' => 'required | date_format:Y-m-d ',

        ]);
        
        if(!empty($errors)){

            return $this->view('student/create',['errors' => $errors,'request'=>$request]);

        }

        $student = new Student;

        $student->first_name = $request->first_name;

        $student->last_name = $request->last_name;

        $student->dob = $request->dob;

        $student->contact_no = $request->contact_no;

        $student->create();
       
    }

    public function edit($request)
    {
        $id = $request->routeValue();
        $student = (new Student)->find($id);

        return $this->view("student/edit",['student' =>  $student,'id' =>  $id]);
    }

    public function update(Requests $request)
    {
        $id = $request->routeValue();
        $errors = $request->validate([
            
            'first_name' => 'required | string | min:2 | max: 20',

            'last_name' => 'required | string | max: 20',

            'contact_no' => 'required | min:2 | max: 10',

            'dob' => 'required | date_format:Y-m-d ',

        ]);
        
        if(!empty($errors)){
            return $this->redirect("/student/edit/$id", ['errors' => $errors, 'request' => $request ]);
        }

       
        $student = (new Student);
        

        $student->first_name = $request->first_name;

        $student->last_name = $request->last_name;

        $student->dob = $request->dob;

        $student->contact_no = $request->contact_no;

        $student->update($id);

        $this->redirect('/student');

    }

    public function delete(){
        
    }
}
