<?php if (!defined('THINK_PATH')) exit();?><html lang="en">
<head>
    <meta charset="UTF-8">
    <title>置顶</title>
    <script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
    <script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
    <script src="/Public/Admin/js/ancement.js"></script>
    <style type="text/css">
        dd{margin-top:30px;}
        input{margin-top:10px;}
        button{width:70px;line-height: 30px;border:solid 1px gray; float:right;background: #2bb8aa;margin-right:70px;}
    </style>
</head>
<body>
<form class="top">
    <dl>
        <!-- <dt>首页置顶位</dt> -->
        <dd >
            <input type="radio" name="act_is_top" value="1"/>1
            <input type="radio" name="act_is_top" value="2"/>2
            <input type="radio" name="act_is_top" value="3"/>3
            <input type="radio" name="act_is_top" value="4"/>4
            <input type="radio" name="act_is_top" value="5"/>5<br>
            <input type="radio" name="act_is_top" value="6"/>6
            <input type="radio" name="act_is_top" value="7"/>7
            <input type="radio" name="act_is_top" value="8"/>8
            <input type="radio" name="act_is_top" value="9"/>9
            <input type="radio" name="act_is_top" value="10"/>10
        </dd>
    </dl>
    <button type="button" act-id="<?php echo ($_GET['act_id']); ?>" class="top-button">确定</button>
</form>
</body>
</html>