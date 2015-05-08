<?php
namespace Api\Model;
use Think\Model;

class UsersModel extends Model {
    protected $trueTableName  = 'users';

    public function checkAuth ($uid, $token) {
        $map = [
            'uid' => $uid
        ];
        $data = $this->where($map)->getfield('token');
        if($data === $token)
            return true;
        else
            return false;
    }
}