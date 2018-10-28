<?php

namespace Home\Logic;

class StudentLogic
{

    public function getStudentList($date)
    {
        $model = D('StudentView');
        $list = $model->select();
        return $list;
    }


}
