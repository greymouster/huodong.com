<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>天道活动管理平台</title>
    <link rel="stylesheet" href="/Public/Admin/css/style.css">
    <script src="/Public/Admin/js/jquery-1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
    <script src="/Public/Admin/js/layer/extend/layer.ext.js"></script>
    <script src="/Public/Admin/js/jquery.cookie.js"></script>
    <script src="/Public/Admin/js/ancement.js"></script>
    </style>
</head>
<body>

<script src="/Public/Admin/Plugins/jqueryform/jquery.form.js"></script>
    <div class="publish-act" style="margin-left:-150px;">
        <h3>发布新活动</h3>
        <a href="publish-act.html">发布新活动</a>>><a href="act-set.html">报名表单设置</a>
        <div class="act-info act-set">
            <div class="top">
                <div class="one">
                    <p>1.填写信息</p>
                    <img src="/Public/Admin/images/u50.png" />
                </div>
                <div class="line"></div>
                <div class="one">
                    <p class="active">2.报名表单设置</p>
                    <img src="/Public/Admin/images/u50.png" />
                </div>
            </div>
            
              <form action="" id="setFormData" method="POST" >	
            <div class="form-set">
                <p class="title">报名表单设置</p>
                <div class="set-left">
                    <p style="color:red; border-bottom: 1px gray solid;margin:10px 0 10px 10px;text-indent: 30px;height:40px;">用户基础信息(此处全部是必填项)</p>
<!--                    <h1>预览样式</h1>
                    <a href="use-form.html" class="operation">启用表单模板</a>-->
                        <input type="hidden" name="activityId" value="<?php echo ($_GET['act_id']); ?>" />
<!--                        <input type="hidden" name="version" value="1" />-->
                        <input type="hidden" id="template_form_sort_max" name="sortmax" value="0" />
                    <div class="required" style="border-bottom:1px solid gray;margin-bottom: 10px;">
                        <dl>
                            <dt>姓名<span>*</span></dt>
                            <dd><input type="text" name="user_name" placeholder="请输入报名人姓名" disabled="disabled"/> </dd>
                        </dl>
                        <dl>
                            <dt>手机<span>*</span></dt>
                            <dd><input type="text" name="user_phone" placeholder="请输入报名人手机号" disabled="disabled"/></dd>
                        </dl>
                        <dl>
                            <dt>邮箱<span>*</span></dt>
                            <dd><input type="text" name="user_mail" placeholder="请输入报名人邮箱"  disabled="disabled"/></dd>
                        </dl>
                    </div>
                    <div class="usual-form"></div>
                    <div class="set-bottom">
                        <button type="button" class="submit set-form-submit" value="保存" />保存</button>
                </from>
                        <!--<input type="submit" class="moudle" value="保存为表单模板" />-->
                        <a class="btn look" href="javascript:;"><button type="button">预览</button></a>
                    </div>
                    <div class="set-bottom">
                        <a class="btn  act_push" href="javascript:;" data-id="<?php echo ($_GET['act_id']); ?>"><button type="button">发布活动</button></a>
                        <!--<a class="btn act_push_tuiguang" href="<?php echo U('Activity/actPromotion',array('act_id'=>I('get.act_id')));?>"><button type="button">发布并推广</button></a>-->
                        <a class="btn act_push_tuiguang" href="javascript:;" data-id="<?php echo ($_GET['act_id']); ?>"><button type="button">发布并推广</button></a>
                    </div>
