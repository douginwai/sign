<?php

namespace Home\Model;

use Think\Model\ViewModel;

class ClassViewModel extends ViewModel
{
    public $viewFields = array(
        'Class' => [
            'id',
            'class_name',
            'grade_id',

        ],
        'Grade' => [
            'grade_name',
            '_on' => 'Class.grade_id = Grade.id',
            '_type' => 'LEFT'
        ],
    );
}
