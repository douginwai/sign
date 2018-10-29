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

    public function state()
    {
        $studentLogic = D('Student', 'Logic');
        $date = date('Y-m-d', time());
        $list = $studentLogic->getState($date);
        $feedback = [
            'status' => 1,
            'msg' => 'succ',
            'data' => $list
        ];
        $this->ajaxReturn($feedback);
    }

    public function signin()
    {
        $id = I('id', '');
        if (!$id) {
            $feedback = [
                'status' => -1,
                'msg' => 'id is needed',
            ];
            $this->ajaxReturn($feedback);
        }

        $studentLogic = D('Student', 'Logic');
        $date = date('Y-m-d', time());
        $datetime = date('Y-m-d H:i:s', time());
        $data = [
            'student_id' => $id,
            'sign_date' => $date,
            'sign_time' => $datetime
        ];
        $res = $studentLogic->signin($data);
        if ($res === true) {
            $feedback = [
                'status' => 1,
                'msg' => 'succ',
            ];
        } else {
            $feedback = [
                'status' => -1,
                'msg' => $res,
            ];
        }
        $this->ajaxReturn($feedback);
    }

    public function addClass()
    {
        $grade_name = I('class_name', '');
        if (!$grade_name) {
            $feedback = [
                'status' => -1,
                'msg' => 'grade_name is needed',
            ];
            $this->ajaxReturn($feedback);
        }
        $studentLogic = D('Student', 'Logic');

    }
}