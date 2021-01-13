<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>题库更新</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class="jumbotron text-center" style="margin-bottom:0;margin-top:0;">
    <h1>试卷制作</h1>
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
            <a class="nav-link " href="../admin/grades_select.php">成绩公示</a>
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
        <li class="nav-item active">
            <a class="nav-link" href="problems_add.html">题库更新</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="problems_show.php">题库浏览</a>
        </li>
    </ul>
</nav>
<form class="form-horizontal" role="form" style="margin-left: 25%;margin-top: 2.5%;" action="problems_add_submit.php"
      method="post">

    <?php
    $num = $_POST['num'];
    $type = $_POST['type'];
    if ($type == 1) $type_s = '选择题';
    else if ($type == 2) $type_s = '填空题';
    else $type_s = '主观题';
    echo "
			<input type=\"text\" name=\"type\" value=\"$type\" style=\"display:none;\" >
			<input type=\"text\" name=\"num\" value=\"$num\" style = \"display:none;\" >
	";

    $count = 1;
    if ($type == 1) {
        while ($count <= $num) {
            echo "	
                <div class=\"form-group\">
                    <label class=\"col-sm-2 control-label\" style=\"color:green;\" >题号</label>
                    <div class=\"col-lg-3\" style=\"max-width:6%;min-width:200px;\">
                        <input type=\"text\" class=\"form-control\" name=\"profession\" value=\"$count\">
                    </div>
                </div>
                <div class=\"form-group\" style=\"max-width:40%;margin-left:12.5%;\">
                    <label for=\"name\">题干</label>
                    <textarea class=\"form-control\" name=\"item$count\" rows=\"3\" style=\"\" ></textarea>
                </div>
                <div class=\"form-group\" style=\"max-width:40%;margin-left:12.5%;\">
                    <label for=\"name\">A</label>
                    <textarea class=\"form-control\" name=\"sel_A$count\" rows=\"2\" style=\"\" ></textarea>
                </div>
                <div class=\"form-group\" style=\"max-width:40%;margin-left:12.5%;\">
                    <label for=\"name\">B</label>
                    <textarea class=\"form-control\" name=\"sel_B$count\" rows=\"2\" style=\"\" ></textarea>
                </div>
                <div class=\"form-group\" style=\"max-width:40%;margin-left:12.5%;\">
                    <label for=\"name\">C</label>
                    <textarea class=\"form-control\" name=\"sel_C$count\" rows=\"2\" style=\"\" ></textarea>
                </div>
                <div class=\"form-group\" style=\"max-width:40%;margin-left:12.5%;\">
                    <label for=\"name\">D</label>
                    <textarea class=\"form-control\" name=\"sel_D$count\" rows=\"2\" style=\"\" ></textarea>
                </div>
                <div class=\"form-group\">
                    <label class=\"col-sm-2 control-label\">答案</label>
                    <div class=\"col-lg-3\" style=\"max-width:6%;\">
                        <input type=\"text\" class=\"form-control\" name=\"ans$count\" >
                    </div>
                </div>
                <div class=\"form-group\" style=\"max-width:40%;margin-left:12.5%;\">
                    <label for=\"name\">解析</label>
                    <textarea class=\"form-control\" name=\"exp$count\" rows=\"3\"></textarea>
                </div><br><br><br><br>
            ";
            $count += 1;
        }

    } else {
        while ($count <= $num) {

            echo "
						<div class=\"form-group\">
							<label class=\"col-sm-2 control-label\" style=\"color:green;\" >题号</label>
							<div class=\"col-lg-3\" style=\"max-width:6%;\">
								<input type=\"text\" class=\"form-control\" name=\"profession\" value=\"$count\">
							</div>
						</div>

						<div class=\"form-group\" style=\"max-width:40%;margin-left:12.5%;\">
							<label for=\"name\">题干</label>
							<textarea class=\"form-control\" name=\"item$count\" rows=\"3\" style=\"\" ></textarea>
						</div>

						<div class=\"form-group\" style=\"max-width:40%;margin-left:12.5%;\">
							<label for=\"name\">答案</label>
							<textarea class=\"form-control\" name=\"ans$count\" rows=\"3\" style=\"\" ></textarea>
						</div>

						<div class=\"form-group\" style=\"max-width:40%;margin-left:12.5%;\">
							<label for=\"name\">解析</label>
							<textarea class=\"form-control\" name=\"exp$count\" rows=\"3\"></textarea>
						</div><br><br>
				";
            $count += 1;
        }
    }
    ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-lg-8">
            <button type="submit" class="btn btn-success" style="min-width: 35%;">提交</button>
        </div>
    </div>
</form>
</body>
</html>