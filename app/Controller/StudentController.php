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
        return $this->view('contact');
    }

    public function create(Requests $request)
    {
        $errors = $request->validate([
            
            'first_name' => 'required | string | min:2 | max: 20',
            'last_name' => 'required | string | max: 20',
            'phone_no' => 'required | string | min:2 | max: 10',
            'dob' => 'required | date_format:Y-m-d ',

        ]);
        
        if(!empty($errors)){

            return $this->view('contact',['errors' => $errors]);

        }

        $student = new Student;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->dob = $request->dob;
        $student->contact_no = $request->contact_no;
        $student->create();
       
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
