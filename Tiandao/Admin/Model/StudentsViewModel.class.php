<?php

namespace Admin\Model;

use Think\Page;
use Think\Model\ViewModel;

class StudentsViewModel extends ViewModel {

    protected $viewFields = array(
        'actmessage' => array('act_name', 'act_charge_name', 'act_current_status', 'act_start_date', 'act_end_date'),
        'students' => array('id' => 'student_id', 'act_id', 'name', 'phone', 'email', 'weixin', 'qq', 'city', 'edu', 'status', 'sex', 'age', 'birthday', 'job', 'country', 'school', 'remark', 'source', '_on' => 'actmessage.act_id = students.act_id'),
    );

    //根据搜索条件获取分页
    public function searchData($realname, $actname = null, $startData = null, $endData = null) {
        $where = array();
        if ($realname) {
            $where['act_charge_name'] = array('eq', $realname);
        }
        if ($actname) {
            $where['act_name'] = array('eq', $actname);
        }
        if ($startData) {
            $where['act_start_date'] = array('egt', strtotime("$startData 00:00:00"));
        }
        if ($endData) {
            $where['act_end_date'] = array('elt', strtotime("$endData 23:59:59"));
        }
        $count = $this->where($where)->count();
        $page = new Page($count, 4);
        $show = $page->show();
        $data = $this->where($where)->limit($page->firstRow . ',' . $page->lastRows)->select();
        return array('data' => $data, 'page' => $show);
    }

    //更新字段值
    public function saveField($where = null, $field = null, $value = null) {
        return $this->where($where)->setField($field, $value);
    }

}
