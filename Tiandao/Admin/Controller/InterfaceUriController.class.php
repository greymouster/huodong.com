<?php

/**
 * 接口控制器
 */

namespace Admin\Controller;

use Think\Controller;
use Admin\Logic\EditDataLogic;

class InterfaceUriController extends Controller {

    private $adModel;
    private $actModel;
    private $placeModel;
    private $cateModel;
    private $formDataModel;
    public function _initialize() {
        if (empty($this->adModel)) {
            $this->adModel = D('Ad');
        }
        if (empty($this->actModel)) {
            $this->actModel = D('Actmessage');
        }
        if (empty($this->placeModel)) {
            $this->placeModel = D('Place');
        }
        if (empty($this->cateModel)) {
            $this->cateModel = D('Category');
        }
        if (empty($this->formDataModel)) {
            $this->formDataModel = D('FormData');
        }
    }

    /**
     * @param type 请求的类型
     * @param limit 截取的条数
     * @return json数据  广告类型数据
     */
    public function getAdData() {
        $type = I('post.type', false, 'int');
        $limit = I('post.limit', false, 'int');
        $keyword = I('post.keyword');
        $order = "sort_number DESC,ad_id Asc";
        if (!IS_POST) {
            exit(json_encode(array('stauts' => 0, 'flag' => '请求参数有误')));
        }
        if($keyword){
            $adName = $this->adModel->getAllData(array('ad_name_sort' =>$keyword),'ad_name');
            exit(json_encode(array('status'=>1,'flag'=>'请求成功','data'=>$adName)));
        }
        $info = $this->adModel->getAllData(array('media_type' => $type), 'ad_pic,ad_link,ad_name', $order, $limit);
        if ($info) {
            exit(json_encode(array('status' => 1, 'flag' => '请求成功', 'data' => $info)));
        } else {
            exit(json_encode(array('status' => 0, 'flag' => '请求失败', 'data' => $this->adModel->getError())));
        }
    }

    /**
     * 直接调用此方法返回城市的所有数据
     */
    public function getCity() {
        $city = $this->placeModel->select();
        if ($city) {
            exit(json_encode(array('status' => 1, 'falg' => '请求成功', 'data' => $city)));
        }
        exit(json_encode(array('status' => 0, 'falg' => '请求失败', 'data' => $this->placeModel->getError())));
    }

    /**
     * 获取类型
     */
    public function getCateData() {
        $cate = $this->cateModel->select();
        if ($cate) {
            exit(json_encode(array('status' => 1, 'falg' => '请求成功', 'data' => $cate)));
        }
        exit(json_encode(array('status' => 0, 'falg' => '请求失败', 'data' => $this->cateModel->getError())));
    }

    /**
     * 根据条件获取活动列表信息
     */
    public function getActList() {
        $catName = I('post.catName', false, 'htmlspecialchars');
        $city = I('post.city',false,'htmlspecialchars');
        $limit = I('post.limit',false,'int');
        $time = I('post.time',false,'htmlspecialchars');
        $actId = I('post.act_id',false,'int');
        $sortData = I('post.sort',false,'htmlspecialchars');
        if($catName || $city || $time || $actId || $sortData){
            //根据类型简称 获取类型全称
            $catName = $this->cateModel->where(array('abb_short'=>$catName))->field('cat_name')->find();
            //根据地点简称 获取地点全称
            $placeName = $this->placeModel->where(array('abb_short'=>$city))->field('place_name')->find();
            $data = $this->actModel->getHomeDataList($placeName['place_name'],$catName['cat_name'],$time,$limit,$actId,$sortData);
        }else{
            $data = $this->actModel->getHomeDataList($placeName,$catName,$limit);
        }
        if ($data) {
            exit(json_encode(array('status' => 1, 'falg' => '请求成功', 'data' =>$data)));
        }
        exit(json_encode(array('status' => 0, 'falg' => '请求失败', 'data' => $this->actModel->getError())));
    }

    /**
     * 获取表单数据
     */
    public function getFormData(){
        $actId = I('post.actId',false,'int');
        if(!$actId){
            exit(json_encode(array('status'=>0,'falg'=>'请求参数有误')));
        }
        $data = $this->formDataModel->where(array("act_id"=>$actId))->find();
        if ($data) {
            exit(json_encode(array('status' => 1, 'falg' => '请求成功', 'data' =>unserialize($data['form_data']))));
        }
        exit(json_encode(array('status' => 0, 'falg' => '请求失败')));
    }

    /**
     * 获取收藏活动接口
     */
    public function userActData(){
        $actIds = I('post.actIds');
        if($actIds){
            $where['act_id'] = array('in',$actIds);
            $data = $this->actModel->getAllData($where,'act_name,act_id,act_file');
            exit(json_encode(array('status'=>1,'falg'=>'请求成功','data'=>$data)));
        }
        exit(json_encode(array('status'=>0,'falg'=>'请求失败')));
    }

    /**
     * 获取已结束的活动接口
     */
     public function getEndData(){
         $actIds = I('post.actIds');
         if($actIds){
             $where['act_id'] = array('in',$actIds);
             $where['act_end_date'] = array('elt',time());
             $data = $this->actModel->numData($where);
             exit(json_encode(array('status'=>1,'falg'=>'请求成功','data'=>$data)));
         }
         exit(json_encode(array('status'=>0,'falg'=>'请求失败')));
     }

     /**
      * 报名
      */
     public function addBmData(){
         if(IS_POST){

             $where['act_id'] = array('eq',$_POST['act_id']);
             $where['user_id'] = array('eq',$_POST['user_id']);
             if(D('UserBm')->getOneData($where)){
                 exit(json_encode(array('status'=>-1,'msg'=>'请勿重复报名')));
             }
             if(D('UserBm')->addData($_POST)){
                 exit(json_encode(array('status'=>1,'msg'=>'报名成功,等待审核')));
             }
             exit(json_encode(array('status'=>-1,'msg'=>'报名失败请重新报名')));
         }
     }
}
