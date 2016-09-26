<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="/Public/Admin/css/style.css">
    <script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
	<script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
	<script src="/Public/Admin/js/ancement.js"></script>
</head>
<body>
<div class="home-top">
    <h2>活动管理平台</h2>
    <p>欢迎<?php echo (session('realname')); ?>（超级管理员）</p>
    <div class="account">
        我的账号
        <ul>
            <li><a href="account-info.html">账号设置</a> </li>
            <li><a href="<?php echo U('Admin/loginOut');?>">退出账号</a> </li>
        </ul>
    </div>
</div>
<script>
    $(function(){
        //$('.account').click(function(){
        //    $(this).children('ul').css('display','block');
        //    event.stopPropagation();
        //})
        $(".account").click(function(){
            $('.account ul').toggle();
        })
    })
</script>
﻿ <div class="home-left">
        <ul>
            <li><h3>活动公告</h3></li>
            <li><a href="<?php echo U('Notice/index');?>">最新公告</a> </li>
            <li><h3>活动推广</h3></li>
            <li><a href="<?php echo U('Activity/release');?>">发布新活动</a> </li>
            <li><a href="<?php echo U('Activity/actMessage');?>">活动信息管理</a> </li>
            <li><a href="<?php echo U('Activity/myActMessage');?>">我推广的活动</a> </li>
            <li><a href="<?php echo U('Activity/myQRcode');?>">我的二维码</a> </li>
            <li><h3>活动上线</h3></li>
            <li><a href="<?php echo U('Online/index');?>">活动上线审核</a> </li>
            <li><a href="<?php echo U('Online/totalData');?>">活动数据统计</a> </li>
            <li><h3>报名管理</h3></li>
            <li><a href="<?php echo U('Enter/index');?>">报名审核</a> </li>
            <li><h3>系统管理</h3></li>
            <li><a href="limit-mana.html">权限管理</a> </li>
            <li><a href="<?php echo U('System/category');?>">活动分类管理</a> </li>
            <li><a href="<?php echo U('System/place');?>">活动地点管理</a> </li>
            <li><a href="<?php echo U('System/channel');?>">推广渠道管理</a> </li>
            <li><a href="log.html">操作日志</a> </li>
            <li><h3>广告位</h3></li>
            <li><a href="<?php echo U('Ad/ad');?>">新增广告位</a> </li>
            <li><a href="<?php echo U('Ad/adList');?>">广告位管理</a> </li>
        </ul>
</div>
 <div class="account-info">
        <h3>账号信息</h3>
        <form>
            <dl>
                <dt>用户名</dt>
                <dd>young.zhai</dd>
            </dl>
            <dl>
                <dt>姓名</dt>
                <dd>翟阳</dd>
            </dl>
            <dl>
                <dt>邮箱</dt>
                <dd>young.zhai@tiandaoedu.com</dd>
            </dl>
            <dl>
                <dt>部门</dt>
                <dd>北京分公司\互联网教育事业部\产品部\产品组</dd>
            </dl>
            <dl>
                <dt>所属组</dt>
                <dd>未分组</dd>
            </dl>
        </form>
    </div>
</body>
</html>