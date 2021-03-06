<?php
namespace Api\Model;
use Think\Model;

class LetterModel extends Model {
    protected $trueTableName  = 'letter';
    //查看是否有未读私信
    public function letterStatus ($uid) {
        $map = [
            'to' => $uid,
            'status' => 0
        ];
        return $this->where($map)->count();
    }
    //获取已收到私信
    public function letter($uid, $offset = 1, $limit = 5){
        $map1 = [
            'letter.to' => $uid,
        ];
//        $map2 = [
//            'user_date.user_id' => $uid,
//        ];
        $offset = $offset > 0 ? $offset:1;
        $offset = ($offset - 1) * $limit;

        return $this->where($map1)
                    ->join('JOIN users ON letter.from = users.id')
                    ->join('JOIN user_date ON letter.date_id = user_date.date_id')
//                    ->where($map2)
                    ->join('JOIN date ON letter.date_id = date.id')
                    ->group('letter.id')
                    ->order('letter.id desc')
                    ->limit($offset, $limit)
                    ->field('letter.id as letter_id, users.id as user_id, users.nickname as user_name, users.signature as user_signature, users.head as user_avatar, users.gender as user_gender, letter.content as content, letter.date_id as date_id, letter.status as letter_status, user_date.status as user_date_status, date.title')
                    ->select();
    }

    //一条私信
    public function detailLetter($uid, $letter_id){
        $map = [
            'letter.id' => $letter_id,
            'letter.to' => $uid//to_id
        ];
        $map1 = [
            'letter.to' => $uid,
            'letter.id' => $letter_id
        ];
        $this->where($map1)->save(['status'=>1]);
        $data = $this->where($map)
                     ->join('JOIN users ON letter.from = users.id')
                     ->join('JOIN date ON letter.date_id = date.id')
                     ->field('letter.id as letter_id, users.id as user_id, users.nickname as user_name, users.signature as user_signature, users.head as user_avatar, users.gender as user_gender, letter.content as content, letter.date_id as date_id, letter.status as letter_status, letter.type as user_date_status, date.title')
                     ->find();
        return $data;
    }
}