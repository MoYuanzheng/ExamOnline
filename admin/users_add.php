<?php
include('../conn.php');
include('POST.php');

$url = "users_add.html";

if (!$username || !$realname || !$kind || !$collage || !$profession || !$pwd) {
    echo "<script>alert('所有信息必填！请重新填写');window.location.href='$url';</script>";
}

$insert = "insert into user (username,pwd,realname,kind,collage,profession) values ('$username','$pwd','$realname','$kind','$collage','$profession');";//题库表
$result = mysqli_query($conn, $insert);

if ($result) {
    echo "<script>alert('添加成功！');window.location.href='$url';</script>";
} else {
    echo "<script>alert('添加信息有误！重新填写');window.location.href='$url';</script>";
}
