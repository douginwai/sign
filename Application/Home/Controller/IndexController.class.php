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

    public function signList()
    {
        $studentLogic = D('Student', 'Logic');
        $date = I('date', date('Y-m-d', time()));
        $list = $studentLogic->getSignList($date);
        $feedback = [
            'status' => 1,
            'msg' => 'succ',
            'data' => $list
        ];
        $this->ajaxReturn($feedback);
    }

    public function studentList()
    {
        $studentLogic = D('Student', 'Logic');
        $list = $studentLogic->getStudentList();
        $feedback = [
            'status' => 1,
            'msg' => 'succ',
            'data' => $list
        ];
        $this->ajaxReturn($feedback);
    }

    public function state()
    {
        $studentLogic = D('Student', 'Logic');
        $date = I('date', date('Y-m-d', time()));
        $list = $studentLogic->getState($date);
        list($studentCount, $recordCount) = $studentLogic->sumState($date);
        $feedback = [
            'status' => 1,
            'msg' => 'succ',
            'data' => [
                'list' => $list,
                'studentCount' => $studentCount,
                'recordCount' => $recordCount
            ]
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
        $class_name = I('class_name', '');
        $grade_id = I('grade_id', '');
        if (!$class_name || !$grade_id) {
            $feedback = [
                'status' => -1,
                'msg' => 'class_name and grade_id are needed',
            ];
            $this->ajaxReturn($feedback);
        }
        $studentLogic = D('Student', 'Logic');
        $data = [
            'class_name' => $class_name,
            'grade_id' => $grade_id
        ];
        $res = $studentLogic->addClass($data);
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

    public function deleteClass()
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
        $res = $studentLogic->deleteClass($id);
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

    public function addStudent()
    {
        $name = I('name', '');
        $class_id = I('class_id', '');
        if (!$name || !$class_id) {
            $feedback = [
                'status' => -1,
                'msg' => 'name and class_id are needed',
            ];
            $this->ajaxReturn($feedback);
        }
        $studentLogic = D('Student', 'Logic');
        $data = [
            'name' => $name,
            'class_id' => $class_id
        ];
        $res = $studentLogic->addStudent($data);
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

    public function deleteStudent()
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
        $res = $studentLogic->deleteStudent($id);
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

    public function classList()
    {
        $studentLogic = D('Student', 'Logic');
        $list = $studentLogic->classList();
        $feedback = [
            'status' => 1,
            'msg' => 'succ',
            'data' => $list
        ];
        $this->ajaxReturn($feedback);
    }

    public function gradeList()
    {
        $studentLogic = D('Student', 'Logic');
        $list = $studentLogic->gradeList();
        $feedback = [
            'status' => 1,
            'msg' => 'succ',
            'data' => $list
        ];
        $this->ajaxReturn($feedback);
    }

}