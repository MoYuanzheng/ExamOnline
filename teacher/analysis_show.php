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


	
	<?php 
		include('../conn.php');
		$num = $_GET['num'];

		//得到题目总数
		$sql_2 = "SELECT * FROM exam_history WHERE num = '$num ' ;";
		$result_2 = mysqli_query($conn,$sql_2);
		$row_2 = mysqli_fetch_assoc($result_2);
		$number = $row_2['number'];
		$pap_name = $row_2['paper_name'];

		//得到学生提交信息
		$sql_1 = "SELECT * FROM exam_$num;";
		$result_1 = mysqli_query($conn,$sql_1);

		//计算及格率、平均分、最高分、最低分
		$count_pass=0; $score_all = 0;$count_stu = 0;
		$max = 0; $min = 999;
		while ($row_1 = mysqli_fetch_assoc($result_1)) {
			$count_stu++;//参考人数
			if($row_1['score'] >= 60) $count_pass++;//及格人数
			if($row_1['score'] > $max) $max = $row_1['score'];//MAX
			if($row_1['score'] < $min) $min = $row_1['score'];//MIN
			$score_all = $score_all + $row_1['score'];//总分
		}
		$rate_pass = $count_pass / $count_stu * 100;//及格率
		$aver = $score_all / $count_stu;
		
		//计算各个题的正确个数
		for ($i=1; $i <=$number ; $i++) {
			$sql_8 = "SELECT * FROM exam_$num";
			$result_8 = mysqli_query($conn,$sql_8);
			$count_right[$i] = 0;
			while ($row_8 = mysqli_fetch_assoc($result_8)) {
				if($row_8['s'.$i] > 0) {$count_right[$i]++;  }
			}
			$rate_right[$i] = $count_right[$i] / $count_stu * 100;
			$count_wrong[$i] = $count_stu - $count_right[$i];
			$rate_wrong[$i] = (100 - $rate_right[$i]);
		}

		//$count_right[$i] 第i个题正确个数
		//$rate_right[$i] 第i个题正确率

		//$count_stu 学生数
		//$number 题目总数

		//$count_pass 及格人数
		//$rate_pass 及格率

		//MAX最高分 MIN最低分
			echo "
	<table class=\"table table-hover\" style=\"width: 70%;margin-left: 15%;text-align:center;\" >
		<thead>
			<tr >
				<th style=\"text-align:center;\">最高分</th>
				<th style=\"text-align:center;\">最低分</th>
				<th style=\"text-align:center;\">平均分</th>
				<th style=\"text-align:center;\">及格人数</th>
				<th style=\"text-align:center;\">及格率</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>$max</td>
				<td>$min</td>
				<td>$aver</td>
				<td>$count_pass</td>
				<td>$rate_pass%</td>
			</tr>
		</tbody>
	</table>

	<table class=\"table table-hover\" style=\"width: 80%;margin-left: 10%;\" >
		<thead>
			<tr>
				<th>题目顺序</th>
				<th>题干</th>
				<th>错题人数</th>
				<th>错误率</th>
			</tr>
		</thead>";
		for ($i=1; $i <= $number; $i++) {
			$t_num = $row_2['t'.$i];
			$sql_3 = "SELECT * FROM problems WHERE num = '$t_num' ";
			$result_3 = mysqli_query($conn,$sql_3);
			$row_3 = mysqli_fetch_assoc($result_3);
			if ($row_3['type'] == 3) continue;
			$t_item = $row_3['item'];
			echo "
				<tbody>
					<tr>
						<td>$i</td>
						<td>$t_item</td>
						<td>$count_wrong[$i]</td>
						<td>$rate_wrong[$i]%</td>
					</tr>
				</tbody>
			";
		}
	echo "</table>";
	?>
</body>
</html>