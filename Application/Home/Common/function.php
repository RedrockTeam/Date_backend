<?php
/**
 * By Orange.W
 * Date: 15/5/1
 * Time: 19:46
 * Ps:  
 */

function checkLogin(){
    if($name = session('date_user_name'))   return $name;
    else   redirect(U('home:Management/login'), 0, '请先登陆...');
}

function toPaw($origin){
    return md5(substr(md5("hongyan".$origin),3,14)."redrock");
}