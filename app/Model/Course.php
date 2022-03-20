<?php

namespace App\Model;

use App\Core\Model;
use App\Core\Requests;

class Course extends Model
{

    public $id = 0;
    public $course_name = '';
    public $course_details = '';
    public $primaryKey = 'id';

    public function tableName(): string
    {
        return 'courses';
    }

    public function tableColumns(): array
    {
        return ['course_name', 'course_details'];
    }


    public function storeSubscriptions($subscriptions)
    {
        try{
            $sql = "insert into course_subscribe(student_id, course_id) values(:student_id, :course_id)";
            $statement = $this->prepareQuery($sql);
                foreach($subscriptions as  $sub){
                   
                        $statement->bindParam(':student_id', $sub['student']);
                        $statement->bindParam(':course_id', $sub['course']);
                        $statement->execute();
                }
        }catch(\PDOException $e){
            echo 'Something went wrong in the query';             
        }
    }

}