<!--                    <div class="moudle-box">
                        <input type="text" placeholder="请输入表单模板名称">
                        <button type="submit">保存</button>
                    </div>-->
                </div>
                <div class="set-right">
                    <ul class="menu">
                        <li class="active">添加字段</li>
                    </ul>
                    <ul class="content">
                        <li>
                            <h2>自定义报名表单</h2>
                            <div class="usual usual-fo">
                                <p>常用表单</p>
                                <span class="input" onclick="javascript:addEventFormCommonItem(0);return false;">城市</span>
                                <span class="input" onclick="javascript:addEventFormCommonItem(1);return false;">QQ</span>
                                <span class="input" onclick="javascript:addEventFormCommonItem(2);return false;">微信</span>
                            </div>
                            <div class="usual diy">
                                <p>自定义</p>
                                <span class="input" onclick="javascript:addEventFormEmptyItem(0);;return false;">单行文本框</span>
                                <span class="area" onclick="javascript:addEventFormEmptyItem(1);;return false;">多行文本框</span>
                                <span class="sin-radio" onclick="javascript:addEventFormEmptyItem(2);;return false;">单选按钮组</span>
                                <span class="more-chack" onclick="javascript:addEventFormEmptyItem(3);;return false;">多选按钮组</span>
                                <span class="selects" onclick="javascript:addEventFormEmptyItem(4);;return false;">下拉框</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
