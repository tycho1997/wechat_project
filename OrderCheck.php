
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>订单查看</title>
    <link rel="stylesheet" type="text/css" href="css/normalize-table.css" />
    <link rel="stylesheet" type="text/css" href="css/htmleaf-demo.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/jquery.restable.min.css">
    <!--[if IE]>
    <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <![endif]-->
</head>
<style>
    table thead {background-color: #bbb;color: #fff;font-weight: 800;}
    table tbody tr td{border-bottom: 1px solid #eee;}
    table tbody tr:hover td{background-color: #eee;color: #494A5F;}

    p{
        text-align: center;
        color: black;
    }
    body{
        background: whitesmoke;
        font-size: 20px;
    }
    a{
        color: dodgerblue;
    }
    #submit
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
    #submit:hover{
        background: #5599FF;
    }
    #BackOrder
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
    #BackOrder:hover{
        background: #5599FF;
    }
    table{
        border-collapse: collapse;
        width: 100%;
        text-align: center;
        color: black;
        font-weight: bolder;
    }
    th{
        width: 12.5%;
    }
</style>
<body>
<p>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" id="table3">
    <tbody>
    <?php
    $hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
    $dbuser = SAE_MYSQL_USER;
    $dbpass = SAE_MYSQL_PASS;
    $dbname = SAE_MYSQL_DB;
    $link = mysqli_connect($hostname, $dbuser, $dbpass);
    if (!$link)
    {
    die('连接不成功: ' . mysqli_error());
    }
    echo '连接成功<br/>';
    //select db
    mysqli_select_db($link,$dbname) or die ('不能使用数据库 ' . mysqli_error());
    echo '查看订单成功<br>';

    if ($_post=['OrderCheck'])//取得订单查询数据
    {

        $mysql = new SaeMysql();
        $name = $_POST['NameCheck'];
        $phone = $_post['PhoneCheck'];
        $sql1 = "select * from `wx_user` where `user_name` = '$_POST[NameCheck]' 
        or `user_phone` = '$_POST[PhoneCheck]'";
        $result1 = $link->query($sql1);//将查询语句以数组方式存储
        $arr1 = $result1->fetch_all();
        if (mysqli_num_rows($result1)<1&&!$_GET['name'])
        {
            echo '<script>alert("无法查询到该数据！");window.location.href="Order.html"</script>';
        }
        else{
            foreach($arr1 as $v)//表格输出数据查询
            {
                //if (empty($arr1)){
                    //echo "<script>alert('数据为空！');window.location.href='Order.html'</script>";}
                //$str  = str_replace($name,"<span style='color:red;'>{$name}</span>",v[0]);
                echo "
                 <script>
                  encodeURI(encodeURI($v[0]));
                 encodeURI(encodeURI($v[1]));
                 encodeURI(encodeURI($v[2]));
                 encodeURI(encodeURI($v[3]));
                 encodeURI(encodeURI($v[4]));
                 encodeURI(encodeURI($v[5]));
                 encodeURI(encodeURI($v[6]));
                 encodeURI(encodeURI($v[7]));
                 </script>
                 <tr style='background-color: #bbb;color: #fff;font-weight: 800;pointer-events: none'>
                 <th>电话</th>
                 <th>地址</th>
                 <th>姓名</th>
                 <th>维修问题</th>
                 </tr>
                 <tr>
                 <td>{$v[0]}</td>
                <td>{$v[1]}</td>
                <td>{$v[2]}</td>
                <td>{$v[3]}</td>
              </tr>
              <tr style='background-color: #bbb;color: #fff;font-weight: 800;pointer-events: none'>
              <th>空调型号</th>
              <th>维修时间</th>
              <th>维修id</th>
              <th>订单修改/删除</th>
              </tr>
              <tr>
                <td>{$v[4]}</td>
                <td>{$v[5]}</td>
                <td>{$v[6]}</td>
                <td><a href='update.html?phone=$v[0]&address=$v[1]&name=$v[2]&problem=$v[3]&type=$v[4]&FixTime=$v[5]&order_id=$v[6]'>修改/</a>
                <a href='delete.php?name=$name'>删除</a></td>
              </tr>";//用超链接传值给update.html
            }
        }


    }

    if ($_GET['name'])//取得enter.php传输数据
    {
        $mysql = new SaeMysql();
        $name = $_GET['name'];
        $sql2 = "select * from `wx_user` where `user_name`='$name'";
        $result2 = $link->query($sql2);
        $arr2 = $result2->fetch_all();

        foreach ($arr2 as $v) {
            //$str  = str_replace($name,"<span style='color:red;'>{$name}</span>",v[0]);
            echo "
                 <script>
                  encodeURI(encodeURI($v[0]));
                 encodeURI(encodeURI($v[1]));
                 encodeURI(encodeURI($v[2]));
                 encodeURI(encodeURI($v[3]));
                 encodeURI(encodeURI($v[4]));
                 encodeURI(encodeURI($v[5]));
                 encodeURI(encodeURI($v[6]));
                 encodeURI(encodeURI($v[7]));
                 </script>
                 <tr style='background-color: #bbb;color: #fff;font-weight: 800;pointer-events: none'>
                 <th>电话</th>
                 <th>地址</th>
                 <th>姓名</th>
                 <th>维修问题</th>
                 </tr>
                 <tr>
                 <td>{$v[0]}</td>
                <td>{$v[1]}</td>
                <td>{$v[2]}</td>
                <td>{$v[3]}</td>
                </tr>
              <tr style='background-color: #bbb;color: #fff;font-weight: 800;pointer-events: none'>
              <th>空调型号</th>
              <th>维修时间</th>
              <th>维修id</th>
              <th>订单修改/删除</th>
              </tr>
                <tr>
                <td>{$v[4]}</td>
                <td>{$v[5]}</td>
                <td>{$v[6]}</td>
                <td><a href='update.html?phone=$v[0]&address=$v[1]&name=$v[2]&problem=$v[3]&type=$v[4]&FixTime=$v[5]&order_id=$v[6]'>修改/</a>
                <a href='delete.php?name=$name'>删除</a></td>
              </tr>";//用超链接传值给update.html
        }
    }

    mysqli_close($link);//关闭数据库连接
    ?>
    </tbody>
</table>
<div style="text-align: center">
    <input type="button" value="返回查看订单界面" onclick="BackOrder()" id="submit">
    <input type="button" value="返回创建订单界面" onclick="BackMainForm()" id="BackOrder" name="BackOrder">
</div>
</p>
<script>
    function BackOrder() {
        window.location.href="Order.html";//跳转订单查询页面
    }
    function BackMainForm() {
        window.location.href="mainform.html"
    }
</script>

</body>
</html>