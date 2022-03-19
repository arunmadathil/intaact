<?php

namespace App\Controller;

use App\Core\Requests;
use App\Model\Student;

class StudentController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        return $this->view('student/create');
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

            return $this->view('contact',['errors' => $errors,'request'=>$request]);

        }

        $student = new Student;

        $student->first_name = $request->first_name;

        $student->last_name = $request->last_name;

        $student->dob = $request->dob;

        $student->contact_no = $request->contact_no;

        $student->create();
       
    }

    public function edit(Requests $request)
    {
        $id = $request->routeValue();
        $student = (new Student)->find($id);

        return $this->view('student/edit',['student' =>  $student]);
    }

    public function update(Requests $request)
    {
        $errors = $request->validate([
            
            'first_name' => 'required | string | min:2 | max: 20',

            'last_name' => 'required | string | max: 20',

            'contact_no' => 'required | integer | min:2 | max: 10',

            'dob' => 'required | date_format:Y-m-d ',

        ]);

        $id = $request->routeValue();
        $student = (new Student);
        

        $student->first_name = $request->first_name;

        $student->last_name = $request->last_name;

        $student->dob = $request->dob;

        $student->contact_no = $request->contact_no;

        $student->update($id);

    }


    public function show()
    {

        $parmas = [

            'first_name' => 'Arun | string | max:20 | min: 2',

            'last_name' => 'M | string',

            'email' => 'arun@yahoo.com | email | max:50 | min:1'
        ];

        return $this->view('view_contact',$parmas);
    }
}
