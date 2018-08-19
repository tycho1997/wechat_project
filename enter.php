<?php
session_start();//开启SESSION
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta content="IE=edge">
        <link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <!-- 导航插件 -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,600,700">
        <link rel="stylesheet" type="text/css" href="css/htmleaf-demonav.css"><!--演示页面样式，使用时可以不引用-->
        <link rel="stylesheet" href="css/demonav.css">
        <link rel="stylesheet" type="text/css" href="fonts/iconfont.css">
    <title>Title</title>
</head>
<style>
    p{
        text-align: center;
    }
    #button
    {
        -webkit-appearance: none;
        /* 按钮美化 */
        width: 220px; /* 宽度 */
        height: 40px; /* 高度 */
        border-width: 0px; /* 边框宽度 */
        border-radius: 20px; /* 边框半径 */
        background: #1E90FF; /* 背景颜色 */
        cursor: pointer; /* 鼠标移入按钮范围时出现手势 */
        outline: none; /* 不显示轮廓线 */
        font-family: Microsoft YaHei; /* 设置字体 */
        color: white; /* 字体颜色 */
        font-size: 17px; /* 字体大小 */
    }
    #button:hover{
        background: #5599FF;
    }
    #check{
       text-decoration: none;
        color: aliceblue;
        font-size: 1.8em;
    }
    #check:hover{
        background: #5599FF;
    }
</style>
<body>
<div class="htmleaf-container">

    <div id="container">

        <header>

            <div class="wrapper cf">

                <nav id="main-nav">

                    <ul class="first-nav">
                        <li class="credits"><a href="mainform.html">创建订单</a></li>
                        <li class="cryptocurrency">
                            <a href="Order.html" target="_blank">查看订单</a>
                        </li>
                    </ul>

                    <ul class="second-nav">
                        <li class="magazines">
                            <a href="about.html">关于我们</a>
                        </li>
                        <li class="store">
                            <a href="./About-2/contact.html#contact">门店地址</a>
                        </li>
                        <li class="collections"><a href="./About-2/services.html#services">服务展示</a></li>

                    </ul>

                </nav>

                <a class="toggle">
                    <span></span>
                    导航
                </a>

            </div>

        </header>

        <main>

            <div class="wrapper">

                <div class="content">
                    <p style="text-align: center">
                    <?php

                    $hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
                    $dbuser = SAE_MYSQL_USER;
                    $dbpass = SAE_MYSQL_PASS;
                    $dbname = SAE_MYSQL_DB;
                    $link = mysqli_connect($hostname, $dbuser, $dbpass);
                    if (!$link) {
                        die('连接不成功: ' . mysqli_error());
                    }
                    echo '连接成功！<br>';
                    //select db
                    mysqli_select_db($link,$dbname) or die ('不能使用数据库 ' . mysqli_error());
                    echo '选取数据库成功<br>';


                    if ($_post=['submit']) {
                        $order_id = isset($_SESSION["temp_num"]) ? $_SESSION["temp_num"] + 1 : 1;
                        //检测是否存在SESSION，若存在，则将变量的值设为在该SESSION上加一，否则则初始化为1
                        $_SESSION["temp_num"] = $order_id ;

                        $mysql = new SaeMysql();
                        $name  = $_POST['who'];
                        $sql = "insert into `wx_user` 
                        values('$_POST[phone]','$_POST[address]','$_POST[who]','$_POST[problem]',
                        '$_POST[type]','$_POST[demo_datetime]','$order_id')";//数据插入

                        $mysql->runSql($sql);

                        if ($mysql->errno() != 0) {
                            die("生成订单错误！<br>" . $mysql->errmsg());
                        } else {
                            echo "订单生成!<br/>";
                            echo "<br><a href='OrderCheck.php?name=$name' id='check' name='check'>点击查看订单</a>";
                        }
                    }
                    mysqli_close($link);
                    ?>
                    <div style="text-align: center">
                        <input type="button" value="点击查询订单" onclick="OrderSkip()" id="button" name="button">
                    </div>
                    </p>
                </div>

            </div>

        </main>

        <footer>

            <div class="wrapper">

                <a href="http://2.tycho1997.applinzi.com/About.html" target="_blank" class="swm" title="Some Web Media">
                    <svg xmlns="http://www.w3.org/2000/svg" height="17" viewBox="0 0 430.24 46">
                        <defs><style>.l-1{fill:#4fb5e1;}.l-1,.l-2,.l-3{fill-rule:evenodd;}.l-2{fill:#f2c053;}.l-3{fill:#a7ce38;}</style></defs>
                        <path id="s" class="l-1" d="M0,46H44L92,0H48Z" transform="translate(0 0)"/>
                        <path id="w" class="l-2" d="M237.24,46h-44l-26-24.92L141.24,46h-44l-24-23,22-21.08,24,23L145.24,0h44l26,24.92L241.24,0h44Z" transform="translate(0 0)"/>
                        <path id="m" class="l-3" d="M386.24,46l-26-24.92L334.24,46h-44l-24-23,22-21.08,24,23L338.24,0h44l48,46h-44Z" transform="translate(0 0)"/>
                    </svg>
                </a>
            </div>
        </footer>
    </div>

    </footer>
</div>
<script>
    function OrderSkip() {
        window.location.href="Order.html"
    }
</script>
<!-- 导航栏js代码 -->
<script src="js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="dist/hc-mobile-nav.js"></script>
<script>
    (function($) {
        var $nav = $('#main-nav');
        var $toggle = $('.toggle');
        var defaultData = {
            maxWidth: false,
            customToggle: $toggle,
            navTitle: 'All Categories',
            levelTitles: true
        };

        // we'll store our temp stuff here
        var $clone = null;
        var data = {};

        // calling like this only for demo purposes

        const initNav = function(conf) {
            if ($clone) {
                // clear previous instance
                $clone.remove();
            }

            // remove old toggle click event
            $toggle.off('click');

            // make new copy
            $clone = $nav.clone();

            // remember data
            $.extend(data, conf)

            // call the plugin
            $clone.hcMobileNav($.extend({}, defaultData, data));
        }

        // run first demo
        initNav({});

        $('.actions').find('a').on('click', function(e) {
            e.preventDefault();

            var $this = $(this).addClass('active');
            var $siblings = $this.parent().siblings().children('a').removeClass('active');

            initNav(eval('(' + $this.data('demo') + ')'));
        });
    })(jQuery);
</script>
</body>
</html>