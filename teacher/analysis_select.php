<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>试卷分析</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class="jumbotron text-center" style="margin-bottom:0;margin-top:0;">
    <h1>试卷分析</h1>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item ">
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
        <li class="nav-item active">
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

	<table class="table table-hover" style="width: 80%;margin-left: 10%;" >
		<thead>
			<tr>
				<th>名称</th>
				<th>时间</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<?php 
			include('../conn.php');
			$sql_1 = "SELECT * FROM exam_history ;";
			$result_1 = mysqli_query($conn,$sql_1);
			
			while ($row_1 = mysqli_fetch_assoc($result_1)) {
				$num = $row_1['num'];
				$paper_name = $row_1['paper_name'];
				$flag = $row_1['flag'];
				$time_start = $row_1['time_start'];
				if ($flag == 1) {
					$ZT = '已批阅';
				}
				else {
					$ZT = '未批阅';
				}
			
			echo "
				<tbody>
					<tr>
						<td>$paper_name</td>
						<td>$time_start</td>
						<td>$ZT</td>
						<td><a class='btn btn-info' href=\"analysis_show.php?num=$num\">查看</a></td>
					</tr>
				</tbody>
			";
			}
		?>
	</table>
</body>
</html>