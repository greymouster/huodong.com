function resolveEventFormView(items, index, addParticipant) {
    var htmlTmp = "";
<!--    var ctllength = (items != null ? items.length : 0) + (addParticipant ? 3 : 0);
    var marbtm = (ctllength < 5 ? 22 : (ctllength < 8 ? 16 : (ctllength < 10 ? 10 : 8)));
    if (addParticipant) {
        htmlTmp += '<div class="control-group" style="margin-bottom:' + marbtm + 'px;">';
        htmlTmp += '<label class="control-label" style="font-weight:bold;" for="participants[' + index + '][0].Value">参加人' + (1 + index) + ' 姓名<font style="color:red;">&nbsp;*</font></label>';
        htmlTmp += '<div class="controls">';
        htmlTmp += '<input type="hidden" name="participants[' + index + '][0].Key" value="participant_name" />';
        htmlTmp += '<input type="text" name="participants[' + index + '][0].Value" class="input-xxlarge required" placeholder="请输入参加人姓名" title="请输入参加人姓名"/>';
        htmlTmp += '</div></div>';
        
        htmlTmp += '<div class="control-group" style="margin-bottom:' + marbtm + 'px;">';
        htmlTmp += '<label class="control-label" style="font-weight:bold;" for="participants[' + index + '][2].Value">参加人' + (1 + index) + ' 手机号码<font style="color:red;">&nbsp;*</font></label>';
        htmlTmp += '<div class="controls">';
        htmlTmp += '<input type="hidden" name="participants[' + index + '][2].Key" value="participant_phone" />';
        htmlTmp += '<input type="text" name="participants[' + index + '][2].Value" class="input-xxlarge required digits" placeholder="请输入参加人手机号码" title="请输入参加人手机号码"/>';
        htmlTmp += '</div></div>';

        htmlTmp += '<div class="control-group" style="margin-bottom:' + marbtm + 'px;">';
        htmlTmp += '<label class="control-label" style="font-weight:bold;" for="participants[' + index + '][1].Value">参加人' + (1 + index) + ' 电子邮箱</label>';
        htmlTmp += '<div class="controls">';
        htmlTmp += '<input type="hidden" name="participants[' + index + '][1].Key" value="participant_email" />';
        htmlTmp += '<input type="text" name="participants[' + index + '][1].Value" class="input-xxlarge email" placeholder="请输入参加人电子邮箱" title="请输入参加人电子邮箱"/>';
        htmlTmp += '</div></div><hr style="margin:25px 0px;"/>';
    }-->
    if (items != null && items.length > 0) {
        var i = 0;
        var flagAddi = false;
        for (iii = 0; iii < items.length; iii++) {
            flagAddi = false;
            var tmpItem = items[iii];
            var tmpmbtm = marbtm;
            if (tmpItem.Type == 'radio' || tmpItem.Type == 'checkbox') {
                tmpmbtm = marbtm - 8;
                htmlTmp += '<div style="clear:both;margin-bottom:6px;"></div>';
            }
            else htmlTmp += '<div style="clear:both;"></div>';
            htmlTmp += '<div class="control-group" style="margin-bottom:' + tmpmbtm + 'px;">';
            htmlTmp += '<label class="control-label" style="font-weight:bold;" for="items[' + index + '][' + i + '].Value">' +
                    tmpItem.Title + (tmpItem.Required ? '<font style="color:red;">&nbsp;*</font>' : '')
            if ((tmpItem.Type == 'radio' || tmpItem.Type == 'checkbox') && tmpItem.Subitems != null && tmpItem.Subitems.length > 0) {
                if (!tmpItem.Required) htmlTmp += '<input name="items[' + index + '][' + i + '].Value" style="height:0px;width:0px;border:0px;visibility:hidden;" checked="checked" type="' + tmpItem.Type + '" value="" />';
                else htmlTmp += '<input name="items[' + index + '][' + i + '].Value" style="height:0px;width:0px;border:0px;visibility:hidden;" class="required" type="' + tmpItem.Type + '" value="" />';
            }
            else if (tmpItem.Type == 'file') {
                htmlTmp += '<input name="items[' + index + '][' + i + '].Value" style="height:0px;width:0px;border:0px;visibility:hidden;" type="text" value="" class="' + (tmpItem.Required ? 'required' : '') + '" />';
            }
            htmlTmp += '</label><div class="controls';
            if (tmpItem.Type == 'file') { htmlTmp += ' event-upload-controls ' }
            htmlTmp += '">';
            if ((tmpItem.Type != 'radio' && tmpItem.Type != 'checkbox' && tmpItem.Type != 'select') || (tmpItem.Subitems != null && tmpItem.Subitems.length > 0)) {
                htmlTmp += '<input type="hidden" name="items[' + index + '][' + i + '].Key" value="' + tmpItem.Key + '" />';
                flagAddi = true;
            }
            var itemDesc = tmpItem.Description != null && $.trim(tmpItem.Description) != '' ? tmpItem.Description.replace("\"", "\\\"").replace("\n", " ").replace(/\s+/g, " ") : '';
            if (tmpItem.Type == 'input' || tmpItem.Type == 'number' || tmpItem.Type == 'date' || tmpItem.Type == 'email') {
                htmlTmp += '<input type="text" name="items[' + index + '][' + i + '].Value" class="input-xxlarge ' + (tmpItem.Required ? ' required ' : '') + (tmpItem.Type != 'input' ? tmpItem.Type : '') + '"' +
						' placeholder = "' + itemDesc + '" title = "' + itemDesc + '"/>';
            }
            else if (tmpItem.Type == 'textarea') {
                htmlTmp += '<textarea name="items[' + index + '][' + i + '].Value" rows = "5" class="input-xxlarge ' + (tmpItem.Required ? ' required ' : '') + '"' +
						' placeholder = "' + itemDesc + '" title = "' + itemDesc + '"></textarea>';
            }
            else if (tmpItem.Type == 'radio' || tmpItem.Type == 'checkbox') {
                if (tmpItem.Subitems != null && tmpItem.Subitems.length > 0) {
                    htmlTmp += '<div style="margin-top:5px;">';
                    if (itemDesc != '') htmlTmp += '<div class="ctl_prompt">' + itemDesc + '</div>';
                    var maxItemLength = 0;
                    for (var j = 0; j < tmpItem.Subitems.length; j++) {
                        if (tmpItem.Subitems[j].length > maxItemLength) maxItemLength = tmpItem.Subitems[j].length;
                    }
                    var contr_width = maxItemLength < 4 ? "input-mini" : (maxItemLength < 6 ? 'input-small' : (maxItemLength < 9 ? 'input-medium' : (maxItemLength < 13 ? 'input-large' : (maxItemLength < 19 ? 'input-xlarge' : 'input-xxlarge'))))
                    for (var j = 0; j < tmpItem.Subitems.length; j++) {
                        htmlTmp += '<div class="' + contr_width + '" style="float:left;margin:0px 10px 0px 0px;"><label class="' + tmpItem.Type + '">';
                        htmlTmp += '<input name="items[' + index + '][' + i + '].Value" type="' + tmpItem.Type + '" value="' + tmpItem.Subitems[j].replace("\"", "\\\"").replace("\n", " ") + '" />&nbsp;' + tmpItem.Subitems[j];
                        htmlTmp += '</label></div>';
                    }
                    htmlTmp += '<div style="clear:both"></div></div>';
                }
            }
            else if (tmpItem.Type == 'select') {
                if (tmpItem.Subitems != null && tmpItem.Subitems.length > 0) {
                    htmlTmp += '<select name="items[' + index + '][' + i + '].Value" class="input-xxlarge ' + (tmpItem.Required ? ' required ' : '') + '" title = "' + itemDesc + '">';
                    htmlTmp += '<option value="请选择">请选择</option>';
                    for (var j = 0; j < tmpItem.Subitems.length; j++) {
                        htmlTmp += '<option value="' + tmpItem.Subitems[j].replace("\"", "\\\"").replace("\n", " ") + '">' + tmpItem.Subitems[j] + "</option>";
                    }
                    htmlTmp += '</select>';
                    if (itemDesc != '') htmlTmp += '<span class="ctl_prompt">&nbsp;&nbsp;' + itemDesc + '</span>';
                }
            }
            else if (tmpItem.Type == 'file') {
                htmlTmp += '<span id="att_' + index + '_' + i + '" onclick="attachSrcEle = $(this).prev();$(\'#asyn_upload_register_form input\').click();">点击上传</span>';
                if (itemDesc != '') htmlTmp += '<div class="ctl_prompt" style="text-align:left;line-height: 3;margin-left: -20px;clear:both;">&nbsp;&nbsp;' + itemDesc + '</div>';
            }
            htmlTmp += '</div>';
            htmlTmp += '</div>';
            if (flagAddi) i++;
        }
        htmlTmp += '<div style="clear:both;"></div>'
    }
    return htmlTmp;
}



<!DOCTYPE html>
<html lang="en" xmlns:wb="http://open.weibo.com/wb" class="huodongxing">
	<head>
		<title>免费发布活动</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta name="viewport" content="width=960, initial-scale=1.0" />
		<meta name="distribution" content="global" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <!-- Set render engine for 360 browser -->
  		<meta name="renderer" content="webkit">
		<meta name="author" content="活动行" />
		<meta name="publisher" content="活动行" />
		<meta name="rating" content="general" />
		<meta name="copyright" content="&copy; 2012 京ICP备12026130号" />
		<meta name="webcrawlers" content="all" />
		<meta name="company" content="北京艾科创意信息技术有限公司" />
		<meta name="subject" content="活动行 伴活动同行" />
		<meta name="abstract" content="领先的活动报名及电子票务平台" />
		<meta name="baidu-tc-cerfication" content="8dcff192eb44c68b8842674383c8dc0e" />
		<meta name="google-site-verification" content="yhELKIT-GNSIJ9Clsi1uA1jMnyTkkLY9D3iug_kNp2o" />
		<meta name="sina-page-nonceid" content="2535KbV86db3d955Ef56KVU95485n88g88gxfF059J589iy8e7585d6v" />
			<meta name="description" content="&quot;&quot;活动&quot;&quot;开始结束时间、地址、活动地图、票价、票务说明、报名参加、主办方、照片、讨论、活动海报等" />
			<meta name="keywords" content="活动详情,报名人数,时间,图片海报,活动地图,票价,票务说明,主办方,活动论坛" />
			<meta property="og:description" content="&quot;&quot;活动&quot;&quot;开始结束时间、地址、活动地图、票价、票务说明、报名参加、主办方、照片、讨论、活动海报等" />
			<meta property="og:title" content="" />
			<meta property="og:type" content="website" />
			<meta property="og:site_name" content="活动行" />
			<meta property="og:image" content="http://cdn.huodongxing.com/Content/v2.0/img/event_logo.png" />
		
	    <link rel="SHORTCUT ICON" href="http://cdn.huodongxing.com/Content/img/favicon.ico"/>
		<link href="http://cdn.huodongxing.com/Content/v2.0/dist/css/hdx.min.css?v=v3.9.3" rel="stylesheet" type="text/css" />

		<!--[if lte IE 6]><link href="http://cdn.huodongxing.com/Content/css/ie6-fix.css" type="text/css" rel="stylesheet"><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" href="http://cdn.huodongxing.com/Content/css/ie.css" /><![endif]-->
		
	<link href="http://cdn.huodongxing.com/Content/v2.0/dist/css/event-create.min.css?v=v3.9.3" rel="stylesheet" type="text/css" />
	<link href="http://cdn.huodongxing.com/Content/v2.0/dist/css/datepicker.min.css" rel="stylesheet" type="text/css" />
	<link href="http://cdn.huodongxing.com/Content/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
	<link href="http://cdn.huodongxing.com/Content/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />

     	<!--[if lt IE 9]><script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/ie/html5.js"></script><![endif]-->

		<script src="http://cdn.huodongxing.com/Content/v2.0/dist/js/jquery.js" type="text/javascript"></script>

		
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/validate/jquery.validate.min.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/validate/messages_cn.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/jquery.form.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/jquery.file.upload/jquery.iframe-transport.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/jquery.file.upload/jquery.fileupload.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/jquery.file.upload/jquery.fileupload-fp.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/bootstrap/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/jquery.ba-throttle-debounce.min.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/accupass.form.js"></script>

	<script type="text/javascript" src="/Content/js/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/Content/js/ueditor/ueditor.all.min.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/v2.0/dist/js/art-template.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/ueditor/third-party/zeroclipboard/ZeroClipboard.min.js"></script>

		<script type="text/javascript">
			function google_analytics_script(){
				(function (i, s, o, g, r, a, m) {
					i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
						(i[r].q = i[r].q || []).push(arguments)
					}, i[r].l = 1 * new Date(); a = s.createElement(o),
					m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m);
				})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
				ga('create', 'UA-34953182-1', 'huodongxing.com');
ga('set', '&uid', { 'userId':'1712390596057'});				ga('require', 'displayfeatures');
				ga('send', 'pageview');

				ga(function(tracker) { $("#google_analytics_client_id").val(tracker.get('clientId')); });
			}
           
			var uvOptions = {};
			var _atrk_opts = { atrk_acct: "GgKTe1aoiI00WL", domain: "huodongxing.com", dynamic: true };

			function validateEmail(email) {
				if (email == null || $.trim(email) == "") return false;
				var pattern = /^([A-Za-z0-9]+)(([A-Za-z0-9]+)|(_+)|(\-+)|(\.+)|(\++))*@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/i;
				return pattern.test(email);
			}
			function validatePhone(phone) {
				if (phone == null || $.trim(phone) == "") return false;
				var pattern = /(^((0[1,2]{1}\d{1}-?\d{8})|(0[3-9]{1}\d{2}-?\d{7,8}))$)|(^(0|86|17951)?(13[0-9]|15[0-35-9]|17[0678]|18[0-9]|14[57])[0-9]{8}$)/;
				return pattern.test(phone);
			}
			Date.prototype.format = function (format) { //author: meizz
				var o = {
					"M+": this.getMonth() + 1, //month
					"d+": this.getDate(),    //day
					"h+": this.getHours(),   //hour
					"m+": this.getMinutes(), //minute
					"s+": this.getSeconds(), //second
					"q+": Math.floor((this.getMonth() + 3) / 3),  //quarter
					"S": this.getMilliseconds() //millisecond
				}
				if (/(y+)/.test(format)) format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
				for (var k in o) if (new RegExp("(" + k + ")").test(format))
					format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
				return format;
			}
		</script>
		
        <script type="text/javascript" name="baidu-tc-cerfication" data-appid="6741073" src="http://apps.bdimg.com/cloudaapi/lightapp.js"></script>
	</head>
	<body class="huodongxing">
        <!--[if lte IE 6]><script src="http://cdn.huodongxing.com/Content/js/ie/warning.js"></script><script>window.onload=function(){e("http://cdn.huodongxing.com/Content/img/");}</script><![endif]-->
		<div class="hdx-header">
			<div class="container-lg">
                <a href="http://www.huodongxing.com"><img src="http://cdn.huodongxing.com/Content/v2.0/img/logo.png" alt="" class="logo" /></a>
                
				<ul class="items">
					<li><a class='' target="_blank" href="http://www.huodongxing.com">首页</a></li>
                    <li><a class='' target="_blank" href="http://www.huodongxing.com/zhubanfang">主办方</a></li>
				    <li class="dropdown2 dropdown2-white">
				        <a data-toggle="dropdown2" class='' target="_blank" href="http://www.huodongxing.com/events">发现活动<b class="caret"></b></a>
				        <div class="dropdown2-menu">
				            <div>
				                <strong><span class="icon-time"></span>时间</strong>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist">全部</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?d=t2">今天</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?d=t3">明天</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?d=t1">本周</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?d=t4">本周末</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?d=t5">本月</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/calendar">指定日期</a></div>
				            </div>
				            <div>
				                <strong><span class="icon-like"></span>兴趣</strong>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist">全部</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e5%88%9b%e4%b8%9a">创业</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e5%95%86%e5%8a%a1">商务</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e7%a7%91%e6%8a%80">科技</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e8%af%be%e7%a8%8b">课程</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e7%94%9f%e6%b4%bb">生活</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e8%bf%90%e5%8a%a8">运动</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e7%a4%be%e4%ba%a4">社交</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e5%a8%b1%e4%b9%90">娱乐</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e4%ba%b2%e5%ad%90">亲子</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e6%96%87%e5%8c%96">文化</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e9%9f%b3%e4%b9%90">音乐</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e7%94%b5%e5%bd%b1">电影</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e5%85%ac%e7%9b%8a">公益</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?tag=%e6%a0%a1%e5%9b%ad">校园</a></div>
				            </div>
				            <div>
				                <strong><span class="icon-place"></span>城市</strong>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?">全部</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e5%8c%97%e4%ba%ac">北京</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e4%b8%8a%e6%b5%b7">上海</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e5%b9%bf%e5%b7%9e">广州</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e6%b7%b1%e5%9c%b3">深圳</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e6%9d%ad%e5%b7%9e">杭州</a></div>

                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e6%88%90%e9%83%bd">成都</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e5%8d%97%e4%ba%ac">南京</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e8%8b%8f%e5%b7%9e">苏州</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e6%ad%a6%e6%b1%89">武汉</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e5%a4%a9%e6%b4%a5">天津</a></div>

                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e9%87%8d%e5%ba%86">重庆</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e8%a5%bf%e5%ae%89">西安</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e5%8e%a6%e9%97%a8">厦门</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e5%ae%81%e6%b3%a2">宁波</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e9%83%91%e5%b7%9e">郑州</a></div>
				                
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e9%9d%92%e5%b2%9b">青岛</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e4%b8%9c%e8%8e%9e">东莞</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e4%bd%9b%e5%b1%b1">佛山</a></div>
                                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e9%95%bf%e6%b2%99">长沙</a></div>
				                <div><a target="_blank" href="http://www.huodongxing.com/eventlist?city=%e7%9f%b3%e5%ae%b6%e5%ba%84">石家庄</a></div>
				            </div>
				        </div>
				    </li>
				    
				</ul>
                <div id='searchEventArea'>
                    <form action="http://www.huodongxing.com/search" method="post" target=&quot;_blank&quot; class="search">
                        <div class="dropdown">
                            <a data-toggle="dropdown2" aria-expanded="false">
                                <span>活动</span><div class="search-tab-icon"><i><em></em><span></span></i></div>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="" title="活动" str="活动">活动</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="" title="主办方" str="活动">主办方</a></li>
                            </ul>
                        </div>
                        <input name="qs" id="mainSearchTextbox" type="text" placeholder="搜索您想要的活动" value="" onchange="javascript:preventDefault();$('#mainSearchButton').attr('href','http://www.huodongxing.com/search?qs=' + $(this).val());"/>
                        <button id="mainSearchButton"><span class="sr-only">搜索</span><span class="icon-search"></span></button>
                    </form>
                </div>
                <div id='searchOrgArea' style="display: none;" class="search">        
                    <div class="dropdown">
                        <a data-toggle="dropdown2" aria-expanded="false">
                            <span>主办方</span><div class="search-tab-icon"><i><em></em><span></span></i></div>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="" title="活动" str="主办方">活动</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="" title="主办方" str="主办方">主办方</a></li>
                        </ul>
                    </div>
                    <input type="text" placeholder="搜索您想要的主办方" onkeypress='if(event.keyCode==13){ $("#searchOrgArea button").click();}';/>
                    <button><span class="sr-only">搜索</span><span class="icon-search"></span></button>   
                </div>
					<div class="user dropdown2">
						<a data-toggle="dropdown" href="">
							<img class="face" src="http://qzapp.qlogo.cn/qzapp/100306609/DAE8C7B2B20C21857B11DB5BFCAAEE4C/30" alt="">
							<span class="name">年轻的沉轮<b class="caret"></b></span>
						</a>
						<ul class="dropdown2-menu" role="menu" aria-labelledby="dLabel">
                            
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://www.huodongxing.com/user/index" class="icon-dropdown-logo">我的活动行</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://www.huodongxing.com/user/regevents" class="icon-dropdown-ticket">我参与的</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://www.huodongxing.com/user/pubevents" class="icon-mycreate">我发布的</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://www.huodongxing.com/account/orgnizers" class="icon-dropdown-org">我的主办方</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="http://www.huodongxing.com/account/profile"class="icon-dropdown-config">账户设置</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="http://www.huodongxing.com/logout?returnUrl=%2fmyevent%2fcreate" class="icon-shutdown">退出</a></li>
						</ul>
					</div>
                <a href="http://www.huodongxing.com/myevent/category" class="hdx-header-create" target="_blank"><span></span>发布活动</a>
                <a href="http://www.huodongxing.com/appdownload2?utm_source=APP-TOP-AD&utm_medium=&utm_campaign=publicpage">下载App</a>
			</div>
		</div>
		

<input type="hidden" value="9349262607200" id="activity_id" />
    <a href="http://www.huodongxing.com/bbx?utm_source=发布活动&utm_medium=&utm_campaign=myevent_create" target="_blank" id="bbx-entry">
        <div style="position:relative;padding-bottom:40px;">
            <img style="position:absolute" src="http://cdn.huodongxing.com/Content/v2.0/img/bbx/entry_myevent_create.png" alt="" width="100%">
            <img id="bbx-close-btn" src="/Content/v2.0/img/bbx/btn_close.png" style="position: absolute;right:1px;" alt="" >
        </div>
    </a>
