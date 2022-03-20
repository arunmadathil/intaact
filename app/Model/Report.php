<?php

namespace App\Model;

use App\Core\Model;

class Report extends Model
{

    public $id = 0;
    public $first_name = '';
    public $last_name = '';
    public $dob = '';
    public $contact_no = '';
    public $primaryKey = 'id';
    public function tableName(): string
    {
        return 'course_subscribe';
    }

    public function tableColumns(): array
    {
        return ['course_id', 'student_id'];
    }

}
