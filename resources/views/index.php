
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>网红合作商家报名</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="http://y.wcc.cn/statics/amazeui/css/amazeui.min.css">
    <link rel="stylesheet" href="http://weui.github.io/weui/weui.css">
    <link rel="stylesheet" href="http://y.wcc.cn/statics/amazeui/css/app.css?v=2016030801">
    <link rel="stylesheet" href="http://y.wcc.cn/statics/amazeui/css/admin.css">

    <script src="http://y.wcc.cn/statics/amazeui/js/jquery.min.js"></script>
    <script src="http://y.wcc.cn/statics/amazeui/js/handlebars.min.js"></script>
    <script src="http://y.wcc.cn/statics/amazeui/js/amazeui.widgets.helper.js"></script>
</head>
<body>
<header data-am-widget="header" class="am-header am-header-default" style="background-color: #DD514C">
    <div class="am-header-left am-header-nav">
        <a href="#">
            <span class="am-header-nav-title" style="margin-right: 5px">返回</span>
        </a>
    </div>
    <h1 class="am-header-title" style="margin: 0px">
        网红合作商家报名
    </h1>
</header>

<div class="am-intro-default am-padding-sm">
    <blockquote>
        <p>我们目前正在运营一个由薛蛮子和徐小平投资了2千万的国内最大的网红项目，旗下有5万多优质网红，以视频互动的红人，微信微博的大咖，
            以及知名的影视名星为主，我们正在寻找品牌营销的合作以及供应链产品的合作，目前茵曼，裂帛，骆驼等都已经参与到这个体系中来，淘宝， 京东， 聚美等平台也都已经参与战略合作。欢迎您报名参加！请加飞电微信
            13067923360
        </p>
    </blockquote>
        <span class="am-intro-title">
        </span>
</div>
<div class="am-g">
    <div class="am-u-sm-12 am-padding-top-lg">
        <a href="factory.php" class="am-btn am-btn-primary am-btn-block am-round">我有工厂</a>
    </div>
    <div class="am-u-sm-12 am-padding-top-lg">
        <a href="brand.php" class="am-btn am-btn-success am-btn-block am-round">我是品牌商</a>
    </div>
    <div class="am-u-sm-12 am-padding-top-lg">
        <a href="designer.php" class="am-btn am-btn-danger am-btn-block am-round">我是设计师</a>
    </div>
</div>
<div class="qrcode am-g am-text-center am-padding-top">
    <div class="am-u-sm-12">
        <div class="am-thumbnail">
            <img src="http://y.wcc.cn/statics/img/fdcode.jpg">

            <p>负责人飞电微信</p>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<script>
    wx.config({"debug":false,"appId":"wx024e9c8cc8941ef3","timestamp":"1460006957","nonceStr":"f963154e-1bd2-4813-a44f-f45b80a322ed","signature":"63444f4eafda096789180475e6af8a7d6ef4bc77","jsApiList":["onMenuShareTimeline","onMenuShareAppMessage"]});

    wx.ready(function () {
        wx.onMenuShareAppMessage({
            title : "网红合作商家报名",
            desc : "我们目前正在运营一个由薛蛮子和徐小平投资了2千万的国内最大的网红项目，旗下有5万多优质网红...",
            link : "http://y.wcc.cn/apply/index.htm",
            imgUrl : "http://y.wcc.cn/statics/img/fdcode.jpg",
            success : function(res) {
                // 分享成功
            },
            cancel : function(res) {
                //分享取消
            }
        });

        wx.onMenuShareTimeline({
            title : "网红合作商家报名",
            link : "http://y.wcc.cn/apply/index.htm",
            imgUrl : "http://y.wcc.cn/statics/img/fdcode.jpg",
            success : function(res) {
                // 分享成功
            },
            cancel : function(res) {
                //分享取消
            }
        });
    })

    wx.error(function (res) {
        //alert(res.errMsg);
    });

</script>


<script src="http://y.wcc.cn/statics/amazeui/js/amazeui.min.js"></script>
</body>
</html>