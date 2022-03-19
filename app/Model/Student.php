<?php

namespace App\Model;

use App\Core\Model;

class Student extends Model
{

    public $id = 0;
    public $first_name = '';
    public $last_name = '';
    public $dob = '';
    public $contact_no = '';

    public function tableName(): string
    {
        return 'students';
    }

    public function tableColumns(): array
    {
        return ['first_name', 'last_name', 'dob', 'contact_no'];
    }
}
