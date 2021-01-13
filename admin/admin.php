<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>主页</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>上机考试后台管理系统</h1>
	<?php include('../conn.php');
	session_start();
	?>
  <p>欢迎您：<strong><?php echo $_SESSION['realname']; ?></strong>老师<a href="../destroy.php">注销</a></p>
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="admin.php">主页</a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="users_show.php">人员管理</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="users_add.html">添加人员</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" target="_blank" href="grades_select.php">成绩公示</a>
    </li>
  </ul>
</nav>
</body>

</html>