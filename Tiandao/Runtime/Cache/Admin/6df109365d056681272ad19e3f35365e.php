<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天道活动管理平台</title>
    <link rel="stylesheet" href="/Public/Admin/css/style.css">
    <script src="/Public/Admin/js/jquery-1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
    <script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
    <script src="/Public/Admin/js/ancement.js"></script>
    </style>
</head>
<body>
    <div class="join-detail" style="margin-left:-150px;">
        <h3>报名审核</h3>
        <a href="javascript:;">报名审核</a>>><a href="javascript:;">查看基本信息</a>
        <div class="info basic-info">
            <h6>基本信息</h6>
            <p>学生姓名:<i><?php echo ($data["name"]); ?></i></p>
            <p>学生年龄：<i><?php echo ($data["age"]); ?></i></p>
            <p>学生电话:<i><?php echo ($data["phone"]); ?></i></p>
            <p>学生邮箱：<i><?php echo ($data["email"]); ?></i></p>
            <p>学生QQ:<i><?php echo ($data["qq"]); ?></i></p>
            <p>学生学历：<i><?php echo ($data["edu"]); ?></i></p>
            <p>学生性别:<i><?php echo ($data["sex"]); ?></i></p>
            <p>学生出生日期：<i><?php echo ($data["birthday"]); ?></i></p>
            <p>学生职业:<i><?php echo ($data["job"]); ?></i></p>
            <p>学生留学国家：<i><?php echo ($data["country"]); ?></i></p>
            <p>学生就读院校:<i><?php echo ($data["school"]); ?></i></p>
        </div>
        <div class="info city">
            <h6>城市：</h6>
            <p><i><?php echo ($data["city"]); ?></i></p>
        </div>
        <div class="info act-type">
            <h6>活动名称：</h6>
            <p><i><?php echo ($data["act_name"]); ?></i></p>
        </div>
        <div class="info act-type">
            <h6>备注：</h6>
            <p><i><?php echo ($data["remark"]); ?></i></p>
        </div>
        <div class="info act-type">
            <h6>客户来源：</h6>
            <p><i><?php echo ($data["source"]); ?></i></p>
        </div>
    </div>
</body>
<script>
</script>
</html>