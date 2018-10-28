<?php

namespace Home\Model;

use Think\Model\ViewModel;

class StudentViewModel extends ViewModel
{
    public $viewFields = array(
        'Student' => [
            'id', 'name', 'sex', 'class_id'
        ],
        'Class' => [
            'class_name', 'grade_id',
            '_on' => 'Class.id=Student.class_id'

        ],
        'Grade' => [
            'grade_name', '_on' => 'Grade.id=Class.grade_id'
        ],
        'Record' => [
            'sign_date','sign_time',
            '_on' => 'Student.id=Record.student_id',
            '_type' => 'LEFT'
        ]
    );
}
