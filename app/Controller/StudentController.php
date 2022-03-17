<?php

namespace App\Controller;

use App\Core\Requests;
use App\Core\RouteServiceProvider;

class StudentController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return $this->view('contact');
    }

    public function create()
    {

        return "Form submited!";
    }

    public function show()
    {

        $parmas = [
            'first_name' => 'Arun',
            'last_name' => 'M',
            'email' => 'arun@yahoo.com'
        ];
        return $this->view('view_contact',$parmas);
    }
}
