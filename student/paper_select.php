<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>选择考试场次</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/vue/dist/vue.js"></script>

</head>

<div class="jumbotron text-center" style="margin-bottom:0">
    <h1>选择考试场次</h1>
</div>
<body>
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
        <th>时间</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php
    include('../conn.php');
    $sql_1 = "SELECT * FROM exam_history ;";
    $result_1 = mysqli_query($conn, $sql_1);
    date_default_timezone_set('PRC');

    while ($row_1 = mysqli_fetch_assoc($result_1)) {
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
        $num = $row_1['num'];
        $paper_name = $row_1['paper_name'];
        $flag = $row_1['flag'];
        $time_start = $row_1['time_start'];

        echo "
				<tbody>
					<tr>
						<td>$paper_name</td>
						<td>$time_start</td>
						<td>$ZT</td>
						<td><a href=\"paper.php?num=$num\">进入</a></td>
					</tr>
				</tbody>
			";
    }
    ?>
</table>

</body>
<script>
    function back() {
        history.back();
    }
</script>
<script src="js/nav.js"></script>

</html>