<div id="dlg-review-event-form" class="modal">
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button">×</button>
                <h3 class="modal-title">预览活动表单</h3>
            </div>
            <div class="modal-body">
                <form>
                    <div class="page-header">
                        <span class="label label-warning header_label">联系方式</span>
                        <div class="page-header-line"></div>
                    </div>
                    <div class="contact" style="padding-left:30px;">
                        <div class="control-group">
                            <label class="control-label" style="font-weight:bold;">姓名</label>
                            <div class="controls">
                                <input class="required disabled input-xlarge" disabled="disabled" type="text">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" style="font-weight:bold;">手机号码</label>
                            <div class="controls">
                                <input class="required disabled input-xlarge" disabled="disabled" type="text">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" style="font-weight:bold;">电子邮箱</label>
                            <div class="controls">
                                <input class="required disabled input-xlarge" disabled="disabled" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="page-header">
                        <span class="label label-warning header_label">其他</span>
                        <div class="page-header-line"></div>
                    </div>
                    <fieldset id="event_template_form_fields" style="padding-left:30px;">

                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-create-default" data-dismiss="modal"><i class="icon-off"></i>关闭</a>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(function(){
       
        /*弹框,js里面有event.stopPropagation()要给函数传入参数，兼容火狐*/
        $('.form-set .set-left .set-bottom input.moudle').click(function(event){
            $(this).parent().parent().find('.moudle-box').show();
            event.stopPropagation();
        })
        $('.form-set .set-left .moudle-box').click(function(event){
            $(this).show();
            event.stopPropagation();
        })
        $(document).click(function(){
            $('.form-set .set-left .moudle-box').hide();
        })
		
    })
    //先将input框的值保存起来
    var formCommonItems = [{
              "Key":"I_-1",
              "Sort":-1,
              "Type":"input",
              "Category":"FIELD_COMPANY",
              "IsDefault":false,
              "Required":false,
              "Multiple":false,
              "Title":"城市",
              "Subitems":[],
              "Description":null,
              "IsHide":false,
              "Value":null,
              "TypeTitle":"单行文本框"
          },{
              "Key":"I_-1",
              "Sort":-1,
              "Type":"input",
              "Category":"FIELD_COMPANY",
              "IsDefault":false,
              "Required":false,
              "Multiple":false,
              "Title":"QQ",
              "Subitems":[],
              "Description":null,
              "IsHide":false,
              "Value":null,
              "TypeTitle":"单行文本框"
          },{
              "Key":"I_-1",
              "Sort":-1,
              "Type":"input",
              "Category":"FIELD_COMPANY",
              "IsDefault":false,
              "Required":false,
              "Multiple":false,
              "Title":"微信",
              "Subitems":[],
              "Description":null,
              "IsHide":false,
              "Value":null,
              "TypeTitle":"单行文本框"
          }];
		  
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
            },{
                "Key":"I_0",
                "Sort":0,
                "Type":"textarea",
                "Category":"CUSTOM",
                "IsDefault":false,
                "Required":false,
                "Multiple":false,
                "Title":"",
                "Subitems":[],
                "Description":null,
                "IsHide":false,
                "Value":null,
                "TypeTitle":"多行文本框"
            },
            {
            "Key":"I_0",
            "Sort":0,
            "Type":"radio",
            "Category":"CUSTOM",
            "IsDefault":false,
            "Required":false,
            "Multiple":false,
            "Title":"",
            "Subitems":[],
            "Description":null,
            "IsHide":false,
            "Value":null,
            "TypeTitle":"单选按钮框"
            },{
            "Key":"I_0",
            "Sort":0,
            "Type":"checkbox",
            "Category":"CUSTOM",
            "IsDefault":false,
            "Required":false,
            "Multiple":false,
            "Title":"",
            "Subitems":[],
            "Description":null,
            "IsHide":false,
            "Value":null,
            "TypeTitle":"多选按钮框"
            },{
              "Key":"I_0",
              "Sort":0,
              "Type":"select",
              "Category":"CUSTOM",
              "IsDefault":false,
              "Required":false,
              "Multiple":false,
              "Title":"",
              "Subitems":[],
              "Description":null,
              "IsHide":false,
              "Value":null,
              "TypeTitle":"下拉选择框"
            }]
      //定义存储formItemsJosn的数组
        var formItemsJson = new Array();
        //点击城市,微信,QQ的事件
    function addEventFormCommonItem(index){
       //index 为0-2 
       //判断定义好的json数组
       if(formCommonItems !=null && formCommonItems.length>0 && index>=0){
           //获取json中的数组值
            var commonItem = formCommonItems[index];
            if(commonItem !=null){
                formItemsJson.push(createTemplateFormItem(commonItem));
                renderEventFormTemplate();
            }
       }
    }
    //重新赋值
    function createTemplateFormItem(item){
        if(item == null) {
            return null;
        }
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
                for(var i = 0; i<item.Subitems.length; i++){
                    result.Subitems.push(item.Subitems[i]);
                }
        }
        $("#template_form_sort_max").val(sortTmp);
        return result;
    }
    //添加form表单
    function renderEventFormTemplate(){
        var itemsHtml = "";
        if(formItemsJson != null && formItemsJson.length > 0){
            for(i=0;i<formItemsJson.length;i++){
                var tmpItem = formItemsJson[i];
                var title= tmpItem.Title == "" ? tmpItem.TypeTitle : tmpItem.Title
                itemsHtml = "";
                itemsHtml += '<dl id="efi_'+i+'">';
                itemsHtml += '<input type="hidden" name="items' + i + '[Type]" value="' + tmpItem.Type + '" />';
                itemsHtml += '<input type="hidden" name="items' + i + '[Sort]" value="' + tmpItem.Sort + '" />';
//                itemsHtml += '<input type="hidden" name="items' + i + '[Category]" value="' + tmpItem.Category + '" />';
//                itemsHtml += '<input type="hidden" name="items' + i + '[Multiple]" value="' + tmpItem.Multiple + '" />';
//                itemsHtml += '<input type="hidden" name="items' + i + '[IsHide]" value="' + tmpItem.IsHide + '" />';
                itemsHtml += '<dt><input type="checkbox" name="items' + i + '[Required]" value="true" ' + (tmpItem.Required ? 'checked="checked"' : '') + ' onchange="javascript:onChangeFormItemValue(0, this, ' + i + ', 0);">必填</dt>';
                itemsHtml += '<dd class="name-input"><input title="' + title + '" placeholder="' + title + '" name="items' + i + '[Title]" value="' + (tmpItem.Title == null ? "" : tmpItem.Title.replace("\"", "\\\"").replace("\n", " ")) + '" onchange="javascript:onChangeFormItemValue(1, this, ' + i + ', 0);"></dd>';
                itemsHtml += '<dd class="info"><input type="text" name="items' + i + '[Description]" class="form-control" value="' + (tmpItem.Description == null ? "" : tmpItem.Description.replace("\"", "\\\"").replace("\n", " ")) + '" onchange="javascript:onChangeFormItemValue(2, this, ' + i + ', 0);" placeholder="提示信息写在这里！"/></dd>';
                itemsHtml += '<dd class="remove"><img src="/Public/Admin/images/u39.jpg" onclick="javascript:removeEventFormItem(' + i + ',this);return false;"></dd>';
                if (tmpItem.Type == "radio" || tmpItem.Type == "checkbox" || tmpItem.Type == "select") {
                        itemsHtml += '<div class="add">';
                        itemsHtml += renderEventFormItemValues(i, tmpItem);
                        itemsHtml += '</div></dl>';
                    }
                }

                $(".form-set .set-left .usual-form").append(itemsHtml);
            }
        }
     
        function onChangeFormItemValue(type, itemObj, index, subIndex) {
            if (formItemsJson != null && formItemsJson.length > index && index >= 0) {
                var eleItem = $(itemObj);
                if (type == 0)formItemsJson[index].Required = eleItem.prop("checked"); //必填项    
                else if (type == 1)formItemsJson[index].Title = eleItem.val();
	        else if (type == 2) formItemsJson[index].Description = eleItem.val();
                else if (type == 3) {
                    if (formItemsJson[index].Subitems != null && formItemsJson[index].Subitems.length > subIndex && subIndex >= 0) {
                        formItemsJson[index].Subitems[subIndex] = eleItem.val();
                    }
                }
            }
        }
