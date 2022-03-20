<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Core\Requests;
use App\Model\Course;

class CourseController extends Controller {


    public function index(Requests $request){

        $obj = (new Course);

        $obj->initPagination(5, '/course', $request->page ?? 1);

        $courses =  $obj->all(['id','course_name','course_details']);

        $pagination = $obj->getPagination();

        return $this->view('course/index',compact('courses','pagination'));

    }


    public function create(){

        return $this->view('course/create');

    }

    public function store (Requests $request){

        $errors = $request->validate([
            
            'course_name' => 'required | string | min:2 | max: 20',

            'course_details' => 'required',

        ]);
        
        if(!empty($errors)){

            return $this->view('course/create',['errors' => $errors,'request'=>$request]);

        }

        $Course = new Course;

        $Course->course_name = $request->course_name;

        $Course->course_details = $request->course_details;


        $Course->create();
        
        return $this->redirect('/course',['success' => 'Course added successfully!']);

    }

    public function edit(Requests $request)
    {

        $id = $request->routeValue();
        $course = (new Course)->find($id);

        return $this->view("course/edit",['course' =>  $course,'id' =>  $id]);

    }

    public function update (Requests $request){

        $id = $request->routeValue();
        $errors = $request->validate([
            
            'course_name' => 'required',

            'course_details' => 'required',

        ]);
        
        if(!empty($errors)){

            return $this->redirect("/course/edit/$id", ['errors' => $errors, 'request' => $request ]);


        }

        $Course = new Course;

        $Course->course_name = $request->course_name;

        $Course->course_details = $request->course_details;

        $Course->update($id);
        
        return $this->redirect('/course',['success' => 'Course updated successfully!']);

    }


    public function delete(Requests $request){

        $id = $request->routeValue();
        $Course = (new Course);
        $Course->delete('DELETE FROM courses WHERE id = ?', [$id]);
        return $this->redirect('/course',['success' => 'Course deleted successfully!']);
    }

}