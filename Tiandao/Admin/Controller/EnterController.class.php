<?php

namespace Admin\Controller;

use Admin\Logic\EditDataLogic;

class EnterController extends BaseController {

    private static $ActmessageModel;

    public function _initialize() {
        parent::_initialize();
        if (empty(self::$ActmessageModel)) {
            self::$ActmessageModel = D('Actmessage');
        }
    }

    public function index(){

        //获取报名活动的用户
        $data = self::$UserBmModel -> getAllData();
        var_dump($data)




        //获取报名审核
        $url = C('MOBILE_URL').getBmAllData;
        $info = json_decode(EditDataLogic::curl_post($url,array('flag'=>1)));
        if($info->status == 1){
            $data = objarray_to_array($info->data);
            foreach($data as $k=>$v){
                $actData = self::$ActmessageModel->where(array('act_id'=>$v['act_id']))->field('act_name,act_status')->find();
                $data[$k]['act_name'] = $actData['act_name'];
                $data[$k]['act_status'] = $actData['act_status'];
            }
        }
        $this->assign('data',$data)->display();
    }



   public function index1() {
        $actname = I('get.actname');
        $startDate = I('get.start_time');
        $endDate = I('get.end_time');
        $realname = session('realname');
        //获取所有的活动信息
        $field = "act_name,act_id";
        $info = self::$ActmessageModel->getAllData(array('act_charge_name' => session('realname')), $field);
        //获取报名的信息
        $data = self::$studentsViewModel->searchData($realname, $actname, $startDate, $endDate);
        $this->assign(array(
            'cateData' => $cateData,
            'placeData' => $placeData,
            'info' => $info,
            'data' => $data['data'],
            'page' => $data['page'],
        ));
        $this->display();
    }

    public function pass() {
        $studentId = I('post.studentId', false, 'int');
        $pass = I('post.pass', false, 'htmlspecialchars');
        $where = array('id' => $studentId);
        $field = 'status';
        if ($pass == 'pass') {
            if (FALSE !== self::$studentsViewModel->saveField($where, $field, $value = 1)) {
                $this->success('审核通过', '', TRUE);
            }
            $this->error('审核处理失败', '', TRUE);
        }
        if ($pass == 'nopass') {
            if (FALSE !== self::$studentsViewModel->saveField($where, $field, $value = 2)) {
                $this->success('审核不通过', '', TRUE);
            }
            $this->error('审核处理失败', '', TRUE);
        }
        $this->error('审核处理失败', '', TRUE);
    }

    public function info() {
        $id = I('get.id', false, 'int');
        //获取学生的信息
        $data = self::$studentsViewModel->where(array('id' => $id))->find();
        $this->assign('data', $data)->display();
    }

}
