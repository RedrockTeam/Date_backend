<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends ManagementController {
    private $userIfo = array(
        'root'  =>  array(
            'password'  =>  'date_Orange-W',
            'level' => 7,
        ),
        'redrock'  =>  array(
            'password'  =>  '1',//date_hongyanredrock
            'level' => 5,
        ),
        'editer'  =>  array(
            'password'  =>  'date_123456',
            'level' => 1,
        ),
    );

    public function index() {
        layout(false);
        $this->assign('postUrl',U('home:login/toLogin'));
        $this->display('login');
    }

    public function  toLogin(){
        $post = $this->checkPost(array('name','password'));
        $password = toPaw($post['password']);
        $right_pass = toPaw($this->userIfo[$post['name']]['password']);
        if($password == $right_pass ){
            session('loginUser',$post['name']);
            session('userLevel',$post['level']);
        } else    $this->error('密码错误');
        $this->success('登陆成功',U('home:management/index'));
    }
}