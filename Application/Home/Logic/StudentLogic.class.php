<?php

namespace Home\Logic;

class StudentLogic
{

    public function getSignList($date)
    {
        $select = $this->getStudentView($date);
        $list = $select
            ->order('grade_id', 'asc')
            ->order('class_name', 'asc')
            ->order('sign_time', 'asc')
            ->select();
        return $list;
    }

    public function getStudentList()
    {
        $model = D('StudentView');
        $list = $model->distinct(true)
            ->group('id')
            ->order('grade_id', 'asc')
            ->order('class_name', 'asc')
            ->select();
        return $list;
    }

    public function getState($date)
    {
        $model = D('StudentView');
//        $where['_string'] = "sign_date = '{$date}' or sign_date is NULL ";
        $row = $model->field("grade_id,grade_name,class_id,class_name,count(class_id) as total_cnt,count(sign_date = '{$date}' or null) as sign_cnt")
//            ->where($where)
            ->group('class_id')
            ->order('grade_id', 'asc')
            ->order('class_id', 'asc')
            ->select();
        return $row;
    }

    public function sumState($date)
    {
        $studentModel = D('Student');
        $recordModel = D('Record');
        $studentCount = $studentModel->count();
        $where['sign_date'] = $date;
        $recordCount = $recordModel->where($where)->count();
        return [$studentCount, $recordCount];
    }

    public function signin($data)
    {
        $student_id = $data['student_id'];
        $recordModel = D('Record');
        $studentModel = D('Student');
        $student = $studentModel->where(["id" => $student_id])->find();
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

    public function addClass($data)
    {
        $classModel = D('Class');
        try {
            if ($classModel->create($data, \Think\Model::MODEL_INSERT)) {
                $res = $classModel->add($data);
                if ($res !== false) {
                    return true;
                } else {
                    return $classModel->getError();
                }
            } else {
                return $classModel->getError();
            }
        } catch (\Exception $ex) {
            return '添加失败';
        }
    }

    public function deleteClass($id)
    {
        $classModel = D('Class');
        $res = $classModel->where(array('id' => $id))->delete();
        if ($res) {
            $studentModel = D('Student');
            $studentModel->where(array('class_id' => $id))->delete();
        }
        return $res ? true : false;
    }

    public function addStudent($data)
    {
        $studentModel = D('Student');
        if ($studentModel->create($data, \Think\Model::MODEL_INSERT)) {
            $res = $studentModel->add($data);
            if ($res !== false) {
                return true;
            } else {
                return $studentModel->getError();
            }
        } else {
            return $studentModel->getError();
        }
    }

    public function deleteStudent($id)
    {
        $studentModel = D('Student');
        $res = $studentModel->where(array('id' => $id))->delete();
        if ($res) {
            D('Record')->where(array('student_id' => $id))->delete();
        }
        return $res ? true : false;
    }

    public function classList($grade_id)
    {
        $classModel = D('ClassView');
        if ($grade_id) {
            $where['grade_id'] = $grade_id;
            $list = $classModel
                ->where($where)
                ->order('grade_id', 'asc')
                ->select();
        } else {
            $list = $classModel
                ->order('grade_id', 'asc')
                ->select();
        }
        return $list;
    }

    public function gradeList()
    {
        $gradeModel = D('Grade');
        $list = $gradeModel
            ->order('id', 'asc')
            ->select();
        return $list;
    }

    private function getStudentView($date)
    {
        $model = D('Student');
        $tbStudent = $model->getTableName();
        $tbClass = D('Class')->getTableName();
        $tbGrade = D('Grade')->getTableName();
        $tbRecord = D('Record')->getTableName();
        $select = $model->join("LEFT JOIN {$tbClass} cla on cla.id = {$tbStudent}.class_id")
            ->join("LEFT JOIN {$tbGrade} grd on grd.id = cla.grade_id")
            ->join("LEFT JOIN {$tbRecord} rcd on rcd.student_id = {$tbStudent}.id and rcd.sign_date = '{$date}'")
            ->field("{$tbStudent}.id,name,class_id,class_name,grade_id,grade_name,sign_date,sign_time");
        return $select;
    }

    public function studentDetail($id)
    {
        $model = D('StudentView');
        $student = $model->where(array('id' => $id))->find();
        return $student;
    }
}
