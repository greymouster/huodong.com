<?php

namespace Admin\Model;
use Think\Model;
class UserBmModel extends Model{
    public function addData($data=null){
        return $this->add($data);
    }

    public function getOneData($where=null){
        return $this->where($where)->find();
    }

    public function getAllData($where=null,$field=null){
        return $this->alias('a')->join('LEFT JOIN __ACTMESSAGE__  b ON a.act_id = b.act_id ')->field($field)->where($where)->select();
    }

}