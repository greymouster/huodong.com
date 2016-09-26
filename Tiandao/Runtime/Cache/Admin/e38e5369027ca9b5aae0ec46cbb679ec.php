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
    <div class="join-detail">
        <h3>权限管理</h3>
        <a href="<?php echo U('Auth/addPerson');?>" style="font-size: 18px;margin-bottom:10px; ">新增用户</a> 
        <div class="limit-mana">
            <div class="limit-left">
                <dl>
                    <dt><h3>人员管理</h3></dt>
                    <dd class="search"><input type="search" placeholder="按姓名搜索" /> </dd>
                    
                </dl>
                <div class="content-box">
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" checked="checked" />翟阳 </dt>
                        <dd style="display: block;">
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />刘小红</dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />XXX</dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />刘小红</dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />XXX</dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />翟阳 </dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />刘小红</dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />XXX</dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />翟阳 </dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />刘小红</dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />XXX</dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />翟阳 </dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />刘小红</dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><input type="checkbox" name="name" id="name" />XXX</dt>
                        <dd>
                            <a href="account-info.html">查看</a>
                            <a href="edit-group.html">编辑小组</a>
                            <a href="modify-limit.html">修改权限</a>
                            <a class="person-dis">封禁用户</a>
                            <div class="box dis-box">
                                <h2>确定封禁此用户？</h2>
                                <button class="yes">确定</button>
                                <button class="cancle">取消</button>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="page">
                    <ul>
                        <li class="active"><a href="#">1</a> </li>
                        <li><a href="#">2</a> </li>
                        <li><a href="#">3</a> </li>
                        <li><a href="#">下一页》</a> </li>
                        <li>(1-25/64)每页显示：25,50,100</li>
                    </ul>
                </div>
            </div>
            <div class="limit-right">
                <h2>组</h2>
                <a href="<?php echo U('Auth/addGroup');?>">新建小组</a>
                <p>显示所有人员</p>
                <dl>
                    <dt><button>编辑组</button></dt>
                    <dd><a href="edit-group.html">编辑小组</a> </dd>
                </dl>
                <dl>
                    <dt><button>市场部</button></dt>
                    <dd><a href="edit-group.html">编辑小组</a> </dd>
                </dl>
                <dl>
                    <dt><button>睿德组</button></dt>
                    <dd><a href="edit-group.html">编辑小组</a> </dd>
                </dl>
                <dl>
                    <dt><button>未分组</button></dt>
                </dl>
            </div>
            <div style="clear:both;"></div>
        </div>
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
        /*勾选姓名，出现蓝色的字*/
        $('.limit-mana .limit-left dl dt input[type="checkbox"]').click(function(){
            var check = $(this).prop('checked');
            if(check==true){
                $(this).parent().next('dd').css('display','block');
            }
            else{
                $(this).parent().next('dd').css('display','none');
            }
        })
        /*弹框*/
        $('.limit-mana .limit-left dl dd .person-dis').click(function(){
            $(this).parent().find('.dis-box').css('display','block');
            $(this).parent().parent().siblings().find('.box').css('display','none');
            event.stopPropagation();
        })
        $('.limit-mana .limit-left dl dd .dis-box').click(function(){
            $(this).show();
            event.stopPropagation();
        })
        $('.limit-mana .limit-left dl dd .cancle').click(function(){
            $(this).parent().css('display','none');
            event.stopPropagation();
        })
        $(document).click(function(){
            $('.limit-mana .limit-left dl dd .dis-box').hide();
        })
        /*页码*/
        $('.limit-mana .limit-left .page ul li a').click(function(){
            $(this).parent().addClass('active');
            $(this).parent().siblings().removeClass('active');
        })
    })
</script>
</html>