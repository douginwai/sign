<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function _initialize()
    {
        $admin = session('sign_admin');
        if (!$admin) {
            $feedback = [
                'status' => -2,
                'msg' => 'login first',
            ];
            $this->ajaxReturn($feedback);
        }
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
        $grade_id = I('grade_id', '');
        $list = $studentLogic->classList($grade_id);
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

    public function qrcode()
    {
        $studentId = I('studentId', '');
        if (!$studentId) {
            $this->error('studentId 必须');
        }
        $url = "http://qrsigin.applinzi.com/html/signin.html?id={$studentId}";
        $level = 3;
        $size = 4;
        Vendor('phpqrcode.phpqrcode');
        $errorCorrectionLevel = intval($level);//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        //生成二维码图片
        $object = new \QRcode();
        $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
    }

}