<div class="event-create create-event-container" id="event_main_edit_area">
	<!-- <a href="http://www.huodongxing.com/myevent/category" class="event-create-skip event-create-skip-back">
	    <span class="icon-prev-primary"></span>返回
	</a> -->
    <style type="text/css">
    .tag-title{float:left;margin:6px 20px 0px 0px;padding-left:4px;font-weight:bold;}
    .create-event-category {background: #f6f6f6 none repeat scroll 0 0;border-color: #e5e5e5;padding: 5px;}
    .event-create-add-category-modal {background: #fff none repeat scroll 0 0;border: 1px solid #e5e5e5;box-shadow: 1px 1px 1px #c9c9c9;max-width: 899px;padding: 20px 10px 0 20px;position: absolute;margin-top:15px;z-index: 1050;}
    .event-create-add-label-modal {margin-top: 5px;}
    .event-create-add-category-modal li {cursor: pointer;margin-bottom: 20px;}
    .event-create-add-category li {border: 1px dashed #a0a0a0;color: #a0a0a0;padding: 4px 20px;}
    .event-create-add-category .create-event-category, .event-create-add-category li {float: left;margin-right: 9px;}
    .event-create-add-category-list li {background: #eee none repeat scroll 0 0;position: relative;}
    .event-create-add-category-modal li.active {background: #e5e5e5 none repeat scroll 0 0;cursor: default;}
    .event-create-add-label-modal {max-width:800px;}
</style>
<div class="event-create-body">
        
    <div class="event-create-label event-create-label-long">
        填写基本信息
    </div>
<form action="/myevent/SaveEvent" class="event-create-form" id="event_base_form" method="post"><input id="Reference" name="Reference" type="hidden" value="" /><input id="Id" name="Id" type="hidden" value="9349262607200" /><input id="Category" name="Category" type="hidden" value="0" />	    <input type="hidden" id="save_event_form_token" name="webTokenValue" value="12A2ECA7AB18CB569D293EC81D2004E7875948B6C94254A9C0AA0D7E7BAC370B6DE97417E9F360DF6B" />
	    <div class="form-group">
            <label for="event-create-name" class="control-label">填写名称<em>*</em></label>
            <input class="form-control event-create-form-control-block" id="event-create-name" maxlength="100" minlength="5" name="Title" placeholder="活动标题(不少于5个字)" type="text" value="" />
        </div>
        <div class="form-group event-create-place">
            <label class="control-label">选择地点<em>*</em></label>
            <select id="select_province" style="width:165px;height:48px;vertical-align:middle;margin-right:5px;"></select><select id="select_city" style="width:166px;height:48px;vertical-align:middle;margin"></select>
            <input id="City" name="City" type="hidden" value="" />
		    <input id="Setting_Province" name="Setting.Province" type="hidden" value="" />
			<input id="Location" name="Location" type="hidden" value="" />
            <input class="form-control event-create-place-input" data-placement="top" id="Address" maxlength="250" name="Address" onchange="javascript:changeAndLoadMap(true, true);" placeholder="例如：北京市海淀区中关村南大街" title="地图可精确您的活动位置！" type="text" value="" />
            <span class="icon-event-create-place"></span>
            <div id="baidumapContainer" class="BaiDuMap"></div>
        </div>
        <div class="form-group event-create-date">
            <label class="control-label">活动时间<em>*</em></label>
            <div>开始时间：</div>
            <div class="form-group-date">
                <input id="Start" name="Start" style="display:none" type="text" value="2016/8/29 18:25:59" />
                <span class="icon-event-ticket-calendar"></span><input type="text" id="event_start_date" value="2016/08/29" class="form-control"><select id="event_start_time" style="width:165px;height:48px;vertical-align:middle;margin-left:6px;">
					    <option value="00:00" >00:00</option>
					    <option value="00:30" >00:30</option>
					    <option value="01:00" >01:00</option>
					    <option value="01:30" >01:30</option>
					    <option value="02:00" >02:00</option>
					    <option value="02:30" >02:30</option>
					    <option value="03:00" >03:00</option>
					    <option value="03:30" >03:30</option>
					    <option value="04:00" >04:00</option>
					    <option value="04:30" >04:30</option>
					    <option value="05:00" >05:00</option>
					    <option value="05:30" >05:30</option>
					    <option value="06:00" >06:00</option>
					    <option value="06:30" >06:30</option>
					    <option value="07:00" >07:00</option>
					    <option value="07:30" >07:30</option>
					    <option value="08:00" >08:00</option>
					    <option value="08:30" >08:30</option>
					    <option value="09:00" >09:00</option>
					    <option value="09:30" >09:30</option>
					    <option value="10:00" >10:00</option>
					    <option value="10:30" >10:30</option>
					    <option value="11:00" >11:00</option>
					    <option value="11:30" >11:30</option>
					    <option value="12:00" >12:00</option>
					    <option value="12:30" >12:30</option>
					    <option value="13:00" >13:00</option>
					    <option value="13:30" >13:30</option>
					    <option value="14:00" >14:00</option>
					    <option value="14:30" >14:30</option>
					    <option value="15:00" >15:00</option>
					    <option value="15:30" >15:30</option>
					    <option value="16:00" >16:00</option>
					    <option value="16:30" >16:30</option>
					    <option value="17:00" >17:00</option>
					    <option value="17:30" >17:30</option>
					    <option value="18:00" >18:00</option>
					    <option value="18:30" >18:30</option>
					    <option value="19:00" >19:00</option>
					    <option value="19:30" >19:30</option>
					    <option value="20:00" >20:00</option>
					    <option value="20:30" >20:30</option>
					    <option value="21:00" >21:00</option>
					    <option value="21:30" >21:30</option>
					    <option value="22:00" >22:00</option>
					    <option value="22:30" >22:30</option>
					    <option value="23:00" >23:00</option>
					    <option value="23:30" >23:30</option>
					    <option value="00:00" >00:00</option>
					    <option value="00:30" >00:30</option>
					    <option value="01:00" >01:00</option>
					    <option value="01:30" >01:30</option>
					    <option value="02:00" >02:00</option>
					    <option value="02:30" >02:30</option>
					    <option value="03:00" >03:00</option>
					    <option value="03:30" >03:30</option>
					    <option value="04:00" >04:00</option>
					    <option value="04:30" >04:30</option>
					    <option value="05:00" >05:00</option>
					    <option value="05:30" >05:30</option>
					    <option value="06:00" >06:00</option>
					    <option value="06:30" >06:30</option>
					    <option value="07:00" >07:00</option>
					    <option value="07:30" >07:30</option>
					    <option value="08:00" >08:00</option>
					    <option value="08:30" >08:30</option>
					    <option value="09:00" >09:00</option>
					    <option value="09:30" >09:30</option>
					    <option value="10:00" >10:00</option>
					    <option value="10:30" >10:30</option>
					    <option value="11:00" >11:00</option>
					    <option value="11:30" >11:30</option>
					    <option value="12:00" >12:00</option>
					    <option value="12:30" >12:30</option>
					    <option value="13:00" >13:00</option>
					    <option value="13:30" >13:30</option>
					    <option value="14:00" >14:00</option>
					    <option value="14:30" >14:30</option>
					    <option value="15:00" >15:00</option>
					    <option value="15:30" >15:30</option>
					    <option value="16:00" >16:00</option>
					    <option value="16:30" >16:30</option>
					    <option value="17:00" >17:00</option>
					    <option value="17:30" >17:30</option>
					    <option value="18:00" >18:00</option>
					    <option value="18:30" >18:30</option>
					    <option value="19:00" >19:00</option>
					    <option value="19:30" >19:30</option>
					    <option value="20:00" >20:00</option>
					    <option value="20:30" >20:30</option>
					    <option value="21:00" >21:00</option>
					    <option value="21:30" >21:30</option>
					    <option value="22:00" >22:00</option>
					    <option value="22:30" >22:30</option>
					    <option value="23:00" >23:00</option>
					    <option value="23:30" >23:30</option>
                </select>
                <input id="End" name="End" style="display:none" type="text" value="2016/9/1 2:25:59" />
				<span class="icon-event-ticket-arrow"></span><div>结束时间：</div><span class="icon-event-ticket-calendar"></span>
				<input type="text" id="event_end_date" value="2016/09/01" class="form-control"><select id="event_end_time" style="width:165px;height:48px;vertical-align:middle;margin-left:6px;">
						<option value="00:00" >00:00</option>
						<option value="00:30" >00:30</option>
						<option value="01:00" >01:00</option>
						<option value="01:30" >01:30</option>
						<option value="02:00" >02:00</option>
						<option value="02:30" >02:30</option>
						<option value="03:00" >03:00</option>
						<option value="03:30" >03:30</option>
						<option value="04:00" >04:00</option>
						<option value="04:30" >04:30</option>
						<option value="05:00" >05:00</option>
						<option value="05:30" >05:30</option>
						<option value="06:00" >06:00</option>
						<option value="06:30" >06:30</option>
						<option value="07:00" >07:00</option>
						<option value="07:30" >07:30</option>
						<option value="08:00" >08:00</option>
						<option value="08:30" >08:30</option>
						<option value="09:00" >09:00</option>
						<option value="09:30" >09:30</option>
						<option value="10:00" >10:00</option>
						<option value="10:30" >10:30</option>
						<option value="11:00" >11:00</option>
						<option value="11:30" >11:30</option>
						<option value="12:00" >12:00</option>
						<option value="12:30" >12:30</option>
						<option value="13:00" >13:00</option>
						<option value="13:30" >13:30</option>
						<option value="14:00" >14:00</option>
						<option value="14:30" >14:30</option>
						<option value="15:00" >15:00</option>
						<option value="15:30" >15:30</option>
						<option value="16:00" >16:00</option>
						<option value="16:30" >16:30</option>
						<option value="17:00" >17:00</option>
						<option value="17:30" >17:30</option>
						<option value="18:00" >18:00</option>
						<option value="18:30" >18:30</option>
						<option value="19:00" >19:00</option>
						<option value="19:30" >19:30</option>
						<option value="20:00" >20:00</option>
						<option value="20:30" >20:30</option>
						<option value="21:00" >21:00</option>
						<option value="21:30" >21:30</option>
						<option value="22:00" >22:00</option>
						<option value="22:30" >22:30</option>
						<option value="23:00" >23:00</option>
						<option value="23:30" >23:30</option>
						<option value="00:00" >00:00</option>
						<option value="00:30" >00:30</option>
						<option value="01:00" >01:00</option>
						<option value="01:30" >01:30</option>
						<option value="02:00" >02:00</option>
						<option value="02:30" >02:30</option>
						<option value="03:00" >03:00</option>
						<option value="03:30" >03:30</option>
						<option value="04:00" >04:00</option>
						<option value="04:30" >04:30</option>
						<option value="05:00" >05:00</option>
						<option value="05:30" >05:30</option>
						<option value="06:00" >06:00</option>
						<option value="06:30" >06:30</option>
						<option value="07:00" >07:00</option>
						<option value="07:30" >07:30</option>
						<option value="08:00" >08:00</option>
						<option value="08:30" >08:30</option>
						<option value="09:00" >09:00</option>
						<option value="09:30" >09:30</option>
						<option value="10:00" >10:00</option>
						<option value="10:30" >10:30</option>
						<option value="11:00" >11:00</option>
						<option value="11:30" >11:30</option>
						<option value="12:00" >12:00</option>
						<option value="12:30" >12:30</option>
						<option value="13:00" >13:00</option>
						<option value="13:30" >13:30</option>
						<option value="14:00" >14:00</option>
						<option value="14:30" >14:30</option>
						<option value="15:00" >15:00</option>
						<option value="15:30" >15:30</option>
						<option value="16:00" >16:00</option>
						<option value="16:30" >16:30</option>
						<option value="17:00" >17:00</option>
						<option value="17:30" >17:30</option>
						<option value="18:00" >18:00</option>
						<option value="18:30" >18:30</option>
						<option value="19:00" >19:00</option>
						<option value="19:30" >19:30</option>
						<option value="20:00" >20:00</option>
						<option value="20:30" >20:30</option>
						<option value="21:00" >21:00</option>
						<option value="21:30" >21:30</option>
						<option value="22:00" >22:00</option>
						<option value="22:30" >22:30</option>
						<option value="23:00" >23:00</option>
						<option value="23:30" >23:30</option>
				</select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">上传海报</label>
            <div class="media event-create-poster" id="event-create-poster">
                <img class="drop-zone" src="http://cdn.huodongxing.com/Content/v2.0/img/event-create-drop-zone.png">
                <div class="pull-left" id="poster-preview">
                    <img id="event_logo_image" class="pull-left" src="http://cdn.huodongxing.com/Content/v2.0/img/event-create-poster-holder.png" alt="海报 尺寸：1080*640 px" style="width:472px;height:280px;"/>
                </div>
                <div class="media-body">
                    <div class="btn btn-primary btn-lg ">
                        <span class="icon-btn-upload"></span><span>上传</span>
                        <input type="file" accept=".jpg,.jpeg,.gif,.png,.webp" id="poster-input" name="poster-input">
                    </div>
                    <a href="#event-poster-default-modal" class="text-primary" data-toggle="modal">没有准备海报？</a>
                    <div>
                            温馨提示：
                            <br/>
                            可以点击上传选择图片，也可以直接拖拽<span id="ie-paste-fix">或粘贴</span>图片至此窗口。
                        </div>
                        <p>
                            一张漂亮的海报，能让你的活动锦上添花，带来更多用户报名
                            <br/>
                            及增加传播效果，也将影响其在活动行App被推荐的几率！
                        </p>
                </div>
            </div>
            <div class="modal" id="event-poster-modal">
                    <div class="modal-dialog">
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <div class="pull-right"><span class="icon-refresh-md"></span>重新上传</div>
                            <button class="btn btn-primary btn-lg">确定</button><button class="btn btn-lg btn-create-default" data-dismiss="modal">取消</button>
                        </div>
                    </div>
                </div>
        </div>
        <div class="form-group">
            <label for="event-create-peopple-number" class="control-label">活动人数</label>
            <input class="form-control event-create-form-control-block digits" id="MaxInstance" maxlength="5" name="MaxInstance" placeholder="最多允许的人数,0不限制活动名额" type="text" value="100" />
        </div>
        <div class="form-group" style="margin-bottom:45px;">
            <label class="control-label">活动分类<em>*</em></label>
            <div class="event-create-add-category">
                <button class="btn create-event-category" id="evt_category"><span class="icon-event-label-add"></span></button>
                <div class="event-create-add-category-list" style="padding-top: 4px;">
                    <input type="hidden" id="event-select-hdxtag" name="Setting.HdxTags" value="" />
                    <input type="hidden" id="event-select-mode" name="mode" value="" />
                    <ul>
                        
                    </ul>
                    <span class="icon-event-create-alert" title="添加合适的活动类别和活动形式有利于用户在站内、站外发现您的活动"></span>
                </div>
                <div class="event-create-add-category-modal hide" id="evt_category_content">
                    <ul>
                        <div id="evt_category"><span class="tag-title">活动类别：</span><li>IT</li><li>互联网</li><li>移动互联网</li><li>电商</li><li>创业</li><li>科技</li><li>投资</li><li>理财</li><li>金融</li><li>营销</li><li>游戏</li><li>亲子</li><li>母婴</li><li>校园</li><li>女性</li><li>公益</li><li>运动</li><li>户外</li><li>旅行</li><li>教育</li><li>手工</li><li>摄影</li><li>文艺</li><li>设计</li><li>读书</li><li>交友</li><li>时尚</li><li>广告</li><li>媒体</li><li>职场</li><li>电影</li><li>音乐</li><li>心理</li><li>健康</li><li style="margin-right: 510px;">演出</li></div>
                        <div id="evt_form"><span class="tag-title">活动形式：</span><li>会议</li><li>展览</li><li>论坛</li><li>课程</li><li>讲座</li><li>沙龙</li><li>聚会</li><li>市集</li><li>派对</li><li>赛事</li><li>分享会</li><li>公开课</li><li>音乐节</li><li>音乐会</li><li>演唱会</li><li>舞台剧</li><li>首映会</li><li>开幕式</li><li>发布会</li></div>
                    </ul>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div class="form-group">
            <label class="control-label">添加标签</label>
            <div class="event-create-add-label" style="padding-top: 4px;">
                <button class="btn create-event-label" id="evt_tag"><span class="icon-event-label-add"></span></button>
                <div class="event-create-add-label-list">
                    <ul>
                    </ul>
                    <span class="icon-event-create-alert" title="添加合适的标签有利于用户在站内、站外发现您的活动， 最多添加五个标签"></span>
                </div>
                <div class="event-create-add-label-modal hide" id="evt_tag_content">
                    <ul>
                        <li>IT</li><li>互联网</li><li>移动互联网</li><li>电商</li>
                        <li>创业</li><li>创新</li><li>科技</li><li>公益</li>
                        <li>慈善</li><li>环保</li><li>分享会</li><li>志愿者</li>
                        <li>分享</li><li>户外</li><li>教育</li><li>讲座</li>
                        <li>公开课</li><li>课程</li><li>培训</li><li>英语</li>
                        <li>口才</li><li>沙龙</li><li>聚会</li><li>论坛</li>
                        <li>会议</li><li>交流</li><li>展览</li><li>摄影</li>
                        <li>展会</li><li>创意</li><li>文艺</li><li>艺术</li>
                        <li>文学</li><li>文化</li><li>活动</li><li>设计</li>
                        <li>校园</li><li>儿童</li><li>亲子</li><li>读书</li>
                        <li>交友</li><li>演讲</li><li>手工</li><li>融资</li>
                        <li>理财</li><li>金融</li><li>营销</li><li>投资</li>
                        <li>时尚</li><li>媒体</li><li>职场</li><li>免费</li>
                        <li>音乐</li><li>游戏</li><li>休闲</li><li>心理</li>
                        <li>健康</li><li>电影</li><li>音乐会</li><li>演唱会</li>
                        <li>舞台剧</li><li>首映</li><li>开幕式</li><li>发布会</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="event-privacy" class="control-label">活动推广</label>
            <div class="event-create-radio">
                <label  style="margin-top: 15px;"><input style="top:0px;" type="checkbox" id="event-privacy" name="event-privacy" checked="checked"  >请活动行协助推广<span style="color:#a0a0a0;cursor: default;">（在【活动行】网站公开展示，例如主页、发现页、专题、APP等。<a target="_blank" href="https://mp.weixin.qq.com/s?__biz=MjM5OTc1MTc4MA==&mid=404734890&idx=1&sn=9c27f2482c2031c039e7f547f3393f59&scene=1&srcid=0328pWaKLD0bnji1KvW88HH8#wechat_redirect">查看获得活动行推广的条件</a>）</span></label>
                <input id="Setting_IsPrivate" name="Setting.IsPrivate" type="hidden" value="" />
            </div>
        </div>
<input id="Tag" name="Tag" type="hidden" value="" />		<div class="form-group" style="display:none;" id="anchor-event-description">
			<label class="control-label" for="Setting_Summary">活动摘要 <font style="color:red;">*</font></label>
			<input id="Setting_Layout" name="Setting.Layout" type="hidden" value="" />
			<textarea class="required" cols="20" id="Setting_Summary" maxlength="150" name="Setting.Summary" placeholder="请填写活动摘要" rows="4" style="width:100%;">
</textarea>
		</div>
        <div class="form-group">
            <label class="control-label">详细内容<em>*</em></label>
                <div class="event-create-form-control-block">
                    <textarea id="EventBaseDescription" name="Description" placeholder = "请填写活动内容" style="height:400px;width:930px;">
				        
			        </textarea>
                </div>
        </div>
</form>    <div id="autoSaveTip" style="color:gray;padding-right:20px;"></div>
		<button class="btn btn-create-event-state" onclick="javascript:saveEventForDraft();return false;">保存信息</button>
			<input type="hidden" name="edit_exist_event_flag" value="true"/>
</div>
<div class="modal" id="event-poster-default-modal">
    <div class="modal-dialog">
        <div class="modal-body">
            <ul>
                <li><img src="/Content/v2.0/img/poster/thumb/es.jpg" alt=""/>创业</li>
                <li><img src="/Content/v2.0/img/poster/thumb/school.jpg" alt=""/>校园</li>
                <li><img src="/Content/v2.0/img/poster/thumb/movie.jpg" alt=""/>电影</li>
                <li><img src="/Content/v2.0/img/poster/thumb/benefit.jpg" alt=""/>公益</li>
                <li><img src="/Content/v2.0/img/poster/thumb/tech.jpg" alt=""/>科技</li>
                <li><img src="/Content/v2.0/img/poster/thumb/course.jpg" alt=""/>课程</li>
                <li><img src="/Content/v2.0/img/poster/thumb/course2.jpg" alt=""/>课程</li>
                <li><img src="/Content/v2.0/img/poster/thumb/baby.jpg" alt=""/>亲子</li>
                <li><img src="/Content/v2.0/img/poster/thumb/business.jpg" alt=""/>商务</li>
                <li><img src="/Content/v2.0/img/poster/thumb/social.jpg" alt=""/>社交</li>
                <li><img src="/Content/v2.0/img/poster/thumb/life.jpg" alt=""/>生活</li>
                <li><img src="/Content/v2.0/img/poster/thumb/culture.jpg" alt=""/>文化</li>
                <li><img src="/Content/v2.0/img/poster/thumb/music.jpg" alt=""/>音乐</li>
                <li><img src="/Content/v2.0/img/poster/thumb/entertainment.jpg" alt=""/>娱乐</li>
                <li><img src="/Content/v2.0/img/poster/thumb/sport.jpg" alt=""/>运动</li>
            </ul>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary btn-lg">选择</button><button class="btn btn-lg btn-create-default" data-dismiss="modal">取消</button>
        </div>
    </div>
</div>
<form action="/file/UploadActivityLogo" enctype="multipart/form-data" id="event_file_upload_form" method="post" style="display:none">		<input type="hidden" name="activityId"  value="9349262607200"/>
		<input id="event_logo_upload_file" type="file" name="event_logo_upload_file" />
</form>	<script type="text/javascript">
    var supportHTML5 = !!(window.File && (window.FileReader && (window.Uint8Array || window.FormData || XMLHttpRequest.prototype.sendAsBinary)));
    +function($){
        if (supportHTML5){
          var $preview =  $('#poster-preview ')
            var $posterDefaultModal = $('#event-poster-default-modal')
            $posterDefaultModal.on('click','li',function(){
                $(this).addClass('active').siblings().removeClass('active')
            }).find('.btn-primary').click(function(){
                
                var img = FileAPI.newImage($posterDefaultModal.find('.active img').attr('src').replace('thumb/',''),function(){
                    var cv = FileAPI.Image.toCanvas(img)
                    submitLogoData(cv.toDataURL(),function(){
                        $posterDefaultModal.modal('hide');
                        setTimeout(function(){
                          PopupMessage(0, "活动海报上传成功.", 1500);
                        },1000);
                        FileAPI.Image(cv).preview(472,280).get(function(err,image){
                            if(!err){
                              $preview.html(image)
                            }
                          })
                    })
                    
                })
                
            })  
        }else{
            $('[href=#posterDefaultModal]').hide()
        }

        var isPrivate="false";
        if (isPrivate==="true") 
            $("#event-privacy").removeAttr("checked");
        else
            $("#event-privacy").attr("checked","checked");

        $doc = $(document);
        $eventLabelModal = $('.event-create-add-category-modal');
        $eventLabelList = $('.event-create-add-category-list ul');
        $doc.on('click', '.create-event-category', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('.event-create-add-label-modal').addClass('hide');
            return $eventLabelModal.toggleClass('hide');
        });
        $doc.on('click.off.modal', function(e) {
            var $target;
            $target = $(e.target);
            if (!($target.hasClass('create-event-category') || $target.hasClass('icon-event-label-add'))) { $eventLabelModal.addClass('hide'); }
        });
        eventLabelList = { count: $eventLabelList.find('li').length };
        $eventLabelModal.on('click', 'li', function(e) {
            var $label, $that;
            e.stopPropagation();
            $that = $(this);
            var type=$that.parent().attr("id");
            if (type==="evt_category" || type==="evt_form") {
                var count=$eventLabelList.find('li[type='+type+']').length;
                 if (!$that.hasClass('active') && count==0) {
                    $that.addClass('active');
                    var txt=$that.html();
                    eventLabelList[txt] = $that;
                    eventLabelList.count++;
                    if(type=="evt_category"){ $("#event-select-hdxtag").val(txt); }
                    else if(type=="evt_form"){ $("#event-select-mode").val(txt); }
                    $label = $("<li class=\"fade\" type=\""+type+"\">\n  " + ($(this).html()) + "<span class=\"icon-close\"></span>\n</li>").appendTo($eventLabelList);
                    return setTimeout((function() {return $label.addClass('in');}), 0);
                }       
            }
        });
        $eventLabelList.on('click', 'li', function(e) { return e.stopPropagation(); });
        $eventLabelList.on('click', '.icon-close', function(e) {
            var listItem;
            e.stopPropagation();
            listItem = $(this).alert('close').parent().text().trim();
            var $li=$(this).parent();
            var type=$li.attr("type");
            if(type=="evt_category"){ $("#event-select-hdxtag").val(""); }
            else if(type=="evt_form"){ $("#event-select-mode").val(""); }
            $li.remove();
            if (eventLabelList[listItem]) { eventLabelList[listItem].removeClass('active'); }
            return eventLabelList.count--;
        });
    }(jQuery)
    
	    function submitLogoData(dataUrl,callback) {
            $.ajax({
			global: false,
            type: 'POST',
            url: "/file/UploadActivityLogo",
            data: { "activityId": 9349262607200, "logoData": dataUrl },
            beforeSend:function(){
                $('#pop_message_dlg').data('bs.modal',null)
                PopupMessage('warning','上传中',null,true)
            },
            success: function(data) {
                var result = "";
	            var json_result = null;
	            var layout = "Fall";
	            if (result != null && result == "" && typeof (result) != "undefined") {
	                json_result = $.parseJSON(data);
	                result = json_result.logo;
	                layout = json_result.layout;
	            }

	            if (result.indexOf("ERROR") >= 0) {
                    setTimeout(function(){
					   PopupMessage(1, "上传活动海报出错：" + result.substring(6), 2000);
                    },1000)
	            }
	            else {
	                if (result != null && typeof (result) != "undefined" && result != '' && result != 'null') {
                        
                        callback()
	                }
	            }
	        },
            complete:function(){
                $('#pop_message_dlg').modal('hide').data('bs.modal',null)
            },
	        error: function (e, data) {
                setTimeout(function(){
                    PopupMessage(1, "上传活动海报出错，请更换浏览器重试", 2500);
                },1000)
				
	        }
        });
        }
        if (!supportHTML5) {
            $('#event_file_upload_form').show().fileupload({
                autoUpload: true,
                maxNumberOfFiles: 1,
                maxFileSize: 1000000,
                pasteZone: null,
                dropZone: null,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png|bmp)$/i,
                done: function(e, data) {
                    var result = "";
                    if (typeof(data.result) == 'string') result = $.trim(data.result);
                    else {
                        if (data.result[0] != null && data.result[0].activeElement != null) result = $.trim(data.result[0].activeElement.innerText);
                    }
                    var json_result = null;
                    var layout = "Fall";
                    if (result != null && result != "" && typeof(result) != "undefined") {
                        json_result = $.parseJSON(result);
                        result = json_result.logo;
                        layout = json_result.layout;
                    }

                    if (result.indexOf("ERROR") >= 0) {
                        PopupMessage(1, "上传活动海报出错：" + result.substring(6), 2000);
                    } else {
                        if (result != null && typeof(result) != "undefined" && result != '' && result != 'null') {
                            logoUrl = '/logo/' + result;
                            $("#event_logo_image").prop("src", logoUrl);
                            $('#event-create-poster .btn-primary').find('span:first').addClass('icon-btn-upload-reload').next().html('重新上传')
                        } else {
                            PopupMessage(1, "上传活动海报出错，请重试（图片需小于1MB且至少472*280像素）", 2500);
                        }
                    }
                },
                fail: function(e, data) {
                    PopupMessage(1, "上传活动海报出错，请更换浏览器重试", 2500);
                }
            });
            $('#poster-input').remove();
            var uploadInput = document.getElementById('event_logo_upload_file');
            //$('#event-create-poster .btn-primary').click(function(){
            //    uploadInput.click()
            //})
        }
	    

	    function setEventBaseOverview(data, description) {
	        if (data == null || data.Id == null || data.Id <= 0) return;
	        $("#event_file_upload_form input[name='activityId']").val(data.Id);
	        $("#event_title_overview").html(data.Title);
	        $("#event_time_overview").html(new Date(parseInt(data.Start.substring(6))).format("yyyy/MM/dd hh:mm") + " ～ " + new Date(parseInt(data.End.substring(6))).format("yyyy/MM/dd hh:mm"));
	        $("#event_address_overview").html(data.City + "&nbsp;" + data.Address);
	        $("#event_tag_overview").html(data.Tag);
	        $("#event_maxinstance_overview").html(data.MaxInstance);
	        $("#event_description_overview").html(description);
	    }
    </script>
<form action="/myevent/SaveEventTagPage" class="form-horizontal" id="event_tagpage_form" method="post" style="display:none;">	<input type="hidden" name="SN" id="event_tag_page_sn" value="-1" />
	<input type="hidden" name="activityId" value="9349262607200" />
	<input type="hidden" name="Deleted" id="event_tag_page_deleted" value="false" />
    <input type="hidden" name="Title" />
    <textarea name="Content" id="event_tag_page_editor"></textarea>
</form>

<script type="text/javascript">
	var descEditor;
    var onSaveEventTagPageSuccess;
	descEditor = new UE.ui.Editor();
	descEditor.render("EventBaseDescription");
	var hasDescChanged = false;

	var canedit = true;
	var autoSaveFlag = true;

    //新页签
	var $eventDespAdd = $('#event-create-description-add');
	var $eventDespAddLi = $eventDespAdd.parent();
	var $eventDesTabcontent = $eventDespAdd.parents('.tabs').next();
	var eventDespTabIdIndex = 0;
	var $eventDesTab = $('.event-create-description .tabs');
	var descEditors = [];
	$eventDespAdd.on('click', function(e) {
		if(!canedit) return;
		if($('.tab-pane [id^="EventTagPage"]').length >= 3) { PopupMessage(1, "最多只能添加3个新页签！", 2000);return false;}
		var newInput, range;
		var tmpIndex = eventDespTabIdIndex;
		e.preventDefault();
		$eventDesTabcontent.append("<div class=\"tab-pane fade\" id=\"EventTagPage" + tmpIndex + "\">\n  <textarea id=\"EventTagPageContent" + tmpIndex + "\" name=\"Description\" placeholder = \"请填写字页面内容\"></textarea><input type=\"hidden\" value=\"-1\" />\n</div>");
		descEditors[tmpIndex] = new UE.ui.Editor();
		descEditors[tmpIndex].render("EventTagPageContent" + tmpIndex);
		descEditors[tmpIndex].addListener('blur',function(){
			onSaveEventTagPageSuccess = function(data){$('#EventTagPage'+tmpIndex+' input').val(data.SN);};
			saveEventTagPage(tmpIndex);
		}); 
		newInput = $eventDespAddLi.before("<li>\n  <a href=\"#EventTagPage" + tmpIndex + "\" id=\"event-create-description-add"+tmpIndex+ "\" role=\"tab\" data-toggle=\"tab\"><input type=\"text\" onchange=\"javascript:saveEventTagPage("+tmpIndex+");\" value=\"新页签标题\"></a>\n  <span class=\"icon-close\"></span>\n</li>").prev().find('a').tab('show').find('input').focus()[0];
		eventDespTabIdIndex++;
		if (newInput.setSelectionRange) {
			return newInput.setSelectionRange(5, 5);
		} else if (newInput.createTextRange) {
			range = newInput.createTextRange();
			range.collapse(true);
			range.moveEnd('character', 5);
			range.moveStart('character', 5);
			return range.select();
		}
	});

    $eventDesTab.on('click', '.icon-close', function() {
		if(!canedit) return;
		var delTag = this;
		onSaveEventTagPageSuccess = function(){
			var $prevTab, $tabLi, id,editor,editorID;
			id = $(delTag).prev().attr('href');
			editorID = id.slice(13);
			$tabLi = $(delTag).parent();
			$prevTab = $tabLi.prev().find('a');
			$tabLi.detach();
			$(id).detach();
			editor = descEditors[editorID]?descEditors[editorID]:eval("descEditor"+editorID);
			if(editor != null){editor.destroy();}
			$prevTab.tab('show');
		};
		saveEventTagPage($(this).prev().attr('href').slice(13),true);
    });

	function saveEventTagPage(tagPageIndex,isDel){
		if(!canedit) return;
		var pageData,tagEditor;
        if(isDel && !confirm("确认删除该页签吗？")) {
            return;
        }
		if(!isDel) {
			tagEditor = descEditors[tagPageIndex];
			if(tagEditor == null) tagEditor = eval("descEditor"+tagPageIndex);
			pageData = $.trim(tagEditor.getContent()); 
			if(pageData == null || pageData == "") {
				PopupMessage(1, "对不起，活动新页签内容不允许为空，请填写。", 2000);
				return;
			}
			$('#event_tagpage_form textarea').text($.trim(tagEditor.getContent().replace(/&lt;/g,'&amp;lt;').replace(/&gt;/g,'&amp;gt;')));
			$('#event_tagpage_form input[name="Title"]').val($('#event-create-description-add' + tagPageIndex + ' input').val());
			$('#event_tagpage_form input[name="Deleted"]').val('false');
		}
		$('#event_tagpage_form input[name="SN"]').val($('#EventTagPage' + tagPageIndex + ' input').val());
		if(isDel) {$('#event_tagpage_form input[name="Deleted"]').val('true');}

		try{ $("#event_tagpage_form").submit(); } catch(e) {}
		if(!isDel) tagEditor.setContent(pageData);  //ueditor
	}

	$(function () {
		$("#event_tagpage_form").validate({
		    submitHandler: function (form) {
		        jQuery(form).ajaxSubmit({
                    global:false,
		            success: function (data) {
						if(data != null && data.AjaxErrStatus != null && data.AjaxErrStatus == 1){
                            PopupMessage(1, "保存活动新页签出错，原因：\n" + data.AjaxErrMsg);
							return;
						}
		                if (data != null && data != "") {
							try{
								if(onSaveEventTagPageSuccess != null && typeof(onSaveEventTagPageSuccess) == 'function'){
									onSaveEventTagPageSuccess(data);
									if(data.Deleted) PopupMessage(0, "活动新页签已删除。",2000);
									//else PopupMessage(0, "活动新页签已保存。",2000);
								}
								else {
									if(data.Deleted){
										PopupMessage(0, "活动新页签已删除。",2000);
									}
									//else PopupMessage(0, "活动新页签已保存。",2000);
								}
							} catch(e){}
                        }
						else PopupMessage(1, "对不起，保存活动新页签出错，请稍后重试。");
		            },
		            error: function (XMLHttpRequest, textStatus, errorThrown) {
		                PopupMessage(1, "保存活动新页签出错：服务不存在或无响应",3000);
		            }
		        });
		    }
		});


		var isBaseFormSubmiting = false;
		var freshFlag = $("#edit_exist_event_flag").val();
	    $("#event_base_form").validate({
	        submitHandler: function (form) {
				if(isBaseFormSubmiting){ return; }
				isBaseFormSubmiting = true;
                jQuery(form).ajaxSubmit({
					global: true,
	                success: function (data) {
						if(data != null && data.AjaxErrStatus != null && data.AjaxErrStatus == 1){
                            $('#autoSaveTip').html("活动保存出错，原因：<b style='color:red'>" + data.AjaxErrMsg +"</b>");
							PopupMessage(0, data.AjaxErrMsg, 3000);
                            isBaseFormSubmiting = false;
                            onSuccessSaveEventBase = null;
							return;
						}
						if (data != null && data.Token != null && data.Token != "") $("#save_event_form_token").val(data.Token);
                        if (data != null && data != "" && data.Id != null && data.Id > 0 && data.Status != 5 ) {
	                        $("#event_base_form input[id='Id']").val(data.Id);
                            var saveTime = new Date().format("hh:mm");
							$('#autoSaveTip').html('活动信息已于<b style="color:green">' + saveTime + '</b>保存');
	                        try {
                                if (onSuccessSaveEventBase != null && typeof (onSuccessSaveEventBase) == 'function') {
									onSuccessSaveEventBase();
	                            }
                                else{
                                    PopupMessage(0, "活动信息保存成功！", 2000);
                                }
	                        } catch (e) { }
	                    }
						isBaseFormSubmiting = false;
						if(freshFlag != null && freshFlag == "true") { window.location = window.location; }
	                },
	                error: function (XMLHttpRequest, textStatus, errorThrown) {
						PopupMessage(1, "保存活动基本信息出错：服务不存在或无响应", 3000);
						isBaseFormSubmiting = false;
						if(freshFlag != null && freshFlag == "true") { window.location = window.location; }
	                }
	            });
	        }
	    });

		if(autoSaveFlag){
			descEditor.ready(function(editor) {
				descEditor.addListener('contentChange', function() { hasDescChanged = true; });
			});
			window.setInterval(autoSaveEventDescription, 300000); //5分钟自动保存一次
		}
		window.setTimeout("setupScriptDelay('api.map.baidu.com/api?v=2.0&ak=KIpwmISmRtIMMssrIQ4NF9ji&callback=loadMap', true)", 250);
	});

	function saveEventBase(){
        var eventTitle = $("#event_base_form input[name='Title']");
        if(eventTitle == null || eventTitle.val() == ""||eventTitle.val().length < 5){
			PopupMessage(1, "活动标题未填写或少于5个字，请调整。", 2000);
			return;
        }

		var eventMaxIns = $("#event_base_form input[name='MaxInstance']");
		if(eventMaxIns != null && eventMaxIns.length > 0 && eventTicketsQty != null && eventTicketsQty > 0){
			var maxinsnum = parseInt(eventMaxIns.val());
			if(maxinsnum > 0){
				if(eventTicketsQty > maxinsnum){
					PopupMessage(1, "人数上限(" + eventMaxIns.val() + ")不能超过各票种的名额之和(" + eventTicketsQty + ")，请调整。", 2000);
					return;
				}
				if(0 > maxinsnum){
					PopupMessage(1, "人数上限(" + eventMaxIns.val() + ")不能少于已报名的人数(" + 0 + ")，请调整。", 2000);
					return;
				}
			}
		}
		var varprov = $("#select_province").val();
		var varcity = $("#select_city").val();
		if(varprov == null || varprov == "-1" || varprov == "" || varcity == null || varcity == "-1" || varcity == ""){
			PopupMessage(1, "请选择活动地点。", 2000);
			return;
		}

        var address = $("#Address").val();
		if(address == null || address == ""){
			PopupMessage(1, "请输入活动详细地点。", 2000);
			return;
		}

        var tag = "";
        $('.event-create-add-label-list li').each(function(i){ tag += ","+ $.trim($(this).text()); });
        $("#event_base_form input[name='Tag'][type='hidden']").val(tag.substr(1));

        //$("#Setting_IsPrivate").val(!!$('#event-privacy').attr('checked'));
        
        $("#Setting_IsPrivate").val(!(!!$('#event-privacy').attr('checked')));

		$("#event_base_form input[id='Setting_Province'][type='hidden']").val($("#select_province option:selected").text());
		$("#event_base_form input[name='City'][type='hidden']").val($("#select_city option:selected").text());
		if ($("#event_start_time").val() == '') {
			PopupMessage(1, "请选择活动开始时间。", 2000);
			return; 
        }
		if ($("#event_end_time").val() == '') {
			PopupMessage(1, "请选择活动结束时间。", 2000);
			return; 
        }

        if ($("#event_base_form input[name='Location']").val() == '116.395645, 39.929986' ) {
			PopupMessage(1, "请在地图上标注活动地点。", 2000);
			return; 
        }

		var estime = $("#event_start_date").val() + " " + $("#event_start_time").val();
		var eetime = $("#event_end_date").val() + " " + $("#event_end_time").val();
		if (new Date(estime) > new Date(eetime)) {
			PopupMessage(1, "活动开始时间不能晚于结束时间。", 2000);
			return; 
		}

		var descData = "";
		var summaryTextArea = $("#event_base_form textarea[id='Setting_Summary']");
		var mSummary = summaryTextArea.val();
		if(mSummary == null || $.trim(mSummary) == "") mSummary = $.trim(summaryTextArea.text());
        if (descEditor != null && typeof(descEditor) != "undefined") {
            try {
				descData = $.trim(descEditor.getContent());  //ueditor
				if((mSummary == null || $.trim(mSummary) == "") && descData != null && descData != ""){
					mSummary = $.trim(descEditor.getContentTxt()); //ueditor
					if(mSummary.length >= 150) mSummary = mSummary.substr(0, 146) + "...";
					summaryTextArea.text(mSummary);
					summaryTextArea.val(mSummary);
				}
            } catch (e) {}
        }
		
		if((mSummary == null || mSummary == "") && false){
			PopupMessage(1, "活动摘要不允许为空，请填写。", 2000);
			return;
		}

		if(descData == null || descData == "") {
			PopupMessage(1, "活动内容不允许为空，请填写。", 2000);
			return;
		}

	    var hdxTags = $("#event-select-hdxtag").val();
        if (hdxTags == null || $.trim(hdxTags) == "") {
            PopupMessage(1, "请在活动分类中选择活动类别",2000);
            return;
        }

	    var mode = $("#event-select-mode").val();
        if (mode == null || $.trim(mode) == "") {
            PopupMessage(1, "请在活动分类中选择活动形式",2000);
            return;
        }

		$("#event_base_form input[name='Start']").val(estime);
		$("#event_base_form input[name='End']").val(eetime);
		descEditor.setContent(descData.replace(/&lt;/g,'&amp;lt;').replace(/&gt;/g,'&amp;gt;'));  //ueditor

		$("#event_base_form").submit();
		descEditor.setContent(descData);  //ueditor
	}

    function autoSaveEventDescription() {
        if (!hasDescChanged || !autoSaveFlag) return;
		var descData = $.trim(descEditor.getContent()).replace(/&lt;/g,'&amp;lt;').replace(/&gt;/g,'&amp;gt;');  //ueditor
		$('#autoSaveTip').html('');

        $.ajax({
			global: false,
            type: 'POST',
            url: "/myevent/SaveEventDescription",
            data: { "id": 9349262607200, "description": descData },
            success: function(data) {
                if(data != null && data.AjaxErrStatus != null && data.AjaxErrStatus == 1){
                    $('#autoSaveTip').html('<font style="color:red;">活动详细内容自动保存失败</font>');
                    return;
                }
                if (data != null && data == true) {
                    hasDescChanged = false;
                } else {
                    $('#autoSaveTip').html('<font style="color:red;">活动详细内容自动保存失败</font>');
                }
            },
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				$('#autoSaveTip').html('<font style="color:red;">活动详细内容自动保存出错</font>');
			}
        });
    }

	$(function() {
	    var eventHdxTag = '';
	    var eventMode = '';
	    //选中活动类别和活动形式
	    $("#event-select-hdxtag").val(eventHdxTag);
	    $("#event-select-mode").val(eventMode);
	});
</script>

<script type="text/javascript">
    var eventPoint;
    $(function(){
       $("#select_province").change(function(){
          $("#event_base_form input[name='Address']").val("");
       });
       $("#event_base_form input[name='Address']").keyup($.debounce(250, function(){ loadMap(true); }));
    });

	function resetMapContainerOffset(){
		var titleEle = $("#event_base_form input[id='Title']");
		if(titleEle.is(":visible")){
			var mapContainer = $("#baidumapContainer");
		    var markerOffset = titleEle.offset();
			mapContainer.offset({left: markerOffset.left + 365, top: markerOffset.top });
            mapContainer.show();
		}
	}

    function locAddress(force) {
		//resetMapContainerOffset();
		initBaiduMap(force);

        var point;
        var position = $.trim($("#event_base_form input[name='Location']").val());
        if (position != '') {
            var lng = position.substring(0, position.indexOf(','));
            var lat = position.substring(position.indexOf(',') + 1);
            point = new BMap.Point(lng, lat);
		    eventPoint = point;

            var myIcon = new BMap.Icon("http://cdn.huodongxing.com/Content/img/mark1.png", new BMap.Size(32, 32), {"anchor": new BMap.Size(16, 32)});
            var baiduMapMarker = new BMap.Marker(point, {icon: myIcon});
            baiduMapMarker.enableDragging();
        
            baiduMapMarker.addEventListener("dragend", function (e) {
                eventPoint = e.point;
                document.getElementById('Location').value = e.point.lng + ", " + e.point.lat;
            });
            baiduMapMarker.addEventListener("onmouseover", function (e) {
               baiduMapMarker.setIcon(new BMap.Icon("http://cdn.huodongxing.com/Content/img/mark2.png", new BMap.Size(32, 32), { "anchor": new BMap.Size(16, 32)}));
            });
            baiduMapMarker.addEventListener("onmouseout", function (e) {
               baiduMapMarker.setIcon(new BMap.Icon("http://cdn.huodongxing.com/Content/img/mark1.png", new BMap.Size(32, 32), { "anchor": new BMap.Size(16, 32)}));
            });
            window.map.addOverlay(baiduMapMarker);
            window.map.centerAndZoom(point, 20);

			$("#marker_map_error").hide();

			if(force) window.setTimeout(function(){ locAddress(false); }, 500);
        } else {
            loadMap(force);
        }
        $("div.anchorBL").hide(); //隐藏百度地图logo和copyright信息
    }

	function initBaiduMap(force){
		if(force) { $("#baidumapContainer").show(); }
		if (window.map == undefined) {
            var map = new BMap.Map("baidumapContainer");
            map.enableScrollWheelZoom();
            map.addControl(new BMap.OverviewMapControl());
            map.addControl(new BMap.NavigationControl());
            window.map = map;

            $("div.anchorBL").hide();//隐藏百度地图logo和copyright信息
        }
		window.map.clearOverlays();
	}

	function loadMap(force){
		changeAndLoadMap(force, false);
	}

    function changeAndLoadMap(force, change) {
		initBaiduMap(force);
        try{
            //清除上地图所有覆盖物
		    var address = $.trim($("#event_base_form input[name='Address']").val());
            var prov = $("#select_province").val() != "-1" ? $.trim($("#select_province option:selected").text()) : "";
            var city = $("#select_city").val() != "-1" ? $.trim($("#select_city option:selected").text()) : "";
            
            if(city.indexOf("-") > -1) city = city.replace("-", "");
            if (city == null || city == "" || city == '其他') city = '北京市';
			if(prov == "北京" || prov == "天津" || prov == "上海" || prov == "重庆"){
				prov += "市";
				city += "区";
			}
	        else if(city.indexOf("市") != (city.length - 1) && city.indexOf("区") != (city.length - 1)) city = city + "市";

	        if (address == null || address == ""){ address = city; }
    	    else address = city + address;
            if (prov != null &&  prov != "") address = prov + address;

            // 创建地址解析器实例  
            var myGeo = new BMap.Geocoder();
            // 将地址解析结果显示在地图上，并调整地图视野
            myGeo.getPoint(address,
                function (point) {
                    if (point != null) {
						eventPoint = point;

					    var myIcon = new BMap.Icon("http://cdn.huodongxing.com/Content/img/mark1.png", new BMap.Size(32, 32), {"anchor": new BMap.Size(16, 32)});
						var baiduMapMarker = new BMap.Marker(point, {icon: myIcon});
						baiduMapMarker.enableDragging();

                        baiduMapMarker.addEventListener("dragend", function (e) {
							eventPoint = e.point;
						    $("#event_base_form input[name='Location']").val(e.point.lng + ", " + e.point.lat);
                            //window.map.centerAndZoom(e.point, 16);
                        });
                        baiduMapMarker.addEventListener("onmouseover", function (e) {
                            baiduMapMarker.setIcon(new BMap.Icon("http://cdn.huodongxing.com/Content/img/mark2.png", new BMap.Size(32, 32), {"anchor": new BMap.Size(16, 32)}));
                        });
                        baiduMapMarker.addEventListener("onmouseout", function (e) {
                            baiduMapMarker.setIcon(new BMap.Icon("http://cdn.huodongxing.com/Content/img/mark1.png", new BMap.Size(32, 32), {"anchor": new BMap.Size(16, 32)}));
                        });

						window.map.addOverlay(baiduMapMarker);
                        window.map.centerAndZoom(point, 20);

						if(change) {
							$("#event_base_form input[name='Location']").val(point.lng + ", " + point.lat);
						}
					    $("#marker_map_error").hide();
                    }
                    else {
					    if(force){
						    $("#marker_map_error").html('无法定位，请检查地址。');
						    $("#marker_map_error").show();
						    $("#marker_map_error").fadeOut(200).fadeIn(200).show();
                            $("#event_base_form input[name='Address']").select();
					    }
                    }
                },
            city);
        } catch(Err){}
        return false;
    }
</script>


    


<div class="event-create-body event-create-add-item">
        <div class="event-create-label event-create-label-long">
            设置报名表单
        </div>
        <div class="text-muted"><span class="icon-add-primary"></span>如果您需要收集报名者的必要信息，可<strong class="text-info">添加</strong>此项设置</div>
    </div>
<div class="event-create-body hide">
	<div class="event-create-label event-create-label-long">
        设置报名表单
    </div>
		
	<div id="edit_template_items" class="event-create-sign-form" style="min-height:518px;">
<form action="/myevent/SaveEventForm" id="event_template_form" method="post" style="margin-bottom:5px;">			<fieldset>
				<input type="hidden" name="activityId" value="9349262607200" />
				<input type="hidden" name="version" value="1" />
				<input type="hidden" id="template_form_sort_max" name="sortmax" value="0" />
				<h3>联系方式<strong>（报名用户注册资料，必填）</strong></h3>
				<div id="event_template_form_contact" class="event-create-sign-required">
	                <div class="form-group">
	                    <label><input type="checkbox" checked="checked" disabled="disabled">必填</label><span>姓名</span><input type="text" class="form-control" placeholder="报名用户的姓名或昵称"  disabled="disabled">
	                </div>
	                <div class="form-group">
	                    <label><input type="checkbox" checked="checked" disabled="disabled">必填</label><span>手机号码</span><input type="text" class="form-control" placeholder="报名用户的手机号码"  disabled="disabled">
	                </div>
	                <div class="form-group">
	                    <label><input type="checkbox" checked="checked" disabled="disabled">必填</label><span>电子邮箱</span><input type="text" class="form-control" placeholder="报名用户的电子邮箱"  disabled="disabled">
	                </div>
	            </div>
				<h3>其他</h3>
				<div id="event_template_form_items"></div>
				<div style="clear:both;"></div>
				<div class="form-actions" style="padding-left:20px;margin-top:20px;">
							<button href="#" class="btn btn-primary" onclick="javascript:saveEventForm(null);;return false;" style="margin-right:15px;">
								<i class="icon-hdd icon-white"></i>保&nbsp;存
							</button>						
					<button href="#" class="btn" onclick="javascript:reviewEventFormView();;return false;">
						<i class="icon-play"></i>预&nbsp;览
					</button>
				</div>
			</fieldset>
</form>	</div>
		
	<div class="aside" id="edit_template_tools" style="max-width:205px;">
				<h3>常用栏位</h3>
                <div class="event-create-sign-form-usual clearfix">
	 <ul>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(0);;return false;"><span class="icon-btn-company"></span><span>公司</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(1);;return false;"><span class="icon-btn-department"></span><span>部门</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(2);;return false;"><span class="icon-btn-office"></span><span>职位</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(3);;return false;"><span class="icon-btn-insterest"></span><span>兴趣爱好</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(4);;return false;"><span class="icon-btn-blood"></span><span>血型</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(5);;return false;"><span class="icon-btn-marry"></span><span>婚姻状况</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(6);;return false;"><span class="icon-btn-sex"></span><span>性别</span></button></li>
              <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(7);;return false;"><span class="icon-btn-age"></span><span>年龄</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(8);;return false;"><span class="icon-btn-educational"></span><span>学历</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(9);;return false;"><span class="icon-btn-address"></span><span>住址</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(10);;return false;"><span class="icon-btn-income"></span><span>月收入</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(11);;return false;"><span class="icon-btn-other"></span><span>其他</span></button></li>
            <li><button type="button" class="btn" onclick="javascript:addEventFormCommonItem(12);;return false;"><span class="icon-btn-attachment"></span><span>附件</span></button></li>
            </ul>
                </div>

                <div class="event-create-sign-form-custom">
                <h3>自定义栏位</h3>
                    <button type="button" class="btn" onclick="javascript:addEventFormEmptyItem(0);;return false;"><span class="icon-btn-single-line "></span><span>单行文本框</span><span class="icon-btn-add"></span></button>
                    <button type="button" class="btn" onclick="javascript:addEventFormEmptyItem(1);;return false;"><span class="icon-btn-number-input "></span><span>数字输入框</span><span class="icon-btn-add"></span></button>
                    <button type="button" class="btn" onclick="javascript:addEventFormEmptyItem(2);;return false;"><span class="icon-btn-calendar "></span><span>日期选择框</span><span class="icon-btn-add"></span></button>
                    <button type="button" class="btn" onclick="javascript:addEventFormEmptyItem(3);;return false;"><span class="icon-btn-mouse "></span><span>邮箱输入框</span><span class="icon-btn-add"></span></button>
                    <button type="button" class="btn" onclick="javascript:addEventFormEmptyItem(4);;return false;"><span class="icon-btn-multi-line "></span><span>多行文本框</span><span class="icon-btn-add"></span></button>
                    <button type="button" class="btn" onclick="javascript:addEventFormEmptyItem(5);;return false;"><span class="icon-btn-option "></span><span>单选按钮框</span><span class="icon-btn-add"></span></button>
                    <button type="button" class="btn" onclick="javascript:addEventFormEmptyItem(6);;return false;"><span class="icon-btn-check "></span><span>多选按钮框</span><span class="icon-btn-add"></span></button>
                    <button type="button" class="btn" onclick="javascript:addEventFormEmptyItem(7);;return false;"><span class="icon-btn-select "></span><span>下拉选择框</span><span class="icon-btn-add"></span></button>
                </div>
	</div>
	<div class="clear text-center">
            <button class="btn" id="event-create-item-toggle"><span class="icon-top-arrow"></span>收起表单</button>
        </div>
</div>
<div id="dlg-review-event-form" class="modal">
	<div class="modal-dialog" style="width:800px">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal">×</button>
				<h3 class="modal-title">预览活动表单</h3>
			</div>
			<div class="modal-body" style="max-height:430px;min-height:420px;margin-bottom:5px;overflow-x:hidden">
				<form>
					<div class="page-header" style="margin:0px 10px;">
						<span class="label label-warning header_label">联系方式</span>
						<div class="page-header-line"></div>
					</div>
					<div style="padding-left:30px;">
						<div class="control-group" style="margin:5px 0px;">
							<label class="control-label" style="font-weight:bold;">姓名</label>
							<div class="controls" style="color:gray;">
								<input type="text" class="required disabled input-xlarge" disabled="disabled" value="登录用户的姓名或昵称" />
							</div>
						</div>
						<div class="control-group" style="margin:5px 0px;">
							<label class="control-label" style="font-weight:bold;">手机号码</label>
							<div class="controls" style="color:gray;">
								<input type="text" class="required disabled input-xlarge" disabled="disabled" value="登录用户的手机号码" />
							</div>
						</div>
						<div class="control-group" style="margin:5px 0px;">
							<label class="control-label" style="font-weight:bold;">电子邮箱</label>
							<div class="controls" style="color:gray;">
								<input type="text" class="required disabled input-xlarge" disabled="disabled" value="登录用户的电子邮箱" />
							</div>
						</div>
					</div>
					<div class="page-header" style="margin:0px 10px;">
						<span class="label label-warning header_label">其他</span>
						<div class="page-header-line"></div>
					</div>
					<fieldset id="event_template_form_fields" style="padding-left:30px;"></fieldset>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-create-default" data-dismiss="modal"><i class="icon-off"></i>关闭</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var formCommonItems = [
            {
              "Key":"I_-1",
              "Sort":-1,
              "Type":"input",
              "Category":"FIELD_COMPANY",
              "IsDefault":false,
              "Required":false,
              "Multiple":false,
              "Title":"公司",
              "Subitems":[],
              "Description":null,
              "IsHide":false,
              "Value":null,
              "TypeTitle":"单行文本框"
          },
          {
              "Key":"I_-1",
              "Sort":-1,
              "Type":"input",
              "Category":"FIELD_DEPARTMENT",
              "IsDefault":false,
              "Required":false,
              "Multiple":false,
              "Title":"部门",
              "Subitems":[],
              "Description":null,
              "IsHide":false,
              "Value":null,
              "TypeTitle":"单行文本框"
          },{"Key":"I_-1","Sort":-1,"Type":"input","Category":"FIELD_OFFICE","IsDefault":false,"Required":false,"Multiple":false,"Title":"职位","Subitems":[],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"单行文本框"},{"Key":"I_0","Sort":0,"Type":"checkbox","Category":"FIELD_HOBBY","IsDefault":false,"Required":false,"Multiple":false,"Title":"兴趣爱好","Subitems":["文艺","音乐","运动","数码","购物","读书","旅游","时尚","其他"],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"多选按钮框"},{"Key":"I_0","Sort":0,"Type":"radio","Category":"FIELD_BLOOD","IsDefault":false,"Required":false,"Multiple":false,"Title":"血型","Subitems":["A型","B型","O型","AB型"],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"单选按钮框"},{"Key":"I_0","Sort":0,"Type":"radio","Category":"FIELD_MARRIAGE","IsDefault":false,"Required":false,"Multiple":false,"Title":"婚姻状况","Subitems":["未婚","已婚","保密"],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"单选按钮框"},{"Key":"I_-1","Sort":-1,"Type":"radio","Category":"FIELD_GENDER","IsDefault":false,"Required":false,"Multiple":false,"Title":"性别","Subitems":["男","女"],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"单选按钮框"},{"Key":"I_0","Sort":0,"Type":"radio","Category":"FIELD_AGE_RANGE","IsDefault":false,"Required":false,"Multiple":false,"Title":"年龄","Subitems":["15以下","16~20岁","21~25岁","26~30岁","31~40岁","40岁以上"],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"单选按钮框"},{"Key":"I_0","Sort":0,"Type":"radio","Category":"FIELD_EDUCATION","IsDefault":false,"Required":false,"Multiple":false,"Title":"学历","Subitems":["小学","中学","大专","本科","研究生以上"],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"单选按钮框"},{"Key":"I_0","Sort":0,"Type":"select","Category":"FIELD_RESIDENCE","IsDefault":false,"Required":false,"Multiple":false,"Title":"住址","Subitems":["北京","上海","广东","江苏","其他"],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"下拉选择框"},{"Key":"I_0","Sort":0,"Type":"radio","Category":"FIELD_WAGE","IsDefault":false,"Required":false,"Multiple":false,"Title":"月收入","Subitems":["少于3000","3000~5000","5000~10000","10000~20000","20000以上"],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"单选按钮框"},{"Key":"I_-1","Sort":-1,"Type":"textarea","Category":"FIELD_DESCRIPTION","IsDefault":false,"Required":false,"Multiple":false,"Title":"其他","Subitems":[],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"多行文本框"},{"Key":"I_0","Sort":0,"Type":"file","Category":"FIELD_ATTACHMENT","IsDefault":false,"Required":false,"Multiple":false,"Title":"附件","Subitems":["图片","word文档","ppt文档","pdf文档"],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"附件"}];
	var formEmptyItems = [{
                "Key":"I_0",
                "Sort":0,
                "Type":"input",
                "Category":"CUSTOM",
                "IsDefault":false,
                "Required":false,
                "Multiple":false,"Title":"",
                "Subitems":[],
                "Description":null,
                "IsHide":false,
                "Value":null,
                "TypeTitle":"单行文本框"
            },{"Key":"I_0","Sort":0,"Type":"number","Category":"CUSTOM","IsDefault":false,"Required":false,"Multiple":false,"Title":"","Subitems":[],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"数字输入框"},{"Key":"I_0","Sort":0,"Type":"date","Category":"CUSTOM","IsDefault":false,"Required":false,"Multiple":false,"Title":"","Subitems":[],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"日期选择框"},{"Key":"I_0","Sort":0,"Type":"email","Category":"CUSTOM","IsDefault":false,"Required":false,"Multiple":false,"Title":"","Subitems":[],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"邮箱输入框"},{"Key":"I_0","Sort":0,"Type":"textarea","Category":"CUSTOM","IsDefault":false,"Required":false,"Multiple":false,"Title":"","Subitems":[],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"多行文本框"},{"Key":"I_0","Sort":0,"Type":"radio","Category":"CUSTOM","IsDefault":false,"Required":false,"Multiple":false,"Title":"","Subitems":[],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"单选按钮框"},{"Key":"I_0","Sort":0,"Type":"checkbox","Category":"CUSTOM","IsDefault":false,"Required":false,"Multiple":false,"Title":"","Subitems":[],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"多选按钮框"},{"Key":"I_0","Sort":0,"Type":"select","Category":"CUSTOM","IsDefault":false,"Required":false,"Multiple":false,"Title":"","Subitems":[],"Description":null,"IsHide":false,"Value":null,"TypeTitle":"下拉选择框"}];
	var formItemsJson = new Array();
	var formEditableVar = true;
	var $formItemTemp = $("#event_template_form_items");
	var formItemOrder = [],formItemsJsonTemp = []
	
	function renderEventFormItemValues(i, tmpItem){
                           alert(i);
		itemsHtml = ''
		if(tmpItem.Subitems != null && tmpItem.Subitems.length > 0){
			for(var j = 0; j < tmpItem.Subitems.length; j++){
				itemsHtml += '<div><input type="text" class="form-control required" name="items[' + i + '].Subitems[' + j + ']" value="' + (tmpItem.Subitems[j] == null ? "" : tmpItem.Subitems[j].replace("\"","\\\"").replace("\n"," ")) + '" onchange = "javascript:onChangeFormItemValue(3, this, ' + i + ', ' + j + ');"/>';
				itemsHtml += '<span name="event_form_item_ctrl" class="icon-close" onclick="javascript:removeEventFormItemValue(' + i + ',' + j + ');"></span></div>';
			}
		}
		itemsHtml += '<button class="btn create-event-label" onclick="javascript:addEventFormItemValue(' + i + ');return false;"><span name="event_form_item_ctrl" class="icon-event-label-add"></span></button>'
		return itemsHtml;
	}
	function renderEventFormTemplate(){
		var itemsHtml = "";
		if(formItemsJson != null && formItemsJson.length > 0){
			for(i=0;i<formItemsJson.length;i++){
				var tmpItem = formItemsJson[i];
                var title= tmpItem.Title == "" ? tmpItem.TypeTitle : tmpItem.Title
				itemsHtml += '<div class="form-group" id="efi_' + i + '">';
				itemsHtml += '<input type="hidden" name="items[' + i + '].Type" value="' + tmpItem.Type + '" />';
				itemsHtml += '<input type="hidden" name="items[' + i + '].Sort" value="' + tmpItem.Sort + '" />';
				itemsHtml += '<input type="hidden" name="items[' + i + '].Category" value="' + tmpItem.Category + '" />';
				itemsHtml += '<input type="hidden" name="items[' + i + '].Multiple" value="' + tmpItem.Multiple + '" />';
				itemsHtml += '<input type="hidden" name="items[' + i + '].IsHide" value="' + tmpItem.IsHide + '" />';
				itemsHtml += '<label><input type="checkbox" name="items[' + i + '].Required" value="true" ' + (tmpItem.Required ? 'checked="checked"' : '') + ' onchange="javascript:onChangeFormItemValue(0, this, ' + i + ', 0);"/>必填</label>';
				itemsHtml += '<input type="text" class="form-control required" title="'+title+'" placeholder="'+title+'" name="items[' + i + '].Title" value="' + (tmpItem.Title == null ? "" : tmpItem.Title.replace("\"","\\\"").replace("\n"," ")) + '" onchange="javascript:onChangeFormItemValue(1, this, ' + i + ', 0);"/>';
				
				itemsHtml += '<input type="text" name="items[' + i + '].Description" class="form-control" value="' + (tmpItem.Description == null ? "" : tmpItem.Description.replace("\"","\\\"").replace("\n"," ")) + '" onchange="javascript:onChangeFormItemValue(2, this, ' + i + ', 0);" placeholder="提示信息写在这里！"/>';
				itemsHtml += '<span name="event_form_item_ctrl" class="icon-trash" title="删除栏位" onclick="javascript:removeEventFormItem(' + i + ');return false;"></span>';
				
				if(tmpItem.Type == "radio" || tmpItem.Type == "checkbox" || tmpItem.Type == "select"){
					itemsHtml += '<div>选项列表<div class="event-create-sign-select" id="efis_' + i + '">';
					itemsHtml += renderEventFormItemValues(i, tmpItem);
					itemsHtml += '</div></div><div style="clear:both;"></div>';
				}
				
				itemsHtml += '</div>';
			}
		}
		
		$("#event_template_form_items").empty(); 
		$("#event_template_form_items").append(itemsHtml);
		if(itemsHtml == ""){
			$("#event_template_form_items").before('<p style="font-size:14px;padding:5px 15px;color:gray;">未添加其他栏位（即不需要报名/购票人提供额外信息）。</p>')
		}
		if(!formEditableVar){
			var formItemctrls = $("a[name='event_form_item_ctrl']");
			if(formItemctrls != null){
				formItemctrls.attr("onclick", function(){ return false; });
				formItemctrls.addClass("disabled");
			}
			var formItemInputs = $("#event_template_form_items input");
			if(formItemInputs != null) {
				formItemInputs.addClass("disabled");
				formItemInputs.attr("disabled", true);
			}
		}
	}

	function onChangeFormItemValue(type, itemObj, index, subIndex){
		if(formItemsJson != null && formItemsJson.length > index && index >= 0){
			var eleItem = $(itemObj);
			if(type == 0) formItemsJson[index].Required = eleItem.prop("checked");
			else if(type == 1) formItemsJson[index].Title = eleItem.val();
			else if(type == 2) formItemsJson[index].Description = eleItem.val();
			else if(type == 3) {
				if(formItemsJson[index].Subitems != null && formItemsJson[index].Subitems.length > subIndex && subIndex >= 0){
					formItemsJson[index].Subitems[subIndex] = eleItem.val();
				}
			}
		}
	}

	// function sortDownFormItem(index){
	// 	if(formItemsJson != null && (formItemsJson.length - 1) > index && index >= 0){
	// 		var item1 = formItemsJson[index];
	// 		var item2 = formItemsJson[index + 1];
	// 		formItemsJson.splice(index, 2, item2, item1);
	// 		renderEventFormTemplate();
	// 	}
	// }
	// function sortUpFormItem(index){
	// 	if(formItemsJson != null && formItemsJson.length > index && index > 0){
	// 		var item1 = formItemsJson[index - 1];
	// 		var item2 = formItemsJson[index];
	// 		formItemsJson.splice(index - 1, 2, item2, item1);
	// 		renderEventFormTemplate();
	// 	}
	// }
	
	function removeEventFormItem(index){

		if(formItemsJson != null && formItemsJson.length > index && index >= 0){
			formItemsJson.splice(index,1);
			renderEventFormTemplate();
		}
		$(this).parent().tooltip('destroy')
		formItemsJsonTemp = formItemsJson.slice()
		$formItemTemp.sortable('refresh')

	}
	function removeEventFormItemValue(index, subIndex){
		if(formItemsJson != null && formItemsJson.length > index && index >= 0 && subIndex >= 0){
			var tmpItem = formItemsJson[index];
			if(tmpItem.Subitems != null && tmpItem.Subitems.length > subIndex){
				formItemsJson[index].Subitems.splice(subIndex,1);
				var efis = $('#efis_' + index);
				if(efis != null){
					efis.empty(); 
					efis.append(renderEventFormItemValues(index, formItemsJson[index]));
				}
			}
		}
	}
	function addEventFormItemValue(index){
		if(formItemsJson != null && formItemsJson.length > index && index >= 0){
			if(formItemsJson[index].Subitems == null) formItemsJson[index].Subitems = new Array();
			formItemsJson[index].Subitems.push("");
			var efis = $('#efis_' + index);
			if(efis != null){
				efis.empty(); 
				efis.append(renderEventFormItemValues(index, formItemsJson[index]));
			}
		}
	}
//  *addEventFormEmptyItem(1)
	function addEventFormEmptyItem(index){
                //
                 /**
                  *formEmptyItems定义的json数组
                  *index 是触发的索引值 
                  */
		if(formEmptyItems != null && formEmptyItems.length > index && index >= 0){
			var emptyItem = formEmptyItems[index];
			if(emptyItem != null){
                                //添加到定义好的formItemsJson的数组中
				formItemsJson.push(createTemplateFormItem(emptyItem));
				renderEventFormTemplate();
			}
			formItemsJsonTemp = formItemsJson.slice()
			$formItemTemp.sortable('refresh')
		}
	}
	function addEventFormCommonItem(index){
            alert(index);
            //index  为 1-13
		if(formCommonItems != null && formCommonItems.length > index && index >= 0){
			var commonItem = formCommonItems[index];
			if(commonItem != null){
				if(commonItem.Type == 'file'){
					if(formItemsJson != null && formItemsJson.length > 0){
						for(var i = 0;i< formItemsJson.length;i++) {
							if(formItemsJson[i].Type == 'file') {
								PopupMessage(1, "您已添加一个【附件】栏位，附件栏位只能添加一个。", 2000);
								return;
							}
						}
					}
				}
				formItemsJson.push(createTemplateFormItem(commonItem));
				renderEventFormTemplate();
			}
		}
		formItemsJsonTemp = formItemsJson.slice()
		$formItemTemp.sortable('refresh')
	}
        
        //创建模板form
	function createTemplateFormItem(item){
		if(item == null) return null;
		var sortTmp = parseInt($("#template_form_sort_max").val());
		sortTmp++;
		var result = {
			Id : "I_" + sortTmp,
			Sort : sortTmp,
			Type : item.Type,
			Category : "CUSTOM",
			IsDefault : item.IsDefault,
			Required : false,
			Multiple : item.Multiple,
			Title : item.Title,
			Description : item.Description,
			IsHide : item.IsHide,
			TypeTitle : item.TypeTitle,
			Subitems : new Array()
		};
		if(item.Subitems != null && item.Subitems.length > 0){
			for(var i = 0; i<item.Subitems.length; i++) result.Subitems.push(item.Subitems[i]);
		}
		$("#template_form_sort_max").val(sortTmp);
		return result;
	}

//提交保存表单
	var saveEventFormSuccess = null;
	function saveEventForm(func){
		saveEventFormSuccess = func;
		var aele = $("#event_template_form input[name='activityId']");
		if(aele != null && (aele.val() == null || aele.val() == "" || parseInt(aele.val()) < 1) && $("#activity_id"))
			aele.val($("#activity_id").val());
		$('#event_template_form').submit();
	}

	function validateEventTemplateForm(){
		$("#event_template_form").validate({
			submitHandler: function(form) {
				jQuery(form).ajaxSubmit({
					success: function (data) {
						if(data != null && data.AjaxErrStatus != null && data.AjaxErrStatus == 1){
							PopupMessage(1, "保存活动报名表单出错，原因：<br/>"+ data.AjaxErrMsg, 2000);
							return;
						}
						if (data != null && data == true) {
							try{
								if(saveEventFormSuccess != null && typeof(saveEventFormSuccess) == 'function'){
									saveEventFormSuccess();
								}
								else {
									PopupMessage(0, "您好，活动报名表单模板已保存。", 1500);
								}
							} catch(e){}
                        }
						else PopupMessage(1, "对不起，保存活动报名表单出错，请稍后重试。", 2000);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
						PopupMessage(1, "保存活动报名表单出错：服务不存在或无响应", 2000);
                    }
				});
			}
		});
	}

	function reviewEventFormView(){
		var htmlTmp = resolveEventFormView(formItemsJson, 0, false);
		if(htmlTmp == null || htmlTmp == "") htmlTmp = '<p style="font-size:14px;padding:0px 30px;color:gray;">未添加其他栏位（即不需要报名/购票人提供额外信息）。</p>';
		$("#event_template_form_fields").empty(); 
		$("#event_template_form_fields").append(htmlTmp);
		$('#dlg-review-event-form').modal({show:true,backdrop:'static'});
	}
	
	var editTemplateTools = $("#edit_template_tools");
	var toolLeft = editTemplateTools.offset().left;
	var editTemplateItems = $("#edit_template_items");
	function onFormToolScroll(){
		var win = $(window);
		if(win.scrollTop() >= editTemplateTools.offset().top){
			editTemplateTools.addClass('tempform_tool-fixed');
			editTemplateTools.offset({left: toolLeft});
			var oftop =  editTemplateItems.offset().top + editTemplateItems.height() - win.scrollTop() - editTemplateTools.height() + 21;
			if(oftop < 0){
				editTemplateTools.css("top", oftop + "px");
			}
			else{
				editTemplateTools.css("top", "0px");
			}
		}
		if(win.scrollTop() <= 350){
			editTemplateTools.removeClass('tempform_tool-fixed');
			toolLeft = editTemplateTools.offset().left;
		}
	}
	
	function sortFormItem(){
		formItemOrder = []
		$formItemTemp.find('.form-group').each(function(){
			formItemOrder.push(this.id.slice(4))
		});
        
		formItemsJsonTemp = formItemsJson.slice()
		formItemsJson = formItemOrder.map(function(v){
			return v = formItemsJsonTemp[v]
		});
        renderEventFormTemplate();
        $formItemTemp.sortable('refresh');
	}
		

	$(function () {
		renderEventFormTemplate();
		validateEventTemplateForm();
		$.browser.msie && (parseInt($.browser.version) < 8) ?
			$formItemTemp.sortable({
				placeholder:'sortable-placeholder',
				opacity:.5
			}) :			 		
			$formItemTemp.sortable({forcePlaceholderSize: true})
			
		$formItemTemp.on('sortupdate', sortFormItem);
	});
</script>

    <div class="event-create-body">
    <div class="event-create-label event-create-label-long pull-left">
        设置活动票种
    </div>
    <span class="icon-event-create-alert" title=""></span>
    <div class="sr-only">
        <h4>什么是活动票种？</h4>
        <ul>
			<li>1. 主要用于不同价格的报名费或门票或换购提货券，例如可以是套票、优惠票、团体票、限时票等。</li>
			<li>2. 如果没有添加票种则活动仅提供免费报名。</li>
			<li>3. 您可以给活动添加多个票种，购票人将可根据需要来选购。</li>
        </ul>
    </div>
    <span class="pull-right" style="padding: 15px 10px 0px;color:gray;" id="event_ticket_alert_msg">目前还没有添加任何票种，请至少添加一个。</span>
	
	<div class="event-create-form clear">
        <div class="form-group">
			<label class="control-label">免费票种</label>
            <table class="event-create-ticket event_ticket_thumbs_header" id="event_free_ticket_thumbs_header" style="display:none;">
                <thead>
					<tr>
						<th><div>票种名称</div></th>
						<th><div>限额<span class="icon-event-ticket-alert" title="" data-original-title="设置为0表示不限数量（不会超过活动总限额）"></span></div></th>
						<th><div>价格（元）</div></th>
						<th><div>状态</div></th>
						<th><div class="event-create-td-last">操作</div></th>
					</tr>
                </thead>
            </table>
			<div id="event_free_ticket_thumbs"></div>
            <button class="btn btn-create-add btn-create-add-primary" id="add-free-ticket"  onclick="javascript:checkRefoundSettingAndAddTicket(true);return false;">
                <span class="icon-ticket-add-primary"></span>免费票种
            </button>
        </div>
		<div class="form-group">
			<label class="control-label">收费票种</label>
			<table class="event-create-ticket event_ticket_thumbs_header" id="event_charge_ticket_thumbs_header" style="display:none;">
                <thead>
					<tr>
						<th><div>票种名称</div></th>
						<th><div>限额<span class="icon-event-ticket-alert" title="" data-original-title="设置为0表示不限数量（不会超过活动总限额）"></span></div></th>
						<th><div>价格（元）</div></th>
						<th><div>状态</div></th>
						<th><div class="event-create-td-last">操作</div></th>
					</tr>
                </thead>
            </table>			
			<div id="event_charge_ticket_thumbs"></div>
            <button class="btn btn-create-add btn-create-add-warning" id="add-charge-ticket"  onclick="javascript:checkRefoundSettingAndAddTicket(false);return false;">
                <span class="icon-ticket-add-warning"></span>收费票种
            </button><span class="text-primary" id="event_ticket_fee_prompt" title="票款提取及费用说明">收费票种的票款如何提取？</span>
			<div class="sr-only">
                <p>
                    在您的收费活动结束后，您可以在活动管理界面申请提取票款。
                    <br><br>
                    <b>「活动行」标准资费说明：</b><br>
                    <img src="http://cdn.huodongxing.com/Content/img/fee-1.gif" />
                    <img src="http://cdn.huodongxing.com/Content/img/fee-2.png" />
                    <img src="http://cdn.huodongxing.com/Content/img/fee-3.png" />
                    <br><br>

                    <b>我们对NGO与NPO的支持方案：</b><br>
                    如果您也相信 “这个世界会更好”，并积极投身“行动即改变”的行列，活动行愿与您携手，一起通过办活动、做出改变！只要您代表NGO与NPO组织举办非营利活动，我们为您提供特殊优惠：<br />
1、免费活动，全部免费！<br />
2、付费活动，2.0% + ￥1。并且我们会提供更多优质、专业的服务，您可直接联系我们：010-8303 5147，<a href="mailto:service@huodongxing.com">service@huodongxing.com</a>
                    <br><br>
                    <b>具体办理时间如下：</b><br>
                    活动结束后次日即可在活动管理首页提出提款申请。
                </p>
			</div>
			<div class="modal" tabindex="1" id="event-create-ticket-refund">
                <div class="modal-dialog">
		            <div class="event-create-ticket-refund">
		                <label>退款设置 </label>
		                <div>
		                    <label class="event-create-checkbox"><input value="0" type="radio" name="RefundType" >委托「活动行」退款</label>
		                    <div>
		                        <p>如需申请退款请于活动开始前24小时外申请。申请方式：登录活动行官网—在“我参与的”找到相应票券—点击“退票”。<br />【活动行】将统一收取原票价的10%作为退票手续费，请知悉。</p>
		                    </div>
		                </div>
		                <div>
		                    <label class="event-create-checkbox"><input value="1" type="radio" name="RefundType"  >不接受退款</label>
		                    <div>
		                        本活动票券一旦售出，恕不退还。无法参加活动，请将票券转让给其他人。
		                    </div>
		                </div>
		                <div>
		                    <input type="text" id="refundPrinciple" class="form-control" placeholder="请填写不接受退款的理由" value=""></input>
		                </div>
		                <span class="icon-event-create-alert" data-original-title="" title=""></span>一旦发布后不能更改退款设置
		                <div class="text-center">
		                    <button id="btnRefundSubmit"  class="btn btn-lg btn-primary" onclick="javascript:refundSetting();">确定</button><button class="btn btn-lg btn-create-default" data-dismiss="modal">取消</button>
		                </div>
		            </div>
            	</div>
            </div>
            <div class="event-create-ticket-refund" style="display:none">
                <label>退款设置 </label>
                <div>
                    <label class="event-create-checkbox"><input type="checkbox" disabled="disabled" checked="checked"><span id="spanRefundType"></span></label>
                    <div>
                        <a class="text-primary" href="#event-create-ticket-refund" data-toggle="modal">重新选择</a>
                    </div>
                </div>
                <div>
                    <div id="RefundType0" style="">
                        <p>如需申请退款请于活动开始前24小时外申请。申请方式：登陆活动行官网—在“我参与的”找到相应票券—点击“退票”。<br />【活动行】将统一收取原票价的10%作为退票手续费，请知悉。</p>
                    </div>
                    <div id="RefundType1"  style="">
                        <p>本活动票券一旦售出，恕不退还。无法参加活动，请将票券转让给其他人。
                            <br/>
                            主办方说明：<span id="spanRefundPrinciple"></span>，
                        </p>
                     </div>
                </div>
                <span class="icon-event-create-alert"></span>一旦发布后不能更改退款设置
            </div>
        </div>
    </div>
</div>
<script id="event_ticket_template" type="text/art-template">
	<table class="event-create-ticket {{Price >= 0.01 ? 'event_charge_ticket' : 'event_free_ticket'}}" id="event_create_ticket{{SN}}">
		<tbody>
			<tr>
				<th title="{{Title}}"><div><input type="text" value="{{Title}}" {{ SN > 0 ? 'disabled="disabled"':''}} id="event_ticket_title{{SN}}"/></div></th>
                <th><div class="event-create-ticket-range"><input type="text" value="{{Quantity}}" {{ SN > 0 ? 'disabled="disabled"':''}} id="event_ticket_quantity{{SN}}"/><em>{{(Quantity <= 0 ? '不限' : Quantity)}}</em></div></th>
                <th>
					{{if Price >= 0.01}}
						<div class="event-create-ticket-range">
							<input type="text" {{ SN > 0 ? 'disabled="disabled"':''}} id="event_ticket_price{{SN}}" value="{{Price}}"/><strong>{{PriceStr}}RMB</strong>
						</div>
					{{else}}
						<div><strong class="show">{{PriceStr}}</strong></div>
					{{/if}}
				</th>
				<th><div><span class="text-muted">{{StatusStr}}</span></div></th>
                <th><div class="event-create-td-last"><span class="event-create-ticket-edit-toggle" title="更多票种设置"><i class="icon-create-config"></i></span><span title="{{ Status == 0 ? (SoldNumber > 0 ? '停售票种': '删除票种') : '恢复票种'}}" onclick="javascript:changeTiecketStatus('{{SN}}', {{ Status == 0 ? 'true' : 'false' }}, {{SoldNumber}});return false;"><i class="{{ Status == 0 ? (SoldNumber > 0 ? 'icon-ticket-pause': 'icon-trash') : 'icon-ticket-start'}}"></i></span</div></th>
            </tr>
			<tr class="event-create-ticket-config" id="edit_ticket_config{{SN}}">
				<td colspan="5">
<form action="/myevent/SaveEventTicket" id="event_ticket_form{{SN}}" method="post">						<input type="hidden" name="SN" value="{{SN}}"/>
						<input type="hidden" name="Title" value="{{Title}}" id="Title{{SN}}"/>
                        <input type="hidden" name="Currency" value="RMB" id="Currency{{SN}}"/>
						<input type="hidden" name="Quantity" value="{{Quantity}}" id="Quantity{{SN}}"/>
						<input type="hidden" name="Price" value="{{Price}}" id="Price{{SN}}"/>
						<input type="hidden" name="Status" value="{{Status}}" id="Status{{SN}}"/>
						<input type="hidden" name="Group" value="{{Group}}"/>
						<input type="hidden" name="activityId" value="9349262607200" id="activityId{{SN}}"/>
						<input type="hidden" name="src_quantity_num" value="{{QuantityUnit*Quantity}}" id="src_quantity_num{{SN}}"/>
						<input type="hidden" name="NeedApply" value="{{NeedApply ? 'true':'false'}}" id="NeedApply{{SN}}" />
                        <input type="hidden" name="Status" value="{{Status}}" id="Status{{SN}}" />
					    <input type="hidden" name="Token" value="{{Token}}" id="Token{{SN}}"/>
                        <input type="hidden" value="{{SoldNumber}}" id="SoldNumber{{SN}}"/>
						<div>
							<label>票种说明</label>
							<input name="Description" type="text" class="form-control" style="width: 816px" maxlength="200" placeholder="限制200汉字" value="{{Description}}"/>
						</div>
						<div class="pull-right" style="display:{{Price >= 0.01 ? 'block':'none'}};">
							<label>订购限制</label>
								单次订购至少&nbsp;
								<select size="1" id="at_minorder{{SN}}" name="MinOrder" style="width:66px;height:48px;vertical-align:middle;" onchange="javascript:if(parseInt($('#at_maxorder{{SN}}').val()) < parseInt(this.value)) $('#at_maxorder{{SN}}').val(this.value);">
									<option value="1" {{MinOrder == 0 || MinOrder == 1 ? 'selected="selected"' : '' }}>1</option>
									<option value="2" {{MinOrder == 2 ? 'selected="selected"' : '' }}>2</option>
									<option value="3" {{MinOrder == 3 ? 'selected="selected"' : '' }}>3</option>
									<option value="4" {{MinOrder == 4 ? 'selected="selected"' : '' }}>4</option>
									<option value="5" {{MinOrder == 5 ? 'selected="selected"' : '' }}>5</option>
									<option value="6" {{MinOrder == 6 ? 'selected="selected"' : '' }}>6</option>
									<option value="7" {{MinOrder == 7 ? 'selected="selected"' : '' }}>7</option>
									<option value="8" {{MinOrder == 8 ? 'selected="selected"' : '' }}>8</option>
									<option value="9" {{MinOrder == 9 ? 'selected="selected"' : '' }}>9</option>
									<option value="10" {{MinOrder == 10 ? 'selected="selected"' : '' }}>10</option>
								</select>
								&nbsp;&nbsp;&nbsp;&nbsp;最多&nbsp;
								<select size="1" id="at_maxorder{{SN}}" name="MaxOrder" style="width:66px;height:48px;vertical-align:middle;" onchange="javascript:if(parseInt($('#at_minorder{{SN}}').val()) > parseInt(this.value)) $('#at_minorder{{SN}}').val(this.value);">
									<option value="1" {{MaxOrder == 1 ? 'selected="selected"' : '' }}>1</option>
									<option value="2" {{MaxOrder == 2 ? 'selected="selected"' : '' }}>2</option>
									<option value="3" {{MaxOrder == 0 || MaxOrder == 3 ? 'selected="selected"' : '' }}>3</option>
									<option value="4" {{MaxOrder == 4 ? 'selected="selected"' : '' }}>4</option>
									<option value="5" {{MaxOrder == 5 ? 'selected="selected"' : '' }}>5</option>
									<option value="6" {{MaxOrder == 6 ? 'selected="selected"' : '' }}>6</option>
									<option value="7" {{MaxOrder == 7 ? 'selected="selected"' : '' }}>7</option>
									<option value="8" {{MaxOrder == 8 ? 'selected="selected"' : '' }}>8</option>
									<option value="9" {{MaxOrder == 9 ? 'selected="selected"' : '' }}>9</option>
									<option value="10" {{MaxOrder == 10 ? 'selected="selected"' : '' }}>10</option>
								</select>
								<span id="quantity_unit{{SN}}" class="ctl_prompt">{{ QuantityUnit > 1 ? "套" : "张"}}</span>
						</div>						
						<div style="display:{{Price >= 0.01 ? 'block':'none'}};">
							<label>套票设置</label><select name="QuantityUnit" id="QuantityUnit{{SN}}" style="width:160px;height:48px;vertical-align:middle;" onchange="javascript:if(this.value == '1'){jQuery('#quantity_unit{{SN}}').html('张');}else {jQuery('#quantity_unit{{SN}}').html('套');}">
								<option value="1" {{QuantityUnit == 1 ? 'selected="selected"' : '' }}>1 人票</option>
								<option value="2" {{QuantityUnit == 2 ? 'selected="selected"' : '' }}>2 人票</option>
								<option value="3" {{QuantityUnit == 3 ? 'selected="selected"' : '' }}>3 人票</option>
								<option value="4" {{QuantityUnit == 4 ? 'selected="selected"' : '' }}>4 人票</option>
								<option value="5" {{QuantityUnit == 5 ? 'selected="selected"' : '' }}>5 人票</option>
								<option value="10" {{QuantityUnit == 10 ? 'selected="selected"' : '' }}>10 人票</option>
							</select>
						</div>
						<div>
							<label>是否审核</label>
							<label class="event-create-checkbox"><input type="checkbox" {{NeedApply?'checked="checked"':''}} id="at_needapply{{SN}}"/><span class="text-muted">凡报名/订购此类票需要经过我审核</span></label>
						</div>
						<div>
							<label>订购日期</label>
							<label class="event-create-checkbox"><input id="event_ticket_book_select{{SN}}" type="checkbox" {{ BookPeriodStr == null || BookPeriodStr == '' ? 'checked="checked"':''}} onchange="javascript:if($(this).is(':checked')){$('#event_ticket_book{{SN}}').hide();}else{$('#event_ticket_book{{SN}}').show();}"><span class="text-muted">默认为活动结束前</span></label>
							<input type="hidden" name="BookStart" id="BookStart{{SN}}"/><input type="hidden" name="BookEnd" id="BookEnd{{SN}}"/>
							<div class="form-group-date" style="{{ BookPeriodStr == null || BookPeriodStr == '' ? 'display:none':''}};" id="event_ticket_book{{SN}}">
								<span class="icon-event-ticket-calendar"></span><input name="BookStart_Date" id="BookStart_Date{{SN}}" type="text" class="form-control" value="{{BookStart | dateFormat:'yyyy/MM/dd'}}"/><select name="BookStart_Time" id="BookStart_Time{{SN}}" style="width:160px;height:48px;vertical-align:middle;margin-left:6px;">
									<option value="" selected="selected"></option>
										<option value="00:00" {{BookStart | timeSelect:'00:00'}}>00:00</option>
										<option value="00:30" {{BookStart | timeSelect:'00:30'}}>00:30</option>
										<option value="01:00" {{BookStart | timeSelect:'01:00'}}>01:00</option>
										<option value="01:30" {{BookStart | timeSelect:'01:30'}}>01:30</option>
										<option value="02:00" {{BookStart | timeSelect:'02:00'}}>02:00</option>
										<option value="02:30" {{BookStart | timeSelect:'02:30'}}>02:30</option>
										<option value="03:00" {{BookStart | timeSelect:'03:00'}}>03:00</option>
										<option value="03:30" {{BookStart | timeSelect:'03:30'}}>03:30</option>
										<option value="04:00" {{BookStart | timeSelect:'04:00'}}>04:00</option>
										<option value="04:30" {{BookStart | timeSelect:'04:30'}}>04:30</option>
										<option value="05:00" {{BookStart | timeSelect:'05:00'}}>05:00</option>
										<option value="05:30" {{BookStart | timeSelect:'05:30'}}>05:30</option>
										<option value="06:00" {{BookStart | timeSelect:'06:00'}}>06:00</option>
										<option value="06:30" {{BookStart | timeSelect:'06:30'}}>06:30</option>
										<option value="07:00" {{BookStart | timeSelect:'07:00'}}>07:00</option>
										<option value="07:30" {{BookStart | timeSelect:'07:30'}}>07:30</option>
										<option value="08:00" {{BookStart | timeSelect:'08:00'}}>08:00</option>
										<option value="08:30" {{BookStart | timeSelect:'08:30'}}>08:30</option>
										<option value="09:00" {{BookStart | timeSelect:'09:00'}}>09:00</option>
										<option value="09:30" {{BookStart | timeSelect:'09:30'}}>09:30</option>
										<option value="10:00" {{BookStart | timeSelect:'10:00'}}>10:00</option>
										<option value="10:30" {{BookStart | timeSelect:'10:30'}}>10:30</option>
										<option value="11:00" {{BookStart | timeSelect:'11:00'}}>11:00</option>
										<option value="11:30" {{BookStart | timeSelect:'11:30'}}>11:30</option>
										<option value="12:00" {{BookStart | timeSelect:'12:00'}}>12:00</option>
										<option value="12:30" {{BookStart | timeSelect:'12:30'}}>12:30</option>
										<option value="13:00" {{BookStart | timeSelect:'13:00'}}>13:00</option>
										<option value="13:30" {{BookStart | timeSelect:'13:30'}}>13:30</option>
										<option value="14:00" {{BookStart | timeSelect:'14:00'}}>14:00</option>
										<option value="14:30" {{BookStart | timeSelect:'14:30'}}>14:30</option>
										<option value="15:00" {{BookStart | timeSelect:'15:00'}}>15:00</option>
										<option value="15:30" {{BookStart | timeSelect:'15:30'}}>15:30</option>
										<option value="16:00" {{BookStart | timeSelect:'16:00'}}>16:00</option>
										<option value="16:30" {{BookStart | timeSelect:'16:30'}}>16:30</option>
										<option value="17:00" {{BookStart | timeSelect:'17:00'}}>17:00</option>
										<option value="17:30" {{BookStart | timeSelect:'17:30'}}>17:30</option>
										<option value="18:00" {{BookStart | timeSelect:'18:00'}}>18:00</option>
										<option value="18:30" {{BookStart | timeSelect:'18:30'}}>18:30</option>
										<option value="19:00" {{BookStart | timeSelect:'19:00'}}>19:00</option>
										<option value="19:30" {{BookStart | timeSelect:'19:30'}}>19:30</option>
										<option value="20:00" {{BookStart | timeSelect:'20:00'}}>20:00</option>
										<option value="20:30" {{BookStart | timeSelect:'20:30'}}>20:30</option>
										<option value="21:00" {{BookStart | timeSelect:'21:00'}}>21:00</option>
										<option value="21:30" {{BookStart | timeSelect:'21:30'}}>21:30</option>
										<option value="22:00" {{BookStart | timeSelect:'22:00'}}>22:00</option>
										<option value="22:30" {{BookStart | timeSelect:'22:30'}}>22:30</option>
										<option value="23:00" {{BookStart | timeSelect:'23:00'}}>23:00</option>
										<option value="23:30" {{BookStart | timeSelect:'23:30'}}>23:30</option>
								</select><span class="icon-event-ticket-arrow"></span><span class="icon-event-ticket-calendar"></span><input name="BookEnd_Date" id="BookEnd_Date{{SN}}" type="text" class="form-control" value="{{BookEnd | dateFormat:'yyyy/MM/dd'}}"/><select name="BookEnd_Time" id="BookEnd_Time{{SN}}" style="width:160px;height:48px;vertical-align:middle;margin-left:6px;">
									<option value="" selected="selected"></option>
										<option value="00:00" {{BookEnd | timeSelect:'00:00'}}>00:00</option>
										<option value="00:30" {{BookEnd | timeSelect:'00:30'}}>00:30</option>
										<option value="01:00" {{BookEnd | timeSelect:'01:00'}}>01:00</option>
										<option value="01:30" {{BookEnd | timeSelect:'01:30'}}>01:30</option>
										<option value="02:00" {{BookEnd | timeSelect:'02:00'}}>02:00</option>
										<option value="02:30" {{BookEnd | timeSelect:'02:30'}}>02:30</option>
										<option value="03:00" {{BookEnd | timeSelect:'03:00'}}>03:00</option>
										<option value="03:30" {{BookEnd | timeSelect:'03:30'}}>03:30</option>
										<option value="04:00" {{BookEnd | timeSelect:'04:00'}}>04:00</option>
										<option value="04:30" {{BookEnd | timeSelect:'04:30'}}>04:30</option>
										<option value="05:00" {{BookEnd | timeSelect:'05:00'}}>05:00</option>
										<option value="05:30" {{BookEnd | timeSelect:'05:30'}}>05:30</option>
										<option value="06:00" {{BookEnd | timeSelect:'06:00'}}>06:00</option>
										<option value="06:30" {{BookEnd | timeSelect:'06:30'}}>06:30</option>
										<option value="07:00" {{BookEnd | timeSelect:'07:00'}}>07:00</option>
										<option value="07:30" {{BookEnd | timeSelect:'07:30'}}>07:30</option>
										<option value="08:00" {{BookEnd | timeSelect:'08:00'}}>08:00</option>
										<option value="08:30" {{BookEnd | timeSelect:'08:30'}}>08:30</option>
										<option value="09:00" {{BookEnd | timeSelect:'09:00'}}>09:00</option>
										<option value="09:30" {{BookEnd | timeSelect:'09:30'}}>09:30</option>
										<option value="10:00" {{BookEnd | timeSelect:'10:00'}}>10:00</option>
										<option value="10:30" {{BookEnd | timeSelect:'10:30'}}>10:30</option>
										<option value="11:00" {{BookEnd | timeSelect:'11:00'}}>11:00</option>
										<option value="11:30" {{BookEnd | timeSelect:'11:30'}}>11:30</option>
										<option value="12:00" {{BookEnd | timeSelect:'12:00'}}>12:00</option>
										<option value="12:30" {{BookEnd | timeSelect:'12:30'}}>12:30</option>
										<option value="13:00" {{BookEnd | timeSelect:'13:00'}}>13:00</option>
										<option value="13:30" {{BookEnd | timeSelect:'13:30'}}>13:30</option>
										<option value="14:00" {{BookEnd | timeSelect:'14:00'}}>14:00</option>
										<option value="14:30" {{BookEnd | timeSelect:'14:30'}}>14:30</option>
										<option value="15:00" {{BookEnd | timeSelect:'15:00'}}>15:00</option>
										<option value="15:30" {{BookEnd | timeSelect:'15:30'}}>15:30</option>
										<option value="16:00" {{BookEnd | timeSelect:'16:00'}}>16:00</option>
										<option value="16:30" {{BookEnd | timeSelect:'16:30'}}>16:30</option>
										<option value="17:00" {{BookEnd | timeSelect:'17:00'}}>17:00</option>
										<option value="17:30" {{BookEnd | timeSelect:'17:30'}}>17:30</option>
										<option value="18:00" {{BookEnd | timeSelect:'18:00'}}>18:00</option>
										<option value="18:30" {{BookEnd | timeSelect:'18:30'}}>18:30</option>
										<option value="19:00" {{BookEnd | timeSelect:'19:00'}}>19:00</option>
										<option value="19:30" {{BookEnd | timeSelect:'19:30'}}>19:30</option>
										<option value="20:00" {{BookEnd | timeSelect:'20:00'}}>20:00</option>
										<option value="20:30" {{BookEnd | timeSelect:'20:30'}}>20:30</option>
										<option value="21:00" {{BookEnd | timeSelect:'21:00'}}>21:00</option>
										<option value="21:30" {{BookEnd | timeSelect:'21:30'}}>21:30</option>
										<option value="22:00" {{BookEnd | timeSelect:'22:00'}}>22:00</option>
										<option value="22:30" {{BookEnd | timeSelect:'22:30'}}>22:30</option>
										<option value="23:00" {{BookEnd | timeSelect:'23:00'}}>23:00</option>
										<option value="23:30" {{BookEnd | timeSelect:'23:30'}}>23:30</option>
								</select>
							</div>
						</div>
						<div>
							<label>有效日期</label>
							<label class="event-create-checkbox"><input id="event_ticket_effect_select{{SN}}" type="checkbox" {{ EffectPeriodStr == null || EffectPeriodStr == '' ? 'checked="checked"':''}} onchange="javascript:if($(this).is(':checked')){$('#event_ticket_effect{{SN}}').hide();}else{$('#event_ticket_effect{{SN}}').show();}"><span class="text-muted">默认为活动期间内有效</span></label>
							<input type="hidden" name="EffectiveDate" id="EffectiveDate{{SN}}"/><input type="hidden" name="ExpiredDate" id="ExpiredDate{{SN}}"/>
							<div class="form-group-date" style="{{ EffectPeriodStr == null || EffectPeriodStr == '' ? 'display:none':''}};" id="event_ticket_effect{{SN}}">
								<span class="icon-event-ticket-calendar"></span><input name="EffectiveDate_Date" id="EffectiveDate_Date{{SN}}" type="text" class="form-control" value="{{EffectiveDate | dateFormat:'yyyy/MM/dd'}}"/><select name="EffectiveDate_Time" id="EffectiveDate_Time{{SN}}" style="width:160px;height:48px;vertical-align:middle;margin-left:6px;">
									<option value="" selected="selected"></option>
										<option value="00:00" {{EffectiveDate | timeSelect:'00:00'}}>00:00</option>
										<option value="00:30" {{EffectiveDate | timeSelect:'00:30'}}>00:30</option>
										<option value="01:00" {{EffectiveDate | timeSelect:'01:00'}}>01:00</option>
										<option value="01:30" {{EffectiveDate | timeSelect:'01:30'}}>01:30</option>
										<option value="02:00" {{EffectiveDate | timeSelect:'02:00'}}>02:00</option>
										<option value="02:30" {{EffectiveDate | timeSelect:'02:30'}}>02:30</option>
										<option value="03:00" {{EffectiveDate | timeSelect:'03:00'}}>03:00</option>
										<option value="03:30" {{EffectiveDate | timeSelect:'03:30'}}>03:30</option>
										<option value="04:00" {{EffectiveDate | timeSelect:'04:00'}}>04:00</option>
										<option value="04:30" {{EffectiveDate | timeSelect:'04:30'}}>04:30</option>
										<option value="05:00" {{EffectiveDate | timeSelect:'05:00'}}>05:00</option>
										<option value="05:30" {{EffectiveDate | timeSelect:'05:30'}}>05:30</option>
										<option value="06:00" {{EffectiveDate | timeSelect:'06:00'}}>06:00</option>
										<option value="06:30" {{EffectiveDate | timeSelect:'06:30'}}>06:30</option>
										<option value="07:00" {{EffectiveDate | timeSelect:'07:00'}}>07:00</option>
										<option value="07:30" {{EffectiveDate | timeSelect:'07:30'}}>07:30</option>
										<option value="08:00" {{EffectiveDate | timeSelect:'08:00'}}>08:00</option>
										<option value="08:30" {{EffectiveDate | timeSelect:'08:30'}}>08:30</option>
										<option value="09:00" {{EffectiveDate | timeSelect:'09:00'}}>09:00</option>
										<option value="09:30" {{EffectiveDate | timeSelect:'09:30'}}>09:30</option>
										<option value="10:00" {{EffectiveDate | timeSelect:'10:00'}}>10:00</option>
										<option value="10:30" {{EffectiveDate | timeSelect:'10:30'}}>10:30</option>
										<option value="11:00" {{EffectiveDate | timeSelect:'11:00'}}>11:00</option>
										<option value="11:30" {{EffectiveDate | timeSelect:'11:30'}}>11:30</option>
										<option value="12:00" {{EffectiveDate | timeSelect:'12:00'}}>12:00</option>
										<option value="12:30" {{EffectiveDate | timeSelect:'12:30'}}>12:30</option>
										<option value="13:00" {{EffectiveDate | timeSelect:'13:00'}}>13:00</option>
										<option value="13:30" {{EffectiveDate | timeSelect:'13:30'}}>13:30</option>
										<option value="14:00" {{EffectiveDate | timeSelect:'14:00'}}>14:00</option>
										<option value="14:30" {{EffectiveDate | timeSelect:'14:30'}}>14:30</option>
										<option value="15:00" {{EffectiveDate | timeSelect:'15:00'}}>15:00</option>
										<option value="15:30" {{EffectiveDate | timeSelect:'15:30'}}>15:30</option>
										<option value="16:00" {{EffectiveDate | timeSelect:'16:00'}}>16:00</option>
										<option value="16:30" {{EffectiveDate | timeSelect:'16:30'}}>16:30</option>
										<option value="17:00" {{EffectiveDate | timeSelect:'17:00'}}>17:00</option>
										<option value="17:30" {{EffectiveDate | timeSelect:'17:30'}}>17:30</option>
										<option value="18:00" {{EffectiveDate | timeSelect:'18:00'}}>18:00</option>
										<option value="18:30" {{EffectiveDate | timeSelect:'18:30'}}>18:30</option>
										<option value="19:00" {{EffectiveDate | timeSelect:'19:00'}}>19:00</option>
										<option value="19:30" {{EffectiveDate | timeSelect:'19:30'}}>19:30</option>
										<option value="20:00" {{EffectiveDate | timeSelect:'20:00'}}>20:00</option>
										<option value="20:30" {{EffectiveDate | timeSelect:'20:30'}}>20:30</option>
										<option value="21:00" {{EffectiveDate | timeSelect:'21:00'}}>21:00</option>
										<option value="21:30" {{EffectiveDate | timeSelect:'21:30'}}>21:30</option>
										<option value="22:00" {{EffectiveDate | timeSelect:'22:00'}}>22:00</option>
										<option value="22:30" {{EffectiveDate | timeSelect:'22:30'}}>22:30</option>
										<option value="23:00" {{EffectiveDate | timeSelect:'23:00'}}>23:00</option>
										<option value="23:30" {{EffectiveDate | timeSelect:'23:30'}}>23:30</option>
								</select><span class="icon-event-ticket-arrow"></span><span class="icon-event-ticket-calendar"></span><input name="ExpiredDate_Date" id="ExpiredDate_Date{{SN}}" type="text" class="form-control" value="{{ExpiredDate | dateFormat:'yyyy/MM/dd'}}"/><select name="ExpiredDate_Time" id="ExpiredDate_Time{{SN}}" style="width:160px;height:48px;vertical-align:middle;margin-left:6px;">
									<option value="" selected="selected"></option>
										<option value="00:00" {{ExpiredDate | timeSelect:'00:00'}}>00:00</option>
										<option value="00:30" {{ExpiredDate | timeSelect:'00:30'}}>00:30</option>
										<option value="01:00" {{ExpiredDate | timeSelect:'01:00'}}>01:00</option>
										<option value="01:30" {{ExpiredDate | timeSelect:'01:30'}}>01:30</option>
										<option value="02:00" {{ExpiredDate | timeSelect:'02:00'}}>02:00</option>
										<option value="02:30" {{ExpiredDate | timeSelect:'02:30'}}>02:30</option>
										<option value="03:00" {{ExpiredDate | timeSelect:'03:00'}}>03:00</option>
										<option value="03:30" {{ExpiredDate | timeSelect:'03:30'}}>03:30</option>
										<option value="04:00" {{ExpiredDate | timeSelect:'04:00'}}>04:00</option>
										<option value="04:30" {{ExpiredDate | timeSelect:'04:30'}}>04:30</option>
										<option value="05:00" {{ExpiredDate | timeSelect:'05:00'}}>05:00</option>
										<option value="05:30" {{ExpiredDate | timeSelect:'05:30'}}>05:30</option>
										<option value="06:00" {{ExpiredDate | timeSelect:'06:00'}}>06:00</option>
										<option value="06:30" {{ExpiredDate | timeSelect:'06:30'}}>06:30</option>
										<option value="07:00" {{ExpiredDate | timeSelect:'07:00'}}>07:00</option>
										<option value="07:30" {{ExpiredDate | timeSelect:'07:30'}}>07:30</option>
										<option value="08:00" {{ExpiredDate | timeSelect:'08:00'}}>08:00</option>
										<option value="08:30" {{ExpiredDate | timeSelect:'08:30'}}>08:30</option>
										<option value="09:00" {{ExpiredDate | timeSelect:'09:00'}}>09:00</option>
										<option value="09:30" {{ExpiredDate | timeSelect:'09:30'}}>09:30</option>
										<option value="10:00" {{ExpiredDate | timeSelect:'10:00'}}>10:00</option>
										<option value="10:30" {{ExpiredDate | timeSelect:'10:30'}}>10:30</option>
										<option value="11:00" {{ExpiredDate | timeSelect:'11:00'}}>11:00</option>
										<option value="11:30" {{ExpiredDate | timeSelect:'11:30'}}>11:30</option>
										<option value="12:00" {{ExpiredDate | timeSelect:'12:00'}}>12:00</option>
										<option value="12:30" {{ExpiredDate | timeSelect:'12:30'}}>12:30</option>
										<option value="13:00" {{ExpiredDate | timeSelect:'13:00'}}>13:00</option>
										<option value="13:30" {{ExpiredDate | timeSelect:'13:30'}}>13:30</option>
										<option value="14:00" {{ExpiredDate | timeSelect:'14:00'}}>14:00</option>
										<option value="14:30" {{ExpiredDate | timeSelect:'14:30'}}>14:30</option>
										<option value="15:00" {{ExpiredDate | timeSelect:'15:00'}}>15:00</option>
										<option value="15:30" {{ExpiredDate | timeSelect:'15:30'}}>15:30</option>
										<option value="16:00" {{ExpiredDate | timeSelect:'16:00'}}>16:00</option>
										<option value="16:30" {{ExpiredDate | timeSelect:'16:30'}}>16:30</option>
										<option value="17:00" {{ExpiredDate | timeSelect:'17:00'}}>17:00</option>
										<option value="17:30" {{ExpiredDate | timeSelect:'17:30'}}>17:30</option>
										<option value="18:00" {{ExpiredDate | timeSelect:'18:00'}}>18:00</option>
										<option value="18:30" {{ExpiredDate | timeSelect:'18:30'}}>18:30</option>
										<option value="19:00" {{ExpiredDate | timeSelect:'19:00'}}>19:00</option>
										<option value="19:30" {{ExpiredDate | timeSelect:'19:30'}}>19:30</option>
										<option value="20:00" {{ExpiredDate | timeSelect:'20:00'}}>20:00</option>
										<option value="20:30" {{ExpiredDate | timeSelect:'20:30'}}>20:30</option>
										<option value="21:00" {{ExpiredDate | timeSelect:'21:00'}}>21:00</option>
										<option value="21:30" {{ExpiredDate | timeSelect:'21:30'}}>21:30</option>
										<option value="22:00" {{ExpiredDate | timeSelect:'22:00'}}>22:00</option>
										<option value="22:30" {{ExpiredDate | timeSelect:'22:30'}}>22:30</option>
										<option value="23:00" {{ExpiredDate | timeSelect:'23:00'}}>23:00</option>
										<option value="23:30" {{ExpiredDate | timeSelect:'23:30'}}>23:30</option>
								</select>
							</div>
						</div>
						<div class="text-center">
							<button class="btn btn-lg btn-primary"  type="button" onclick="javascript:saveEventTicket('{{SN}}', 0);return false;">保存</button>
							<button class="btn btn-lg btn-create-default" onclick="javascript:$('#event_create_ticket{{SN}}').removeClass('event-create-ticket-edit');return false;">关闭</button>
						</div>
</form>				</td>
			</tr>
		</tbody>
	</table>
</script>
	<script type="text/javascript">
		var eventTicketFreeJson = {"SN":-1,"Status":0,"Price":0,"Currency":null,"Title":"免费票","Description":null,"Quantity":0,"SoldNumber":0,"BookNumber":0,"BookStart":null,"BookEnd":null,"QuantityUnit":1,"MinOrder":1,"MaxOrder":1,"NeedApply":null,"EffectiveDate":null,"ExpiredDate":null,"Group":null,"Enabled":false,"BookPeriodStr":null,"EffectPeriodStr":null,"StatusStr":"报名尚未开始","OrderNums":[1],"IsSeriesTicket":false,"PriceStr":"免费","SrcPriceStr":null,"Discount":null,"Token":"12A8CFDA32742760D8F177C6428A1563DACAE4F82CBEFB22013689148E335EF2A9C7124DA5AEFD85FF"};
		var eventTicketChargeJson = {"SN":-1,"Status":0,"Price":0.01,"Currency":null,"Title":"收费票","Description":null,"Quantity":0,"SoldNumber":0,"BookNumber":0,"BookStart":null,"BookEnd":null,"QuantityUnit":1,"MinOrder":1,"MaxOrder":3,"NeedApply":null,"EffectiveDate":null,"ExpiredDate":null,"Group":null,"Enabled":false,"BookPeriodStr":null,"EffectPeriodStr":null,"StatusStr":"售票尚未开始","OrderNums":[1,2,3],"IsSeriesTicket":false,"PriceStr":"¥0.01","SrcPriceStr":null,"Discount":null,"Token":"12A8CFDA32742760D8F177C6428A1563DA3E7F66218015F1FC2431BC1475D1D70ADCE2DE1F6A318700"};
        var hasSetRefund = false;
        var canEditRefund = false;
        var changeRefundSettingOnly = true;
        function checkRefoundSettingAndAddTicket(free)
        {
            if(!hasSetRefund && !free)
            {
                //弹出收费设定modal
                changeRefundSettingOnly = false;
                $('#event-create-ticket-refund').modal();
                return;
            }
            else
            {
                addEventTicketTemplate(free);
            }
        }

        function refundSetting()
        {
            if($("#btnRefundSubmit").is('disabled')) return;
            var refundType = $("input:radio[name='RefundType'][checked]").val()
            if(refundType == null || refundType == "")
            {
                PopupMessage(1, "请选择退票处理方式.", 2000);
                return;
            }
            var refundPrinciple = refundType == 1 ? $("#refundPrinciple").val():"";
            if(refundType == 1 && $.trim(refundPrinciple) == '')
            {
                PopupMessage(1, "请填写不接受退款的理由.", 2000);
                return;
            }
            jQuery.ajax({
                url: '/myevent/setRefund',
                type: "POST",
                data: { "id": '9349262607200', "RefundType": refundType, "RefundPrinciple": refundPrinciple},
                success: function(data) {
                    if (data != null && data.AjaxErrStatus != null && data.AjaxErrStatus == 1) {
                        PopupMessage(1, "退款设置出错,请稍后重试：" + data.AjaxErrMsg, 2000);
                        return;
                    }
                    if (data == true) {
                        $('#event-create-ticket-refund').modal('hide');
                        PopupMessage(0, "退票设置成功", 2000);
                        hasSetRefund = true;
                        if(canEditRefund){$("#btnRefundSubmit").attr('disabled','disabled');}
                        $(".event-create-ticket-refund").show();
                        $("[id^='RefundType']").hide();
                        if(refundType == "0")
                        {
                            $('#spanRefundType').text("委托「活动行」退款");
                            $('#RefundType0').show();
                        }
                        else if(refundType == "1")
                        {
                            $('#spanRefundType').text("不接受退款");
                            $('#spanRefundPrinciple').text(refundPrinciple);
                            $('#RefundType1').show();
                        }
                        if(!changeRefundSettingOnly)
                        {
                            changeRefundSettingOnly = true;
                            addEventTicketTemplate(false);
                        }
                        
                    } else {
                        PopupMessage(1, "退票设置出错,请稍后重试：" + data.AjaxErrMsg, 2000);
                        return;
                    }
                }
            });
        }

		function addEventTicketTemplate(free){
			var etthumbs = $(free ? "#event_free_ticket_thumbs" : "#event_charge_ticket_thumbs");
			var newTicketJson = (free ? eventTicketFreeJson : eventTicketChargeJson);
			newTicketJson.SN = (-1 * Math.ceil(Math.random()*(10000000-1)+1));
			var itemsHtml = template('event_ticket_template', newTicketJson);
			$(".event-create-ticket").removeClass("event-create-ticket-edit")
			if(free) $("#event_free_ticket_thumbs_header").show();
			else $("#event_charge_ticket_thumbs_header").show();

			etthumbs.append(itemsHtml);
			etthumbs.show();

			jQuery("#event_ticket_form" + newTicketJson.SN).ajaxSubmit({
		        success: function (data) {
					if(data != null && data.AjaxErrStatus != null && data.AjaxErrStatus == 1){
						PopupMessage(1, "添加活动票种出错：" + data.AjaxErrMsg, 3000);
						return;
					}
		            if (data != null && data != "") {
		                eventTicketsJson = data;
		                renderEventTickets();
						var et_eles = free ? $("table.event_free_ticket") : $("table.event_charge_ticket");
						if(et_eles != null && et_eles.length > 0){
							var tmpeteles = $(et_eles[et_eles.length - 1]);
							tmpeteles.addClass("event-create-ticket-edit");
							tmpeteles.find('th input').prop('disabled', false);
							tmpeteles.find('select').selectpicker({ size: false });
							tmpeteles.find('.form-group-date input').datepicker({ format: 'yyyy/mm/dd' });
						}
		            }
		        },
		        error: function (XMLHttpRequest, textStatus, errorThrown) {
					PopupMessage(1, "添加活动票种出错：服务不存在或无响应", 3000);
		        }
		    });
		}

        function changeTiecketStatus(etsn, flag, sold) {
			if(flag) {
				if(!confirm("确认" + (sold > 0 ? "停售" : "删除") + "该票种？")){ return; }
                else{
                    if($('[id^="event_create_ticket"]:visible').length == 1 && sold < 1)
                    {
                        alert("活动报名至少需要一个票种，该票种不能删除");
                        return;
                    }
                }
			}
			$('#event_create_ticket' + etsn).hide();
            if(etsn > 0){
				var srcStatus = $('#Status' + etsn).val();
                $('#Status' + etsn).val(srcStatus == "0" ? "1" : "0");
                saveEventTicket(etsn, (flag ? (sold > 0 ? 2 : 1) : 3));
            }
        }

		function saveEventTicket(etsn, stype) {
			var aele = $("#activityId" + etsn);
			if (aele != null && (aele.val() == null || aele.val() == "" || parseInt(aele.val()) < 1) && $("#activity_id")) aele.val($("#activity_id").val());
			
			var tmpele = $("#event_ticket_title" + etsn);
			if(tmpele.val() == null || $.trim(tmpele.val()) == ""){
				PopupMessage(1, "票种名称不可为空，请填写。", 2000);
				return;
			}
			$("#Title" + etsn).val(tmpele.val());
			
			var quUnit = 1;
			var reint = /^[0-9]+[0-9]*$/;
			tmpele = $("#event_ticket_price" + etsn);
			if(tmpele != null && tmpele.length > 0){
				var refloat = /^[0-9]+.?[0-9]*$/;
				if((tmpele.val() == null || $.trim(tmpele.val()) == "" || !refloat.test(tmpele.val()) || parseFloat(tmpele.val()) <= 0.01)&& (stype == 3 || stype == 0)) {
					PopupMessage(1, "票种单价不可为空且必须为有效数字，请填写。", 2000);
					return;
				}
				$("#Price" + etsn).val(tmpele.val());

				var quEle = $("#QuantityUnit" + etsn);
				if(quEle != null && quEle.length > 0){
					if(!reint.test(quEle.val()) || parseFloat(tmpele.val()) < 0.01) quEle.val("1");
					quUnit = parseInt(quEle.val());
				}
			}
			
			tmpele = $("#event_ticket_quantity" + etsn);
			if(tmpele.val() == null || $.trim(tmpele.val()) == "" || !reint.test(tmpele.val()) || parseInt(tmpele.val()) < 0){
				PopupMessage(1, "票种限额不可为空且必须为有效数字，请填写。", 2000);
				return;
			}

		    var tmpSoldNumber =parseInt($("#SoldNumber" + etsn).val());
		    var limitNumber = parseInt(tmpele.val());
            if (limitNumber>0 && tmpSoldNumber > 0 && tmpSoldNumber > limitNumber) {
                PopupMessage(1, "票种限额("+limitNumber+")小于已售数量("+tmpSoldNumber+")，请填写。", 3000);
				return;
            }
			$("#Quantity" + etsn).val(parseInt(tmpele.val()));
			
            var eventMaxIns = $("#event_base_form input[name='MaxInstance']");
			if(eventMaxIns != null && eventMaxIns.length > 0){
				var tmpQty = eventTicketsQty + parseInt($("#Quantity" + etsn).val()) * quUnit;
				tmpQty -= parseInt($("#src_quantity_num" + etsn).val());
				if(tmpQty > parseInt(eventMaxIns.val()) && parseInt(eventMaxIns.val()) != 0){
					PopupMessage(1, "活动票种的总名额(" + tmpQty + ")大于活动人数上限(" + eventMaxIns.val() + ")，请调整。", 2000);
					return;
				}
			}

			tmpele = $("#at_needapply" + etsn);
			$("#NeedApply" + etsn).val(tmpele.is(":checked") ? "true" : "false");
			if (tmpele.is(":checked")) {
				if(stype == 0){
					if (!window.confirm("报名此票种将需要经过您审核才会出票，您确定要这么做？")) {
						return;
					}
				}
			}

			var etbstart = $("#BookStart" + etsn);
			var etbend = $("#BookEnd" + etsn);
			tmpele = $("#event_ticket_book_select" + etsn);
			if (tmpele.is(":checked")){ etbstart.val(""); etbend.val(""); }
			else{
				etbstart.val($("#BookStart_Date" + etsn).val() + " " + $("#BookStart_Time" + etsn).val());
				etbend.val($("#BookEnd_Date" + etsn).val() + " " + $("#BookEnd_Time" + etsn).val());
				if($.trim(etbstart.val()) != '' && $.trim(etbend.val()) != ''){
					if (new Date(etbstart.val()) > new Date(etbend.val())) {
						PopupMessage(1, "售票期开始时间不能晚于结束时间，请调整。", 2000);
						return; 
					}
				}
			}
			
			var eteffective = $("#EffectiveDate" + etsn);
			var etexpired = $("#ExpiredDate" + etsn);
			tmpele = $("#event_ticket_effect_select" + etsn);
			if (tmpele.is(":checked")){ eteffective.val(""); etexpired.val(""); }
			else{
				eteffective.val($("#EffectiveDate_Date" + etsn).val() + " " + $("#EffectiveDate_Time" + etsn).val());
				etexpired.val($("#ExpiredDate_Date" + etsn).val() + " " + $("#ExpiredDate_Time" + etsn).val());

				if($.trim(eteffective.val()) != '' && $.trim(etexpired.val()) != ''){
					if (new Date(eteffective.val()) > new Date(etexpired.val())) {
						PopupMessage(1, "有效期开始时间不能晚于结束时间，请调整。", 2000);
						return; 
					}
				}
			}

            var current_estime = $("#event_base_form input[name='Start']").val();
		    var current_eetime = $("#event_base_form input[name='End']").val();
            var estime = $("#event_start_date").val() + " " + $("#event_start_time").val();
		    var eetime = $("#event_end_date").val() + " " + $("#event_end_time").val();
            if(current_estime != estime || current_eetime != eetime) saveEventForDraft();

			var token = $("#Token" + etsn).val();
			if(token == null || token == ""){ $("#Token" + etsn).val(eventTicketChargeJson.Token); }
			var msglable = (stype == 1 ? "删除" : ( stype == 2 ? "停售" : (stype == 3 ? "恢复" : "保存")));
			jQuery("#event_ticket_form" + etsn).ajaxSubmit({
		        success: function (data) {
					if(data != null && data.AjaxErrStatus != null && data.AjaxErrStatus == 1){
						PopupMessage(1, msglable + "活动票种出错：" + data.AjaxErrMsg, 3000);
						return;
					}
		            if (data != null && data != "") {
						PopupMessage(0, "活动票种已" + msglable, 2000);
		                eventTicketsJson = data;
		                renderEventTickets();
		            }
		        },
		        error: function (XMLHttpRequest, textStatus, errorThrown) {
					PopupMessage(1, msglable + "活动票种出错：服务不存在或无响应", 3000);
		        }
		    });
		}
	</script>

<script type="text/javascript">
	template.helper('dateFormat', function (date, formatstr) {
		if(date == null || date == "") return "";
		var timetmp = parseInt(date.substring(6));
		var datetmp = new Date(timetmp);
		return datetmp.format(formatstr);
	});

	template.helper('timeSelect', function (date, timestr) {
		if(date == null || date == "") return "";
		var timetmp = parseInt(date.substring(6));
		var datetmp = new Date(timetmp);
		if(datetmp.format("hh:mm") == timestr) return "selected='selected'";
		return "";
	});

	var eventTicketsJson = null;
	
	var eventTicketsQty = 0;
	function renderEventTickets() {
		eventTicketsQty = 0;
		var freeitemsHtml = "";
		var chargeitemsHtml = "";
		var freeetthumbs = $("#event_free_ticket_thumbs");
		var chargethumbs = $("#event_charge_ticket_thumbs");

		if(eventTicketsJson != null && eventTicketsJson.length > 0){
			for(i = 0; i < eventTicketsJson.length; i++) {
				var tmpItem = eventTicketsJson[i];
				if(tmpItem == null || tmpItem.SN == null || tmpItem.SN <= 0) continue;
				var itemsHtml = template('event_ticket_template', tmpItem);
				if(tmpItem.Price >= 0.01) chargeitemsHtml = chargeitemsHtml + itemsHtml;
				else freeitemsHtml = freeitemsHtml + itemsHtml;
				eventTicketsQty += tmpItem.Quantity * tmpItem.QuantityUnit;
			}
			$("#event_ticket_alert_msg").hide();
			$("#event_free_ticket_thumbs_header").hide();
			$("#event_charge_ticket_thumbs_header").hide();

			freeetthumbs.empty();
			if(freeitemsHtml != null && freeitemsHtml != ""){
				freeetthumbs.append(freeitemsHtml);
				freeetthumbs.show();
				//freeetthumbs.find('select').selectpicker({ size: false });
				//freeetthumbs.find('.form-group-date input').datepicker({ format: 'yyyy/mm/dd' });
				$("#event_free_ticket_thumbs_header").show();
			}
			chargethumbs.empty();
			if(chargeitemsHtml && chargeitemsHtml != ""){
				chargethumbs.append(chargeitemsHtml);
				chargethumbs.show();
				//chargethumbs.find('select').selectpicker({ size: false });
				//chargethumbs.find('.form-group-date input').datepicker({ format: 'yyyy/mm/dd' });
				$("#event_charge_ticket_thumbs_header").show();
			}
		}
		else{
			$("#event_free_ticket_thumbs_header").hide();
			$("#event_charge_ticket_thumbs_header").hide();
			$("#event_ticket_alert_msg").show();
			freeetthumbs.empty();
			freeetthumbs.hide();

			chargethumbs.empty();
			chargethumbs.hide();
		}
	}

	$(function () {
		renderEventTickets();

        $("input:radio[name='RefundType']").on("click",function(e) { 
            var type = $(this).val();
            if(type != "1")
            {
                $('#refundPrinciple').attr('disabled','true');
            }
            else{
                 $('#refundPrinciple').removeAttr('disabled');
            }
            });
	});
</script>

    <div class="text-center">
        <button class="btn btn-lg btn-primary" onclick="javascript:saveAndPublishEvent();return false;"><span class="icon-btn-success"></span>发布</button>
        <button class="btn btn-lg btn-create-default" onclick="javascript:saveEventForDraft();return false;">存为草稿</button>
        <button class="btn btn-lg btn-create-default" onclick="javascript:saveAndPreviewEvent();return false;">预览</button>
        <div style="margin-top:10px;font-size:15px;"><a target="_blank" href="https://mp.weixin.qq.com/s?__biz=MjM5OTc1MTc4MA==&mid=404734890&idx=1&sn=9c27f2482c2031c039e7f547f3393f59&scene=1&srcid=0328pWaKLD0bnji1KvW88HH8#wechat_redirect">如何快速审核通过？（活动审核标准）</a></div>
    </div>
</div>

<div class="modal fade" id="dlg_valid_contact" style="z-index:1051">
	<div class="modal-dialog" style="width:550px;">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">验证手机号码</h4>
			</div>
			<div class="modal-body">
				<div id="valid_process_loading" style="padding:30px 20px;display:none;">
					<img src='http://cdn.huodongxing.com/Content/img/loading.gif'/>正在处理中，请稍候...
				</div> 
				<div id="valid_content" style="padding:20px 20px 15px;">
					<div style="font-weight:bold;margin-top:5px">
						第一次发布活动前需要验证您的手机号码，请完成以下操作。
					</div>
					<br/>
					<div id="valid_contact_msg"></div>
				    <input id="valid_contact_type" type="hidden" value="0"/>
					<form class = "form-horizontal">
						<div class="control-group">
							<label class="control-label" id="valid_contact_type_label">验证电子邮箱</label>
							<div class="controls">
								<input type="text" value="" class="input-medium" id="valid_contact_type_val"/>
								<a id="valid_send_code_btn" href="#" class="btn btn-success" onclick="javascript:sendActivatecode();return false;">
									<i class="icon-share-alt icon-white"></i>&nbsp;发送验证码 <span id="sending_animal_remain" style="display:none;"></span>
								</a>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" >请输入收到的验证码</label>
							<div class="controls">
								<input id="valid_contact_code" type="text" value="" class="input-medium"/>
								<button id="valid_submit_btn" type="button" class="btn btn-primary" onclick="javascript:submitValidContact();">
									<i class="icon-ok icon-white"></i>&nbsp;确&nbsp;定&nbsp;
								</button>
							</div>
						</div>
					</form>
					<br/>
				</div> 
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="icon-off"></i>&nbsp;关闭&nbsp;
				</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var animal_sending_timer = null;
	var onContactValidSuccess = null;
	function startValidUserContact(type, val, autoSend, func){
		$("#valid_contact_type").val(type);
		$("#valid_contact_type_label").html(type == 0 ? "验证电子邮箱" : "验证手机号码");
		if(val != null && $.trim(val) != "") $("#valid_contact_type_val").val(val);
		$("#valid_contact_type_val").prop("disabled", false);
		$("#valid_contact_msg").empty();
		$('#dlg_valid_contact').modal({show: true,backdrop:"static"});
		$("#valid_contact_code").val("");
		if(autoSend) sendActivatecode();
		onContactValidSuccess = func;
	}
	function submitValidContact(){
		if ($.trim($("#valid_contact_code").val()) == "") {
            window.alert("请输入您收到的验证码。");
            return false;
        }
        var btnSubmit = $("#valid_submit_btn");
        //btnSubmit.button('验证中...');
        //setTimeout(function () { btnSubmit.button('reset'); }, 3000);
        $("#valid_process_loading").show();
        $("#valid_content").hide();
		var type = $("#valid_contact_type").val();
		var aim = $("#valid_contact_type_val").val();
        $.ajax({
            url: '/account/activate',
            type: "GET",
            global: false,
			cache: false,
            data: { "code": $("#valid_contact_code").val(), "type":  type, "aim": aim},
            success: function (data) {
				if(data != null && data.AjaxErrStatus != null && data.AjaxErrStatus == 1){
					$("#valid_content").show();
					$("#valid_contact_msg").empty();
					$("#valid_contact_msg").append('<div class="alert alert-error">确定验证码出错，原因：' + data.AjaxErrMsg + '</div>');
					return;
				}

                $("#valid_process_loading").hide();
                $("#valid_content").show();
                $("#valid_contact_msg").empty();
                if (data != null && data == true) {
                    $('#dlg_valid_contact').modal('hide');
					try{
						if(onContactValidSuccess != null && typeof(onContactValidSuccess) == 'function'){
							onContactValidSuccess(parseInt(type), aim);
						}
					}
					catch(e){}
                } else {
                    $("#valid_contact_code").val("");
                    $("#valid_contact_msg").append('<div class="alert alert-error">验证码错误或已无效，请重试。</div>');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
				$("#valid_process_loading").hide();
                $("#valid_content").show();
                $("#valid_contact_msg").empty();
				$("#valid_contact_msg").append('<div class="alert alert-error">确定验证码出错，原因：服务不存在或无响应</div>');
            }
        });
	}
	
	var time_remain;
    function sendActivatecode() {
		if($("#valid_send_code_btn").is(".disabled")) return;
		var aim = $("#valid_contact_type_val").val();
		var type = $("#valid_contact_type").val();
		if(aim == null || $.trim(aim) == ""){
			$("#valid_contact_msg").append('<div class="alert alert-error">请输入' + (type=="0"?'邮箱地址':'手机号码') + '。</div>');
			return;
		}
        $("#valid_content").hide();
        $("#valid_process_loading").show();
        $("#valid_contact_code").val("");

		$("#valid_send_code_btn").addClass("disabled");
		time_remain = 120;
		$("#sending_animal_remain").show();
		animal_sending_timer = window.setInterval(animalSendingBtn, 1000);
		$("#valid_contact_type_val").prop("disabled", true);
        setTimeout(function () {
            $.ajax({
                url: '/account/send_valid_key',
                type: "POST",
                global: false,
				cache: false,
				data: { "type": type, "aim": aim, "token": "12F21816BC2F09B629438C22A2F93595B3E83BD7113C997F85" },
				dataType: $.browser.msie && $.browser.version == '7.0' ? 'text' : null,
                success: function (data) {
					if(data != null && data.AjaxErrStatus != null && data.AjaxErrStatus == 1){
						$("#valid_process_loading").hide();
						$("#valid_content").show();
						$("#valid_contact_msg").empty();
						$("#valid_contact_msg").append('<div class="alert alert-error">发送验证码出错，原因：' +  data.AjaxErrMsg + '</div>');
						$("#valid_contact_type_val").prop("disabled", false);
						time_remain = 0;
						return;
					}

                    $("#valid_process_loading").hide();
                    $("#valid_content").show();
                    $("#valid_contact_msg").empty();
                    if (data != null && data > 0) {
                        if ($("#valid_contact_type").val() == 1) {
                            $("#valid_contact_msg").append('<div class="alert alert-success"><strong>验证码已成功发送到您的手机。</strong>&nbsp;（如您一直没有收到，可点击“发送验证码”按钮重新发送，一日内限发三次）</div>');
                        } else {
                            $("#valid_contact_msg").append('<div class="alert alert-success"><strong>验证码已成功发到您的信箱。</strong>&nbsp;（如您一直没有收到，可点击“发送验证码”按钮重新发送，一日内限发五次）</div>');
                        }
                    } else {
                        $("#valid_contact_msg").append('<div class="alert alert-error">验证码发送出错，请稍候重试。</div>');
						$("#valid_contact_type_val").prop("disabled", false);
						time_remain = 0;
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
					$("#valid_process_loading").hide();
                    $("#valid_content").show();
                    $("#valid_contact_msg").empty();
					$("#valid_contact_msg").append('<div class="alert alert-error">发送验证码出错，原因：服务不存在或无响应</div>');
					$("#valid_contact_type_val").prop("disabled", false);
					time_remain = 0;
                }
            });
        }, 1000);
    }

	function animalSendingBtn() {
		if(time_remain > 0){
			time_remain = time_remain - 1;
			$("#sending_animal_remain").html(time_remain);
		}
		else{
			try{ window.clearInterval(animal_sending_timer); } catch(e){}
			$("#valid_send_code_btn").removeClass("disabled");
			$("#sending_animal_remain").hide();
		}
    }
</script>

 	<div id="dlg_apply_publish_event" class="modal">
		<div class="modal-dialog" style="width:600px;font-size:14px; font-family:微软雅黑;">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(206, 203, 203, 0.56); height: 40px;line-height: 3;">
					<button class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title"  style="line-height:3; text-indent:2em;">您好，请补充使用活动行的推荐人/渠道</h4>
				</div>
				<div class="modal-body" style="max-height:300px;min-height:290px;margin-bottom:5px;padding:20px 40px;">
					<form>
						<div class="form-group">
							<label class="control-label">填写您在【活动行】的“推荐人”，我们会为您提供更多推广支持</label>
							<div class="controls">
								<input type="text" id="hdx_recommended_by" value="" style="width:350px;" 
									placeholder="多人请用逗号分隔" maxlength="30"/>
							</div>
						</div>
						<br/>
						<div class="form-group">
							<input type="hidden" id="other_recchannel_text" value="" />
							<label class="control-label" style="">如无推荐人，填写您了解【活动行】平台的渠道</label>
							<div class="controls" id="hdx_recommended_sels">
								<label style="display:inline-block;width:200px;">
									<input type="checkbox" name="other_recommended_channel" value="朋友推荐"/> 朋友推荐
								</label>
								<label style="display:inline-block;width:200px;">
									<input type="checkbox" name="other_recommended_channel" value="参与活动"/> 参与活动
								</label>
								<label style="display:inline-block;width:200px;">
									<input type="checkbox" name="other_recommended_channel" value="微信（群）"/> 微信（群）
								</label>
								<label style="display:inline-block;width:200px;">
									<input type="checkbox" name="other_recommended_channel" value="微博"/> 微博
								</label>
								<label style="display:inline-block;width:200px;">
									<input type="checkbox" name="other_recommended_channel" value="广告"/> 广告
								</label>
								<label style="display:inline-block;width:200px;">
									<input type="checkbox" name="other_recommended_channel" value="其他"/> 其他
								</label>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-primary" onclick="javascript:submitApplyPublishEvent();return false;"><i class="icon-ok icon-white"></i>确认</a>&nbsp;&nbsp;
					<button type="button" class="btn" data-dismiss="modal"><i class="icon-off"></i>&nbsp;关闭&nbsp;</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function startApplyPublishEvent(){
			startValidUserContact(1, '', false, onValidCreatorPhone);
		}

		function onValidCreatorPhone(type, aim) {
			applyPublishEvent();
		}

		function applyPublishEvent(){
			var appdlg = $('#dlg_apply_publish_event');
			if(appdlg != null && appdlg.length > 0){
				resetChannelCheckboxs();
				$('#dlg_apply_publish_event').modal({show:true, backdrop:'static'});
			}
			else submitApplyPublishEvent();
		}

		function submitApplyPublishEvent(){
			if (invokeApplyPublishEvent != null && typeof (invokeApplyPublishEvent) == 'function') {
				invokeApplyPublishEvent();
			}
		}

		function resetChannelCheckboxs(){
			var channelText = $("#other_recchannel_text").val();
			if(channelText != null && channelText != ""){
				$('#hdx_recommended_sels :checkbox').removeAttr('checked');
				var channelArray = jQuery("input[name='other_recommended_channel']");
				if (channelArray != null && channelArray.length > 0) {
					jQuery(channelArray).each(function (index) {
						var cthis = jQuery(this);
						if (channelText.indexOf(cthis.val()) > -1){
							cthis.prop("checked", true);
							channelText = channelText.replace(cthis.val() + ",", "");
							channelText = channelText.replace(cthis.val(), "");
						}
					});
				}
			}
		}

		function invokeApplyPublishEvent(){
			var appdlg = $('#dlg_apply_publish_event');
			var recnameTxt = "";
			var channelTxt = "";
			if(appdlg != null && appdlg.length > 0){
				recnameTxt = jQuery("#hdx_recommended_by").val();
				var channelChk = jQuery("input[name='other_recommended_channel']:checked");
				if (channelChk != null && channelChk.length > 0) {
					var channelArray = new Array();
					jQuery(channelChk).each(function (index) {
						channelArray.push(jQuery(this).val());
					});
					channelTxt = channelArray.join(",");
				}
				appdlg.modal('hide'); 
			}

			var activityId = $("#activity_id").val();
			$.ajax({
				url: '/myevent/publish',
				type: "POST",
				data: { "id": activityId, "recommended": recnameTxt, "channel": channelTxt},
				success: function (data) {
					if(data != null && data.AjaxErrStatus != null && data.AjaxErrStatus == 1){
						PopupMessage(1, "发布活动出错：" + data.AjaxErrMsg, 3000);
						return;
					}
					if (data != null && data == true) {
						//PopupMessage(0, "您的活动已申请发布，请耐心等待管理员核实资料。", 2000);
						window.location = '/myevent/home?id=' + activityId + '&pub=true';
					} else {
						PopupMessage(1, "发布活动出错，请稍后重试。", 2000);
					}
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
					PopupMessage(1, "发布活动出错：服务不存在或无响应", 2000);
				}
			});
		}
	</script>

<style type="text/css">
    /*客服部分*/
    .qqserver p img{display:inline;margin:-5px 5px 0 0;vertical-align:middle;}
    .scrollsidebar{position:absolute;z-index:999;top:220px;}
    .side_content{width:167px;height:auto;overflow:hidden;float:left;}
    .side_content .side_list{width:167px;overflow:hidden;}
    .show_btn{width:0;height:144px;overflow:hidden;margin-top:50px;float:left;cursor:pointer;}
    .show_btn span{display:none;}
    .close_btn{width:24px;height:24px;cursor:pointer;}
    .side_title,.side_bottom,.close_btn,.show_btn{background:url(http://cdn.huodongxing.com/Content/v2.0/img/qqcontact_sidebar_bg.png) no-repeat;}
    .side_title{height:46px;}
    .side_title{height:46px;}
    .side_bottom{height:8px;}
    .side_center{font-family:Verdana, Geneva, sans-serif;padding:10px 12px 5px 12px;font-size:12px;}
    .close_btn{float:right;display:block;width:19px;height:19px;margin:16px 7px 0 0;_margin:16px 3px 0 0;}
    .close_btn span{display:none;}
    .side_center .qqserver p{text-align:left;padding:6px 0;margin:0;vertical-align:middle;}
    .phoneserver {font-size:14px;text-align:center;}
    .phoneserver p{padding:2px 0;_height:16px;margin:0;color:#666666;}
    .msgserver{border-top:1px dotted #ccc;text-align:center;margin-top:6px;padding:10px 0 3px 0;}
    .msgserver a{background:url(http://cdn.huodongxing.com/Content/v2.0/img/qqcontact_sidebar_bg.png) no-repeat -119px -154px;padding:3px 0 3px 23px;}
    .side_content hr{border-bottom:1px solid #E6E6E6;height:1px;margin:10px 0;clear:both;}

    /* green skin  */
    .side_green .side_title{background-position:-505px 0;}
    .side_green .side_center{background:url(http://cdn.huodongxing.com/Content/v2.0/img/background_green_line.gif) repeat-y center;}
    .side_green .side_bottom{background-position:-505px -60px;}
    .side_green .close_btn{background-position:-44px -45px;}
    .side_green .close_btn:hover{background-position:-65px -45px;}
    .side_green .show_btn{background-position:-187px 0;}
    .side_green .msgserver a{color:#68c40b;}
    .side_green hr{border-bottom:1px solid #edf2e5;}

</style>

<div class="qqserver">
    <div class="qqserver_fold"><div></div></div>
    <div class="qqserver-body">
        <div class="qqserver-header">
            <div></div><span class="qqserver_arrow"></span>
        </div>
        <ul>
        <li>
           <a title="点击这里给我发消息" href="http://wpa.qq.com/msgrd?v=3&uin=2851187336&site=qq&menu=yes" target="_blank">
               <div>客服咨询</div><span>Coco</span>
            </a>
        </li>
        </ul>
        <div class="qqserver-footer">
            <div class="text-primary">
                客服电话 010-83035147
                <br>工作时间 09:00—18:00
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    +function($){
        var $qqServer = $('.qqserver');
        var $qqserverFold = $('.qqserver_fold');
        var $qqserverUnfold = $('.qqserver_arrow');
        var transition;
        function resizeQQserver(){
            $qqServer[document.documentElement.clientWidth < 1240 ? 'hide':'show']();
        }

        $qqserverFold.click(function(){
            $qqserverFold.hide();
            $qqServer.addClass('unfold');
        });
        $qqserverUnfold.click(function(){
            $qqServer.removeClass('unfold');
            transition = $.support.transition
            $qqserverFold.show();

        });

        resizeQQserver();
        $(function(){
            $(window).on('resize',throttle(resizeQQserver))
        })
    }(jQuery)
</script>

		<div class="page-footer">
    <div class="container-lg">
        <ul>
            <li>
                <h4>
                    活动行</h4>
                <ul>
                    <li><a href="http://www.huodongxing.com/about" target="_blank">关于我们</a></li>
                    <!-- <li><a href="http://www.huodongxing.com/intro#intro-4" target="_blank">联系我们</a></li> -->
                    <li><a href="http://www.huodongxing.com/newslist?tag=%E5%AA%92%E4%BD%93%E6%8A%A5%E9%81%93" target="_blank">媒体报道</a></li>
                    <!-- <li><a href="http://www.huodongxing.com/event/9274236812200" target="_blank">职位招聘</a></li> -->
                    <li><a href="http://www.huodongxing.com/app" target="_blank">活动行APP下载</a></li>
                </ul>
            </li>
            <li>
                <h4>
                    主办方服务</h4>
                <ul>
                    <li><a href="http://www.huodongxing.com/zhubanfang" target="_blank">主办方首页</a></li>
                    <li><a href="http://www.huodongxing.com/intro" target="_blank">主办方必读</a></li>
                   <!--  <li><a href="http://www.huodongxing.com/intro#intro-2" target="_blank">费用标准</a></li> -->
					<li><a href="http://www.huodongxing.com/guanjia" target="_blank">验票APP下载</a></li>
                        <li><a href="http://www.huodongxing.com/vip?utm_source=footer&utm_medium=&utm_campaign=footpage" target="_blank">主办方VIP会员</a></li>
                </ul>
            </li>
            
            <li>
                <h4>
                    更多…</h4>
                <ul>
                    <li><a href="http://www.huodongxing.com/topic" target="_blank">专题精选</a></li>
                    <li><a href="http://www.huodongxing.com/calendar" target="_blank">活动日历</a></li>
                    <!-- <li><a href="http://www.huodongxing.com/webapi" target="_blank">开放平台</a></li> -->
                    <li><a href="http://www.huodongxing.com/friendlink" target="_blank">友情链接</a></li>
                    <li><a href="//www.huodongxing.com/logodownload" target="_blank">Logo下载</a></li>
                </ul>
            </li>
            <li>
                    <h4>
                        推广合作</h4>
                    <ul>
                        <li><a href="#promo-modal" target="_blank" data-toggle="modal">新媒体推广</a></li>
                        
                        <li><a href="http://www.huodongxing.com/bbx?utm_source=footer&utm_medium=&utm_campaign=footpage" target="_blank">活动行百宝箱</a></li>
                        <li><a href="#promo-modal" target="_blank" data-toggle="modal">线下活动执行</a></li>
                        <li><a href="//www.huodongxing.com/webapi" target="_blank">API产品合作串接</a></li>
                    </ul>
                </li>
            <li class="divider"></li>
            <!-- <li>
                <h4 style="padding-left: 9px;">
                    关注我们</h4>
                <ul>
                    <li><a  href="http://weibo.com/huodongxing" target="_blank"><span class="weibo"></span>新浪微博</a></li>
                    <li><a href="http://user.qzone.qq.com/1561502454" target="_blank"><span class="qq"></span>QQ空间</a></li>
                    <li><a href="http://zhan.renren.com/huodongxing" target="_blank"><span class="renren"></span>人人小站</a></li>
                    <li><a href="http://www.douban.com/group/507116/" target="_blank"><span class="douban"></span>豆瓣小组</a></li>
                </ul>
                <img src="http://cdn.huodongxing.com/Content/v2.0/img/qr_weibo.png" alt=""/>
                <a href="http://weibo.com/huodongxing" target="_blank"><span class="weibo"></span>新浪微博</a>

            </li> -->
            <li style="margin-left: 30px;margin-right: 25px;">
                <h4>
                    微信扫一扫</h4>
                <img src="http://cdn.huodongxing.com/Content/v2.0/img/qr_normal.png" alt=""/>
                <div style="margin-left: -3px;">ihuodongxing</div></li>
            <li style="width: auto;">
                <h4>活动行APP</h4>
                <img src="http://cdn.huodongxing.com/Content/v2.0/img/app/qr_normal.png" alt=""/>
                <div style="text-indent: 1em">扫码下载</div>
            </li>
        </ul>
    </div>
    <div class="ft">
        <div class="container-lg">
            
                <center>
        地址：北京市西城区新街口外大街28号<i>|</i>
        <!-- 总机：010-62684598<i>|</i> -->
        版权所有：北京艾科创意信息技术有限公司<i>|</i>
        京ICP证150180号<i>|</i>京ICP备12026130号-2<i>|</i>京公网安备11010802017565
            <div>活动行 v3.9.3&nbsp;&copy; huodongxing.com All Rights Reserved. </div>
            </center>
        </div>
    </div>
</div>

<div class="modal fade modal-confirm" id="promo-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">操作提示</h4>
                </div>
                <div class="modal-body">
                    <div style="margin-bottom: 10px;">关注 活动行 微信服务号</div>
                    <img src="http://cdn.huodongxing.com/Content/v2.0/img/qr_normal.png" alt="">
                    <div style="margin: 10px 0;">点击菜单 - 高级 - 推广合作</div>
                    <img src="http://cdn.huodongxing.com/Content/v2.0/img/wechat_promo.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
		<div class="feedback-layer modal fade" id="home_feedback_layer">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">让批评和口水来的更猛烈些吧！</h4>
					</div>
					<div class="modal-body">
						
						<div class="feedback-face"></div>
						<form action="">
							<input class="form-control" type="text" placeholder="请输入您的邮箱/手机号" id="home_suggest_contact" max-length="64" value=""/>
							<textarea placeholder="在这里写下您想说的话。" id="home_suggest_content" max-length="512"></textarea>
							<div class="text-right">
								<button type="button" class="btn btn-link" data-dismiss="modal">取消</button><button type="button" class="btn btn-primary btn-lg" onclick="javascript:submitMySuggestion();">发送</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom_tools" style="display:block;">
	        <div class="qr_tool">
	            二维码
	        </div>
	        <a id="feedback" href="#home_feedback_layer" data-toggle="modal" title="意见反馈">意见反馈</a>
	        <a id="scrollUp" href="#" title="飞回顶部" style="display:none;"></a>
			<img class="qr_img fade hide" src="http://cdn.huodongxing.com/Content/v2.0/img/css/qr_img.png">
	    </div>
		<div class="modal fade" id="pop_message_dlg" style="margin-top:250px;overflow-y:auto;z-index:10000">
			<div class="modal-dialog" style="width:550px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="pop_msg_head"><span class="icon-danger" id="pop_message_icon"></span><span id="pop_message_content"></span></h4>
					</div>
				</div>
			</div>
		</div>

		<div id="jquery_ajax_loading" class="layer-warning modal" style="margin-top:250px;overflow-y:auto;">
			<div class="modal-dialog" style="width:450px;">
				<div class="modal-content">
					<div class="modal-body">
						<p><span class="icon-warning"></span> 页面正在加载中，请耐心等待...</p>
					</div>
					
				</div>
			</div>
		</div>
        <script type="text/javascript" src="http://cdn.huodongxing.com/Content/v2.0/dist/js/libs.min.js?v=v3.9.3"></script>
		
<!--[if !IE]><!-->
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/v2.0/dist/js/FileAPI/FileAPI.min.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/js/jquery.Jcrop.min.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/v2.0/dist/js/FileAPI/posterUpload.min.js"></script>
	<script>
		+function($){
			var $poster = $('#event-create-poster');
		    UploadImage(1080,640,{
			        $element:$poster,
			        before:submitLogoData,
			        success:function(){
			            setTimeout(function(){
			              PopupMessage(0, "活动海报上传成功.", 1500);
			            },1000)
			            $poster.find('.btn-primary span:first').addClass('icon-btn-upload-reload').next().html('重新上传')
			        }
			    });
		}(jQuery)
	</script>
	<!--<![endif]-->
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/v2.0/dist/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/v2.0/dist/js/select-city.min.js"></script>
	<script type="text/javascript" src="http://cdn.huodongxing.com/Content/v2.0/dist/js/create-event.min.js"></script>
	<!--[if lte IE 7]><script type="text/javascript" src="/Content/v2.0/dist/js/jquery-ui-sortable.min.js"></script><![endif]-->
	<script type="text/javascript">
	    $.initProv("#select_province", "#select_city", "", "");
	    $("#select_city").change(function () {
	        if ($("#select_city").val() != "-1") locAddress(false);
	    });

        if($.browser.msie && +$.browser.version < 9){
			$('#event_main_edit_area').find('select').addClass('form-control');
		}
		else{
			$('#event_main_edit_area').find('select').selectpicker();
		}

		function toggleCreateEventArea(){
			$("div[id^='create-event-area-']").toggle();
		}
		var onSuccessSaveEventBase = null;

		function saveAndPreviewEvent() {
		    if ($('[id^="event_create_ticket"]:visible') == null || $('[id^="event_create_ticket"]:visible').length < 1) {
		        PopupMessage(1, "请建立一个票种！", 2000);
		        return;
		    }
			// onSuccessSaveEventBase = function () { 
			// 	window.open('/event/' + $('#activity_id').val());
			// };
			onSuccessSaveEventBase = function() { };
			saveEventBase();
			window.open('/event/' + $('#activity_id').val());
		}

		function saveEventForDraft(){
//		    if ($('[id^="event_create_ticket"]:visible') == null || $('[id^="event_create_ticket"]:visible').length < 1) {
//		        PopupMessage(1, "请建立一个票种！", 2000);
//		        return;
//		    }
			onSuccessSaveEventBase = null;
			saveEventBase();
		}

		function saveAndPublishEvent() {
		    if ($('[id^="event_create_ticket"]:visible') == null || $('[id^="event_create_ticket"]:visible').length < 1) {
		        PopupMessage(1, "请建立一个票种！", 2000);
		        return;
		    }
			onSuccessSaveEventBase = function () { 
				if (startApplyPublishEvent != null && typeof (startApplyPublishEvent) == 'function') {
					startApplyPublishEvent();
				}
			};
			saveEventBase();
		}

		$(function () {
		    $("#bbx-close-btn").click(function () { $("#bbx-entry").hide(); return false; });
		})
	</script>

		<script type="text/javascript">
			function submitMySuggestion(){
				var sContactVal = $("#home_suggest_contact").val();
				var sContentVal = $("#home_suggest_content").val();
				if(sContactVal == '' || sContentVal == '') return;
				$.ajax({
					url: '/suggest',
					type: "POST",
					data: { "contact": sContactVal, "content": sContentVal, "token":"1250ABC781FCBF699123692D2F40D97953B44ECD481982CC2B9B66FD2EB244C67095F1E55FF73BFBE8" },
					success: function (data) {
						window.alert("我们已收到您反馈的意见，感谢对我们的支持。");
						$("#home_feedback_layer").modal("hide");
					}
				});
            }


			+function ($) {
				var $window = $(window);
				var $body = $(document.body);
				var $navBar = $('.hdx-header');
  				var headerHeight = $navBar.outerHeight(true);
				var $subNavBar = $('.sub_nav');
				$body.scrollspy({
					target: '.intro-nav',
					offset: headerHeight + 40
				});
				$window.on('load', function () { $body.scrollspy('refresh'); });

				var $introNav = $('.intro-nav');
				var $bottomTools = $('.bottom_tools');
				var $qrTools = $('.qr_tool');
				var qrImg = $('.qr_img');
				$introNav
					.affix({
					      offset:{
					        bottom:$('.page-footer').outerHeight()
					      }
					    })
					.find('.nav > a').click(function (e) { e.preventDefault(); });

				setTimeout(function () {
					$window.scroll(function () {
						var scrollHeight = $(document).height();
						var scrollTop = $window.scrollTop();
						var $footerHeight = $('.page-footer').outerHeight(true);
						var $windowHeight = $window.innerHeight();
						$window.scrollTop() > 50 ? $("#scrollUp").fadeIn(200) : $("#scrollUp").fadeOut(200);
						$bottomTools.css("bottom", scrollHeight - scrollTop - $footerHeight > $windowHeight ? 20 : $windowHeight + scrollTop + $footerHeight + 20 - scrollHeight);
					});
					$('#scrollUp').click(function (e) {
						e.preventDefault();
						$('html,body').animate({ scrollTop: 0 });
					});
					$qrTools.hover(function(){
				      qrImg.removeClass('hide')
				      $.support.transition ?
				        qrImg
				          .one($.support.transition.end, function(){
				            qrImg.addClass('in')
				          })
				          .emulateTransitionEnd(150) :
				        qrImg.addClass('in')
				    },function(){
				      qrImg.removeClass('in')
				      $.support.transition ?
				        qrImg
				          .one($.support.transition.end, function(){
				            qrImg.addClass('hide')
				          }) :
				        qrImg.addClass('hide')
				    })
				}, 500);
                $('.hdx-header .search').on('click','li a',function(e){
                    e.preventDefault();
                    //var parent= $(this).parent().parent('.dropdown').find('span')[0].innerHTML;
                    //var parent= $(this).parent().parent('.dropdown').find('span')[0].attr("str");
                    var affiliation = $(this).attr("title");
                    var current = $(this).attr("str");
                    if(affiliation != current){
                        $("#searchEventArea").toggle();
                        $("#searchOrgArea").toggle();
                    }
                });
                $("#searchOrgArea button").bind("click", function () {
                    var qs = $("#searchOrgArea input[type='text']").val();
                    if (qs != null && qs != '') {
                        window.location = '/zhubanfang/a?p=1' + encodeURI("&qs=" + qs);
                    }
                });
				$('.aside h2 .more').click(function(e){
				    //e.preventDefault();
				    if ($(this).hasClass('active')) return
				    $(this).addClass('active');
				    setTimeout($.proxy(function(){
				      $(this).removeClass('active')
				    },this),200)
				});
				var $loginToggle = $('.icon-login-toggle');
				  var $iconLogins = $loginToggle.parent();
				  $loginToggle.on('mouseenter',function(){
				    $iconLogins.toggleClass('fold')
				  })
				  $iconLogins.on('mouseleave',function(){
				      $iconLogins.addClass('fold')
				  })
			} (window.jQuery)

			function addFavorite() {
				if (document.all) {
					try {
						window.external.addFavorite(window.location.href, document.title);
					} catch (e) {
						window.alert("对不起，您的浏览器不支持此操作！\n\r请您使用使用Ctrl+D收藏本站");
					}
				} else if (window.sidebar) {
					window.sidebar.addPanel(document.title, window.location.href, "");
				} else {
					window.alert("对不起，您的浏览器不支持此操作！\n\r请您使用使用Ctrl+D收藏本站");
				}
			}
			function forwardEmailLink(email) {
				if (email == null || email == "") return "";
				var emlower = email.toLowerCase();
				var link = "<a target='_blank' href='http://";
				if (emlower.indexOf("@qq.com") > 0 || emlower.indexOf("@163.com") > 0 || emlower.indexOf("@126.com") > 0 || emlower.indexOf("@tom.com") > 0 || emlower.indexOf("@sina.com") > 0 || emlower.indexOf("@yahoo.com") > 0) {
					link += "mail." + emlower.substring(emlower.indexOf("@") + 1);
				}
				else {
					link += "www." + emlower.substring(emlower.indexOf("@") + 1);
				}
				link += "'>前往查收</a>";
				return link;
			}
			function PopupMessage(type, msg, hideTime,backdrop){
				if(msg == null || msg == "" || type < 0) return;
				if(type == 0){
					type = 'icon-success'
				}else if(type == 'warning'){
					type = 'icon-warning'
				}else{
					type = 'icon-danger'
				}
				$("#pop_message_icon").removeClass("icon-danger icon-success icon-warning").addClass(type);
				$("#pop_message_content").html(msg);
                if(msg != null && msg.length <= 25){ $("#pop_msg_head").css("text-align","center"); }
                else{ $("#pop_msg_head").css("text-align","center"); }
				$('#pop_message_dlg').modal({show:true, backdrop:backdrop ? backdrop : false });
				if(hideTime != null && hideTime > 0) window.setTimeout(function () { $('#pop_message_dlg').modal('hide'); }, hideTime);
			}
			function setupScriptDelay(scriptPath, sync, onHead){
				var setupScript = document.createElement("script"); setupScript.type = 'text/javascript';
				if(!sync) setupScript.async = true;
				if(scriptPath.indexOf("http") == 0) setupScript.src = scriptPath;
				else setupScript.src = (("https:" == document.location.protocol) ? "https://" : "http://") + scriptPath;
				if(onHead) document.getElementsByTagName("head")[0].appendChild(setupScript);
				else document.body.appendChild(setupScript);
			}

			function setupGlobalScript(){
				setupScriptDelay("hm.baidu.com/h.js?d89d7d47b4b1b8ff993b37eafb0b49bd", true, true);
				google_analytics_script();
				//alexa_script();
			}
			$(function () {
			    $.ajaxSetup({ timeout: 45000 });
				$(document).ajaxStart(function () {
					var bgfi = $("div.modal-backdrop.in");
					if (bgfi != null && bgfi.length > 0) $('#jquery_ajax_loading').modal({ show: true, backdrop: false, keyboard: false });
					else $('#jquery_ajax_loading').modal({ show: true, backdrop: 'static', keyboard: false });
				}).ajaxSend(function(evt, request, settings) {
				    console.log(settings.url);
				}).ajaxStop(function () {
					$('#jquery_ajax_loading').modal('hide');
					var bgfi = $("div.modal-backdrop.in");
					if (bgfi == null || bgfi.length == 0){ $("body").removeClass("modal-open"); }
				});
				window.setTimeout("setupGlobalScript()", 350);
			});
			//var _bdhmProtocolExternal = (("https:" == document.location.protocol) ? " https://" : " http://");
			//document.write(unescape("%3Cscript src='" + _bdhmProtocolExternal + "hm.baidu.com/h.js%3Fd89d7d47b4b1b8ff993b37eafb0b49bd' type='text/javascript'%3E%3C/script%3E"));
		</script>

			<script type="text/javascript" src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js"></script>
		<script type="text/javascript">
			if(remote_ip_info != null){
				$("input[type=hidden][name='ex_country']").val(remote_ip_info.country);
				$("input[type=hidden][name='ex_province']").val(remote_ip_info.province);
				$("input[type=hidden][name='ex_city']").val(remote_ip_info.city);

				$("input[type=hidden][name='City']").val(remote_ip_info.city);
				$("input[type=hidden][name='Province']").val(remote_ip_info.province);
				$("input[type=hidden][name='Address']").val(remote_ip_info.province + "--" + remote_ip_info.city);

				$("input[type=hidden][name='country']").val(remote_ip_info.country);
				$("input[type=hidden][name='province']").val(remote_ip_info.province);
				$("input[type=hidden][name='city']").val(remote_ip_info.city);
				$("input[type=hidden][name='district']").val(remote_ip_info.district);

				var currentRegion = null;
				if (document.cookie.length > 0) {
					var regionstart = document.cookie.indexOf("HDX_REGION=");
					if (regionstart != -1){
						regionstart = regionstart + "HDX_REGION".length + 1;
						var regionend = document.cookie.indexOf(";", regionstart);
						if (regionend == -1) regionend = document.cookie.length;
						currentRegion = document.cookie.substring(regionstart, regionend);
					}
				}
				if((currentRegion == null || $.trim(currentRegion) == "") && remote_ip_info.city != null && $.trim(remote_ip_info.city) != ""){
					var regionExDate=new Date();
					regionExDate.setDate(regionExDate.getDate() + 365);
					document.cookie = "HDX_REGION=" + escape(remote_ip_info.province + "," + remote_ip_info.city) + ";domain=huodongxing.com;path=/;expires=" + regionExDate.toGMTString();
				}
			}
		</script>

        <!-- Start Alexa Certify Javascript -->
        <script type="text/javascript">
            _atrk_opts = { atrk_acct: "GgKTe1aoiI00WL", domain: "huodongxing.com", dynamic: true };
            function alexa_script() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(as, s); }
        </script>
        <noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=GgKTe1aoiI00WL" style="display:none" height="1" width="1" alt="" /></noscript>
        <!-- End Alexa Certify Javascript -->
        <input type="hidden" value="web01"/>
	</body>
</html>