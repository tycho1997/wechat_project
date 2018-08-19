<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1">
</head>
<style>
    p
    {
        text-align: center;
    }
    form{
        text-align: center;
    }

</style>
<body>
<p>

    <?php
    $hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
    $dbuser = SAE_MYSQL_USER;
    $dbpass = SAE_MYSQL_PASS;
    $dbname = SAE_MYSQL_DB;
    $link = mysqli_connect($hostname, $dbuser, $dbpass);
    if (!$link) {
        die('连接不成功: ' . mysqli_error());
    }
    echo '连接成功<br/>';
    //select db
    mysqli_select_db($link,$dbname) or die ('不能使用数据库 ' . mysqli_error());
    echo '选取数据库成功<br>';


    if($_POST['submit'])
    {
        $Phone = $_POST['user_phone'];
        $Address = $_POST['user_address'];
        $Name = $_POST['user_name'];
        $Problem = $_POST['user_problem'];
        $Type = $_POST['user_type'];
        $FixTime = $_POST['demo_datetime'];
        $sql = "UPDATE `wx_user` set `user_phone`='$Phone',`user_address`='$Address'
        ,`user_name`='$Name',`machine_problem`='$Problem',`machine_type`='$Type',`fixtime`='$FixTime'";
        $rs = $link->query($sql);
        if ($rs) {
            echo '<br><script>alert("数据更新成功！");window.location.href="Order.html"</script><br>';
        } else {
            echo '<br>数据未能更新！';
        }
    }
    mysqli_close($link);
    ?>


</p>
</body>

</html>
