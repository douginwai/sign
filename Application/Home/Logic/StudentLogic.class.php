<?php

namespace Home\Logic;

class StudentLogic
{

    public function getStudentList($date)
    {
        $model = D('StudentView');
        $where['_string'] = "sign_date = '{$date}' or sign_date is NULL ";
        $list = $model->where($where)
            ->order('grade_id', 'asc')
            ->order('class_id', 'asc')
            ->order('id', 'asc')
            ->select();
        return $list;
    }

    public function getState($date)
    {
        $model = D('StudentView');
        $where['_string'] = "sign_date = '{$date}' or sign_date is NULL ";
        $row = $model->field("grade_id,grade_name,class_id,class_name,count(class_id) as total_cnt,count(sign_date) as sign_cnt")
            ->where($where)
            ->group('class_id')
            ->order('grade_id', 'asc')
            ->order('class_id', 'asc')
            ->select();
        return $row;
    }

    public function signin($data)
    {
        $student_id = $data['student_id'];
        $recordModel = D('Record');
        $studentModel = D('Student');
        $student = $studentModel->where('id', $student_id)->find();
        if (!$student) {
            return 'student not found';
        }
        $sign_date = $data['sign_date'];
        $where['student_id'] = $student_id;
        $where['sign_date'] = $sign_date;
        $record = $recordModel->where($where)->find();
        if ($record) {
            return 'you have signed in already';
        }
        if ($recordModel->create($data, \Think\Model::MODEL_INSERT)) {
            $res = $recordModel->add($data);
            if ($res !== false) {
                return true;
            } else {
                return $recordModel->getError();
            }
        } else {
            return $recordModel->getError();
        }
    }

}
