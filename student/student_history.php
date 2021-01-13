<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>历史考试</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/vue/dist/vue.js"></script>

</head>

<body>
<div class="jumbotron text-center" style="margin-bottom:0;margin-top:0;">
  <h1>在线考试系统</h1>
	<?php include('../conn.php');
	session_start();
	$a = $_SESSION['realname']; ?>
  <p><?php echo '欢迎您：' . $a . '同学'; ?></p>
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav" id="nav">
    <li class="nav-item" v-for="(tagName, index) in tagNames_tch">
      <a :class="isActiveClass(urls_tch[index])" :href='urls_tch[index]'>{{ tagName }}</a>
    </li>
  </ul>
</nav>
<table class="table table-hover" style="width: 80%;margin-left: 10%;">
  <thead>
  <tr>
    <th>名称</th>
    <th>开始时间</th>
    <th>结束时间</th>
    <th>考试状态</th>
    <th>批阅状态</th>
    <th>操作</th>
  </tr>
  </thead>
	<?php
	$sql_1 = "SELECT * FROM exam_history ;";
	$result_1 = mysqli_query($conn, $sql_1);

	while ($row_1 = mysqli_fetch_assoc($result_1)) {
		$num = $row_1['num'];
		$paper_name = $row_1['paper_name'];
		$flag = $row_1['flag'];
		date_default_timezone_set('PRC');
		$time_start = $row_1['time_start'];//规定
		$time_end = $row_1['duration'];//规定
		$time_now = date("Y-m-d H:i:s");
		//现在时间减去规定时间，若是小于零则说明未开始考试
		if (strtotime($time_now) - strtotime($time_start) < 0) {//对两个时间差进行差运算
			$ZT = '未开始';
		} else if (strtotime($time_now) - strtotime($time_end) > 0) {
			$ZT = '已结束';
		} else {
			$ZT = '进行中';
		}

		if ($flag == 1) {
			$PYZT = '已批阅';
		} else {
			$PYZT = '未批阅';
		}

		echo "
				<tbody>
					<tr>
						<td>$paper_name</td>
						<td>$time_start</td>
						<td>$time_end</td>
						<td>$ZT</td>
						<td>$PYZT</td>
						<td><a href=\"paper_history.php?num=$num\">查看</a></td>
					</tr>
				</tbody>
			";
	}
	?>
</table>
</body>
<script src="./js/nav.js"></script>

</html>