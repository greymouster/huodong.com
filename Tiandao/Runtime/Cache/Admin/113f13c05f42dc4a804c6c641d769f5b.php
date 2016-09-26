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
    <div class="account-info modify-limit add-person">
        <h3>权限管理</h3>
        <a href="limit-mana.html">权限管理</a>>><a href="add-person.html">翟阳</a>
        <form>
            <input type="text" placeholder="请输入用户名" />
            <dl>
                <dt>
                    <input type="checkbox" name="checkbox" />特别权限
                </dt>
                <dd>（管理员，全站通行）</dd>
            </dl>
            <dl>
                <dt><h3>系统登录：</h3></dt>
                <dd><input type="checkbox" name="checkbox" />登录权限</dd>
            </dl>
            <dl>
                <dt><h3>活动公告：</h3></dt>
                <dd><input class="checkAll" type="checkbox" name="checkbox" />全选</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />最新公告</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />修改&新增公告</dd>
            </dl>
            <dl>
                <dt><h3>活动推广：</h3></dt>
                <dd><input class="checkAll" type="checkbox" name="checkbox" />全选</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />发布新活动</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />活动信息管理</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />我推广的活动</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />我的二维码</dd>
            </dl>
            <dl>
                <dt><h3>活动上线：</h3></dt>
                <dd><input class="checkAll" type="checkbox" name="checkbox" />全选</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />活动上线审核</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />查看</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />审核</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />查看活动数据</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />置顶</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />活动数据统计</dd>
            </dl>
            <dl>
                <dt><h3>报名管理：</h3></dt>
                <dd><input class="checkAll" type="checkbox" name="checkbox" />全选</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />报名审核</dd>
            </dl>
            <dl>
                <dt><h3>系统管理：</h3></dt>
                <dd><input class="checkAll" type="checkbox" name="checkbox" />全选</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />权限管理</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />查看</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />编辑小组</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />修改权限</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />新增用户</dd>
            </dl>
            <dl>
                <dt><h3>广告位：</h3></dt>
                <dd><input class="checkAll" type="checkbox" name="checkbox" />全选</dd>
                <dd><input class="checkItem" type="checkbox" name="checkbox" />广告位管理</dd>
            </dl>
            <button type="submit">确定新增</button>
        </form>
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
        /*全选*/
        $('.modify-limit form dl dd .checkAll').click(function(){
            var flag=$(this).prop('checked');
            $(this).parent().nextAll('dd').find('.checkItem').prop('checked',flag);
            $('.modify-limit form dl dd .checkItem').click(function(){
                var flag2=$(this).prop('checked');
                if(flag==true){
                    $(this).parent().siblings('dd').find('.checkAll').prop('checked',flag2);
                }
            })
        })
    })
</script>
</html>