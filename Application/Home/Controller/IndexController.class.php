<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function test()
    {
        $model = D('student');
        $list = $model->where('1', 1)->select();
        dump($list);
    }

    public function studentList()
    {
        $studentLogic = D('Student', 'Logic');
        $date = date('Y-m-d', time());
        $list = $studentLogic->getStudentList($date);
        dump($list);
    }
}