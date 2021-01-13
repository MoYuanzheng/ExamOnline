<?php
    include('./conn.php');

    $username=$_POST['username'];
    $pwd=$_POST['pwd'];
    $realname = $_POST['realname'];
    $kind = $_POST['kind'];
    $collage = $_POST['collage'];
    $profession = $_POST['profession'];

    $url = 'register.html';
    if(!$username || !$realname || !$kind || !$collage || !$profession || !$pwd)  {
      echo "<script>alert('所有信息必填！请重新填写');window.history.back();</script>";
    }

    $insert="insert into user (username,pwd,realname,kind,collage,profession) values ('$username','$pwd','$realname','$kind','$collage','$profession');";//用户表
    $result = mysqli_query($conn,$insert);

    if ($result) {
      echo "<script>alert('注册成功！欢迎');window.history.back();</script>";
    }
    else{
      echo "<script>alert('注册信息有误！重新填写');window.history.back();</script>";
    }
?>