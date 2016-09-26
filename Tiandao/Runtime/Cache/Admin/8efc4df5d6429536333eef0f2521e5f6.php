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
            <li><a href="<?php echo U('Index/index');?>">查看账号</a> </li>
            <li><a href="<?php echo U('Admin/loginOut');?>">退出账号</a> </li>
        </ul>
    </div>
</div>
<script>
    $(function(){
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
            <li><a href="<?php echo U('Auth/index');?>">权限管理</a> </li>
            <li><a href="<?php echo U('System/category');?>">活动分类管理</a> </li>
            <li><a href="<?php echo U('System/place');?>">活动地点管理</a> </li>
            <li><a href="<?php echo U('System/channel');?>">推广渠道管理</a> </li>
            <li><a href="log.html">操作日志</a> </li>
            <li><h3>广告位</h3></li>
            <li><a href="<?php echo U('Ad/ad');?>">新增广告位</a> </li>
            <li><a href="<?php echo U('Ad/adList');?>">广告位管理</a> </li>
        </ul>
</div>
    <div class="account-info edit-group">
        <h3>权限管理</h3>
        <a href="javascript:;">权限管理</a>>><a href="javascript:;">新增小组</a>
        <form>
            <dl>
                <dt><h3>组名称</h3></dt>
                <dd><input type="text" placeholder="编辑组" /> </dd>
            </dl>
           <!--  <dl>
                <dt><h3>组员列表</h3></dt>
                <dd>
                    <span>王珊<button><img src="images/u39.jpg" /></button>  </span>
                    <span>李芸<button><img src="images/u39.jpg" /></button></span>
                </dd>
            </dl> -->
            <dl>
                <dt><h3>添加组员</h3></dt>
                <dd><input type="search" placeholder="按姓名搜索" /> </dd>
                <a href="#">加入本组</a>
            </dl>
            <ul>
                <li>
                    <input type="checkbox" name="name" />李立
                </li>
                <li>
                    <input type="checkbox" name="name" />王虎
                </li>
            </ul>
            <div class="reserve">
                <button type="submit">保存设置</button>
            </div>
        </form>
      <!--   <h4>加入本组后的人将显示在组员列表中，成员横向展示点击组员列表的名字右侧会显示叉子，可移出本组</h4> -->
    </div>
</body>
<script>
    $(function(){
        $('.account').click(function(){
            $(this).children('ul').css('display','block');
            event.stopPropagation();
        })
        $(document).click(function(){
            $('.account ul').css('display','none');
        })
        /*删除组员*/
        $('.edit-group form dl dd span').click(function(){
            $(this).children('button').show();
        })
    })
</script>
</html>