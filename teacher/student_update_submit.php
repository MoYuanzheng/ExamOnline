<?php
include('../conn.php');

$username = $_POST['username'];
$pwd = $_POST['pwd'];
$realname = $_POST['realname'];
$kind = $_POST['kind'];
$collage = $_POST['collage'];
$profession = $_POST['profession'];

$sql = " UPDATE user SET pwd = '$pwd', realname = '$realname',collage = '$collage',profession = '$profession'  WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('修改成功！');window.history.back();</script>";
} else {
    echo "<script>alert('修改信息有误！重新填写');window.history.back()</script>";
}
?>