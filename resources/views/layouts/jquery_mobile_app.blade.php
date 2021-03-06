<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <link rel="stylesheet" href="{{URL::asset('css/sm.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/sm-extend.min.css')}}">
    <style>
        .list-block .item-title.label{
            width:25%;
        }
        .weui_uploader_hd {
            padding-top: 0;
            padding-right: 0;
            padding-left: 0;
        }
        .weui_uploader_hd .weui_cell_ft {
            font-size: 1em;
        }
        .weui_uploader_bd {
            overflow: hidden;
        }
        .weui_uploader_files {
            list-style: none;
        }
        .weui_uploader_file {
            margin-top: .5rem;
            float: left;
            margin-right: 9px;
            margin-bottom: 9px;
            width: 100%;
            height: 160px;
            background: no-repeat center center;
            background-size: cover;
        }
        .weui_uploader_status {
            position: relative;
        }
        .weui_uploader_status:before {
            content: " ";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .weui_uploader_status .weui_uploader_status_content {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            color: #FFFFFF;
        }
        .weui_uploader_status .weui_icon_warn {
            display: block;
        }
        .weui_uploader_input_wrp {
            margin-top: .5rem;
            float: left;
            position: relative;
            margin-right: 9px;
            margin-bottom: 9px;
            width: 100%;
            height: 160px;
            border: 1px solid #D9D9D9;
        }
        .weui_uploader_input_wrp:before,
        .weui_uploader_input_wrp:after {
            content: " ";
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            background-color: #D9D9D9;
        }
        .weui_uploader_input_wrp:before {
            width: 2px;
            height: 39.5px;
        }
        .weui_uploader_input_wrp:after {
            width: 39.5px;
            height: 2px;
        }
        .weui_uploader_input_wrp:active {
            border-color: #999999;
        }
        .weui_uploader_input_wrp:active:before,
        .weui_uploader_input_wrp:active:after {
            background-color: #999999;
        }
        .weui_uploader_input {
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }
        .save{
            margin-right: .9rem;
        }
    </style>
</head>
<body>
@yield("body")
<script type='text/javascript' src="{{URL::asset('js/zepto.min.js')}}" charset='utf-8'></script>
<script type='text/javascript' src="{{URL::asset('js/sm.min.js')}}" charset='utf-8'></script>
<script type='text/javascript' src="{{URL::asset('js/sm-extend.min.js')}}" charset='utf-8'></script>
<script type="text/javascript" src="{{URL::asset('js/sm-city-picker.min.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{{URL::asset('js/jquery-1.8.3.min.js')}}" charset="utf-8"></script>
<script type="text/javascript" src="{{URL::asset('js/ajaxfileupload.js')}}" charset="utf-8"></script>
<script>
    //    $(function() {
    //        $('#test').click(function() {
    //            $.ajax({
    //                url: "/celebrity/6",
    //                method: "PATCH",
    //                data: {sex: 0},
    //                success: function($data) {
    //                    console.log($data);
    //                }
    //            });
    //        });
    //    });
    $j=jQuery.noConflict();

    //上传身份证
    $('#fileupload').change(function(){
        $('#idfile').append('<li class="weui_uploader_file images" style="background-image:url(http://oss-cn-hangzhou.aliyuncs.com/hzfx10000/1458541178099imgFiles.png)">\
                <input type="hidden" id="id_image" name="id_image" value="http://oss-cn-hangzhou.aliyuncs.com/hzfx10000/1458541178099imgFiles.png">\
                </li>');
        $(this).parent('div').hide();
        $.toast("添加成功",1000);
    });

    //上传多图
    $('#imgupload').change(function(){
        $.showPreloader('正在上传...');
        $j.ajaxFileUpload({
            url:"/picture",//需要链接到服务器地址
            secureuri:false,
            fileElementId:"imgupload",//文件选择框的id属性
            dataType: 'json',   //json
            success: function (data, status) {
                var urls = data.urls;
                var $htmls = '';
                for(var i=0; i<urls.length; i++){
                    $htmls += '<li class="weui_uploader_file images" style="width:80px;height:80px;background-image:url('+urls[i]+')">\
                    <input type="hidden" id="manyimg" value="'+urls[i]+'"></li>';
                }
                $('#imgfiles').append($htmls);
                $.hidePreloader();
                $.toast("添加成功", 1000);
            },error:function(data, status, e){
                $.hidePreloader();
                $.toast("添加失败", 1000);
            }
        });
    });

    //验证码页面,倒计时按钮,点击确认事件
    var waittime = 60;
    var countdown = waittime;
    function settime(me) {
        var obj=$(me);
        if (countdown <= 0) {
            obj.css('color','#0894ec');
            obj.text("获取验证码");
            countdown = waittime;
            return ;
        } else {
            obj.css('color','gray');
            obj.text("重新发送(" + countdown + ")");
            countdown--;
        }
        setTimeout(function() {
            settime(obj);
        },1000);
    }
    $('#sendcode').click(function(){
        if(countdown == waittime) {
            $.toast("发送成功",1000);
            settime(this);
        }
    });
    $("#confirmcode").click(function(){
        if(true){
            $.showPreloader('正在验证中...');
            setTimeout(function () {
                $.hidePreloader();
                $.toast("验证成功",1000);
            }, 2000);
            setTimeout(function(){
                document.getElementById("codecfm").click();
            },3000);
        }else{
            $.toast("验证失败,请重新输入!");
        }
    });

    //地区选择器
    $(function () {
        $("#city-picker").cityPicker({
            toolbarTemplate: '<header class="bar bar-nav">\
            <button class="button button-link pull-right close-picker">确定</button>\
            <h1 class="title">地区</h1>\
            </header>'
        });
    });

    //日期选择器
    $("#datetime-picker").calendar({
        value: ['1993-01-01']
    });

    //头像修改页面编辑按钮
    $(document).on('click','.create-actions', function () {
        var buttons1 = [
            {
                text: '从手机相册选择',
                onClick: function() {
                    $.alert("从手机相册选择");
                }
            }
        ];
        var buttons2 = [
            {
                text: '取消'
            }
        ];
        var groups = [buttons1, buttons2];
        $.actions(groups);
    });

    //保存单行内容按钮
    $.set_value = function(va){
        $('#f_'+va).text($('#'+va).val());
    }

    //设置性别
    $.set_sex = function(){
        var text = $("input[name='sex-radio']:checked").val();
        if(text == 'M')
            $('#f_sex').text('男');
        else
            $('#f_sex').text('女');
    }

    //设置三围
    $.set_sanwei = function(v1,v2,v3){
        $('#f_sanwei').text($('#'+v1).val()+'/'+$('#'+v2).val()+'/'+$('#'+v3).val());
    }

    //完成注册
    $('#finish').click(function(){
        var imgdata = [];
        var i = 0;
        $('[id=manyimg]').each(function(){
            imgdata[i] = $(this).val();
            i++;
        });
        $.ajax({
            url: "/celebrity",
            type: "POST",
            traditional: true,
            dataType: "JSON",
            data: {
                "headimg"      : $('#f_wx_headimg').attr('src'),
                "nickname"     : $('#f_nickname').text(),
                "sex"          : $('#f_sex').text() == '男' ? 'M' : 'F',
                "city"         : $('#f_city-picker').text(),
                "bust"         : $('#f_sanwei').text() ? $('#bust').val() : '',
                "waist"        : $('#f_sanwei').text() ? $('#waist').val() : '',
                "hop"          : $('#f_sanwei').text() ? $('#hip').val() : '',
                "weight"       : $('#f_tizhong').text(),
                "height"       : $('#f_shengao').text(),
                "birthday"     : $('#f_datetime-picker').text(),
                "profession"   : $('#f_zhiye').text(),
                "experience"   : $('#jingli').val(),
                "id_name"      : $('#id_name').val(),
                "id_code"      : $('#id_code').val(),
                "id_image"     : $('#id_image').val(),
                "phonenum"     : $('#phonenum').val(),
                "weibo_id"     : $('#weiboid').val(),
                "weibo_fans"   : $('#weibofans').val(),
                "weipai_id"    : $('#weipaiid').val(),
                "weipai_fans"  : $('#weipaifans').val(),
                "miaopai_id"   : $('#miaopaiid').val(),
                "miaopai_fans" : $('#miaopaifans').val(),
                "meipai_id"    : $('#meipaiid').val(),
                "meipai_fans"  : $('#meipaifans').val(),
                "kuaishou_id"  : $('#kuaishouid').val(),
                "kuaishou_fans": $('#kuaishoufans').val(),
                "images[]"       : imgdata
            },
            success: function(data) {
                $.toast("注册成功!",1000);
                setTimeout(function(){
                    location.href="/celebrities/list";
                },1000);
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
</body>
</html>