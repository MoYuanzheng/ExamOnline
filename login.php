<?php
  session_start();  
  date_default_timezone_set("PRC");
  include('./conn.php');

  $username=$_POST['username'];
  $pwd=$_POST['pwd'];
  
  $url_1="admin/admin.php";//管理员界面
  $url_2="teacher/teacher.php";//教师界面
  $url_3="student/student.php";//学生界面
  $url_4="index.html";//失败界面

  $sql="select * from user where username='{$username}' and pwd='{$pwd}';";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);

  $kind = $row['kind'];
  if ($row) {
      setcookie('username',$username,time()+10,'/');  
      $_SESSION['username']=$username;
      $_SESSION['kind']=$kind;
      $_SESSION['realname']=$row['realname'];
      if ($kind == 1) {//判断用户类型
          echo "<script>alert('登陆成功！欢迎您');window.location.href='$url_1';</script>"; 
          }
          else if ($kind == 2) {
            echo "<script>alert('登陆成功！欢迎您');window.location.href='$url_2';</script>"; 
          }
          else {
            echo "<script>alert('登陆成功！欢迎您');window.location.href='$url_3';</script>"; 
          }
  }
  else{
    echo "<script>alert('登陆信息有误！重新填写');window.location.href='$url_4';</script>"; 
  }  
?>