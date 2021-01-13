<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>试卷制作</title>
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
            <a class="nav-link " target="_blank" href="../admin/grades_select.php">成绩公示</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="analysis_select.php">试卷分析</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link " href="make_paper_1.php">试卷制作</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="paper_marking_select.php">试卷批阅</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="problems_add.html">题库更新</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="problems_show.php">题库浏览</a>
        </li>
    </ul>
</nav>
<div class="container" style="width: 50%;min-width: 200px;margin-top: 20px;">
    <form class="form-horizontal">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">请输入考试名称</span>
            </div>
            <input class="form-control" type="text" name="paper_name" id="paper_name"
                   placeholder="例如:《2020-2021秋季学期PHP程序设计期末检测》" value="<?php echo(@$_GET['paper_name']); ?>">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">考题数量</span>
            </div>
            <input class="form-control" type="text" name="number" id="number" placeholder="请确定考题数量，提交基本信息后可选择题目"
                   value="<?php echo @$_GET['number']; ?>">
        </div>

        <div class="d-flex justify-content-around">
            <div style="width: 70%;">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">开始时间</span>
                    </div>
                    <input class="form-control" type="datetime-local" name="time" id="time"
                           value="<?php echo @$_GET['time']; ?>">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">截止时间</span>
                    </div>
                    <input class="form-control" type="datetime-local" name="duration" id="duration"
                           value="<?php echo @$_GET['duration']; ?>">
                </div>

            </div>
            <div>
                <br>
                <button type="submit" class="btn btn-primary">提交基本信息</button>
            </div>
        </div>
    </form>
    <form action="make_paper_submit.php">
        <?php
        @ $num = $_GET['number'];//考题数量
        @ $duration = $_GET['duration'];//时长
        @ $time = $_GET['time'];//开始时间
        @ $paper_name = $_GET['paper_name'];//名字
        $count = 1;
        if ($num) {
            while ($count <= $num) {
                echo "
                    <div class=\"container d-flex justify-content-around \">
                        <div class=\"input-group mb-3\" style='width: 30%;'>
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\">第 $count 题题号</span>
                            </div>
                            <input class=\"form-control\" type=\"text\" name=\"num$count\">
                        </div>
                        <div class=\"input-group mb-3\" style='width: 30%;'>
                            <div class=\"input-group-prepend\">
                                <span class=\"input-group-text\">第 $count 题分值</span>
                            </div>
                            <input class=\"form-control\" type=\"text\" name=\"num_s$count\">
                        </div>
                    </div>
                ";
                $count += 1;
            }
            echo "<input type=\"hidden\" value=\"$num\" name='number'>";
            echo "<input type=\"hidden\" value=\"$duration\" name='duration'>";
            echo "<input type=\"hidden\" value=\"$time\" name='time'>";
            echo "<input type=\"hidden\" value=\"$paper_name\" name='paper_name'>";
            echo "<button style='margin-left: 45%;' class=\"btn btn-primary\" type=\"submit\" >提交试卷</button>";
        }
        ?>
    </form>
</div>
</body>
</html>