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
	<div class="jumbotron text-center" style="margin-bottom:0;margin-top:0;">
		<h1>在线考试系统</h1>
		<?php include('../conn.php');session_start(); $a = $_SESSION['realname']?>
		<p >欢迎您：<strong><?php echo $a.''; ?></strong>老师  <a href="../destroy.php">注销</a></p>
	</div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="teacher.php">主页</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="student_show.php">考生浏览</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="student_add.html">添加考生</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " target="_blank" href="../admin/grades_select.php">成绩公示</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="analysis_select.php">试卷分析</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="make_paper_1.php">试卷制作</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="paper_marking_select.php">试卷批阅</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="problems_add.html">题库更新</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="problems_show.php">题库浏览</a>
            </li>
        </ul>
    </nav>

</body>

</html>