//移除
        function removeEventFormItem(index, _this) {
            if (formItemsJson != null && formItemsJson.length > index && index >= 0) {
                formItemsJson.splice(index, 1);
            }
            $(_this).parents('dl').remove();
            formItemsJsonTemp = formItemsJson.slice()

        }
//添加自定义的节点
        function addEventFormEmptyItem(index) {
            if (formEmptyItems != null && formEmptyItems.length > index && index >= 0) {
                var emptyItem = formEmptyItems[index];
                if (emptyItem != null) {
                    formItemsJson.push(createTemplateFormItem(emptyItem));
                    renderEventFormTemplate();
                }
                formItemsJsonTemp = formItemsJson.slice();
            }
        }

//添加文本框及图片
        function renderEventFormItemValues(i, tmpItem) {
            itemsHtml = ''
            itemsHtml += '<p>选项列表<img class="img-ad" src="/Public/Admin/images/add.png" onclick="javascript:addEventFormNode(' + i + ',this);return false;"/></p>'
            if (tmpItem.Subitems != null && tmpItem.Subitems.length > 0) {
                for (var j = 0; j < tmpItem.Subitems.length; j++) {
                    itemsHtml += '<span><input type="text" name="items' + i + '[Subitems][' + j + ']" value="' + (tmpItem.Subitems[j] == null ? "" : tmpItem.Subitems[j].replace("\"", "\\\"").replace("\n", " ")) + '" onchange = "javascript:onChangeFormItemValue(3, this, ' + i + ', ' + j + ');" >';
                    itemsHtml += '<img class="img-de" src="/Public/Admin/images/delete.png" onclick="javascript:removeEventFormItemValue(' + i + ',' + j + ');"> </span>';
                }
            }
            return itemsHtml;
        }
//点击图片添加node节点
        function addEventFormNode(index,_this) {
            if (formItemsJson != null && formItemsJson.length > index && index >= 0) {
                if (formItemsJson[index].Subitems == null)
                    formItemsJson[index].Subitems = new Array();
                formItemsJson[index].Subitems.push("");
                var efis = $(_this).parent().parent();
                if (efis != null) {
                    efis.empty();
                    efis.append(renderEventFormItemValues(index, formItemsJson[index]));
                }
            }
        }
//删除
        function removeEventFormItemValue(index, subIndex) {
            if (formItemsJson != null && formItemsJson.length > index && index >= 0 && subIndex >= 0) {
                var tmpItem = formItemsJson[index];
                if (tmpItem.Subitems != null && tmpItem.Subitems.length > subIndex) {
                    formItemsJson[index].Subitems.splice(subIndex, 1);
                    var efis = $('.form-set .set-left dl .add p .img-ad').parent().parent();
                    if (efis != null) {
                        efis.empty();
                        efis.append(renderEventFormItemValues(index, formItemsJson[index]));
                    }
                }
            }
        }
</script>
<script>



</script>
<script src="/Public/Admin/js/form-set.js"></script>

</html>