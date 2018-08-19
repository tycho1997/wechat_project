<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport">
    <title>Title</title>
</head>
<style>
    p{
        text-align: center;
    }
</style>
<body>
<p>

<?php

if(empty($_GET['name']))
{
    echo "<script>alert('无法取得数据！');window.location.href='Order.html'</script>";

}
$hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
$dbuser = SAE_MYSQL_USER;
$dbpass = SAE_MYSQL_PASS;
$dbname = SAE_MYSQL_DB;
$link = mysqli_connect($hostname, $dbuser, $dbpass);

//select db
mysqli_select_db($link,$dbname) or die ('无法选取数据库！<br>' . mysqli_error());

$name = $_GET['name'];

$sql = "delete from `wx_user` where `user_name` = '$name'";
//echo $sql;
$rs = mysqli_query($link,$sql);
if ($rs){
    echo '<br><script>alert("数据删除成功！");window.location.href="mainform.html"</script>';
}
else{
    echo '<br>数据未能删除！';
}
mysqli_close($link);
?>

</p>
</body>
</html>
