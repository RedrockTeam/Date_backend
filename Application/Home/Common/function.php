<?php
/**
 * By Orange.W
 * Date: 15/5/1
 * Time: 19:46
 * Ps:  
 */

function checkLogin(){
    if($name = session('loginUser'))   return $name;
    else   redirect(U('home:Login/index'), 1, 'please to login ...');
}

function toPaw($origin){
    return md5(substr(md5("hongyan".$origin),3,14)."redrock");
}

function checkLevel($levelNeed=2){
    if(checkLogin()){
        if(session('userLevel') < $levelNeed){
            echo '<script>alert("权限不够!");history.go(-1);</script>';
            exit();
        }
    }
}

function login($post){

    $password = toPaw($post['password']);
    $right_pass = toPaw($this->userIfo[$post['name']]['password']);
    if($password == $right_pass ){
        session('loginUser',$post['name']);
        session('userLevel',$post['level']);
    } else    $this->error('密码错误');
}