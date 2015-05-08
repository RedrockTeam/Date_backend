<?php
namespace Api\Model;
use Think\Model;

class UsersModel extends Model {
    protected $trueTableName  = 'users';

    public function checkAuth ($uid, $token) {
        $map = [
            'uid' => $uid
        ];
        $data = $this->where($map)->field('token')->find();
        if($data['token'] === $token)
            return true;
        else
            return false;
    }
}