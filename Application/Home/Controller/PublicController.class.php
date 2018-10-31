<?php

namespace Home\Controller;

use Think\Controller;

class PublicController extends Controller
{

    public function login()
    {
        $account = I('post.account', '');
        $password = I('password', '');
        if (!$account || !$password) {
            $feedback = [
                'status' => -1,
                'msg' => '账号或密码不能为空',
            ];
            $this->ajaxReturn($feedback);
        }
        $model = D('Admin');
        $where['account'] = $account;
        $where['password'] = md5($password);
        $admin = $model->where($where)->find();
        if (!$admin) {
            $feedback = [
                'status' => -1,
                'msg' => '密码错误',
            ];
            $this->ajaxReturn($feedback);
        }
        session('sign_admin', $admin);
        $feedback = [
            'status' => 1,
            'msg' => 'succ',
        ];
        $this->ajaxReturn($feedback);
    }

    public function logout()
    {
        session('sign_admin', null);
        echo("OK");
    }

    public function isLogin()
    {
        if (session('sign_admin')) {
            $feedback = [
                'status' => 1,
                'msg' => 'login already',
            ];
            $this->ajaxReturn($feedback);
        } else {
            $feedback = [
                'status' => -2,
                'msg' => 'not logined',
            ];
            $this->ajaxReturn($feedback);
        }
    }

}