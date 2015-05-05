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