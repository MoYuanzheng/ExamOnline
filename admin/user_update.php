<?php
include('../conn.php');
include('POST.php');
$url = "users_show.php";//成功
$sql = "UPDATE user SET 
            pwd = '$pwd', 
            realname = '$realname',
            collage = '$collage',
            profession = '$profession', 
            kind = '$kind'  
        WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('修改成功！');window.location.href='$url';</script>";
} else {
    echo "<script>alert('修改信息有误！重新填写');window.location.href='$url';</script>";
}