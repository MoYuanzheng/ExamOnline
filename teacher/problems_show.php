<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>题目管理</title>
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
        <li class="nav-item">
            <a class="nav-link " href="make_paper_1.php">试卷制作</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="paper_marking_select.php">试卷批阅</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="problems_add.html">题库更新</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="problems_show.php">题库浏览</a>
        </li>
    </ul>
</nav>

<div id="select">
    <table class="table table-hover" style="">
        <thead>
        <tr style="min-width: 50px;">
            <th>
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                    <strong>选择题</strong>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="problems_show_2.php">填空题</a>
                    <a class="dropdown-item" href="problems_show_3.php">简答题</a>
                </div>
            </th>
            <th style="min-width: 50px;">题号</th>
            <th>题目</th>
            <th>A</th>
            <th>B</th>
            <th>C</th>
            <th>D</th>
            <th style="min-width: 50px;">答案</th>
            <th style="min-width: 50px;">解析</th>
            <th style="min-width: 100px;">操作</th>
        </tr>
        </thead>
        <?php
        include('../conn.php');
        $sql = "SELECT * FROM problems WHERE type = '1' order by num;";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $num = $row['num'];
            $item = $row['item'];
            $sel_A = $row['A'];
            $sel_B = $row['B'];
            $sel_C = $row['C'];
            $sel_D = $row['D'];
            $ans = $row['ans'];
            $exp = $row['exp'];
            echo "
					<tbody>
						<tr>
							<td></td>
							<td>$num</td>
							<td>$item</td>
							<td>$sel_A</td>
							<td>$sel_B</td>
							<td>$sel_C</td>
							<td>$sel_D</td>
							<td>$ans</td>
							<td>$exp</td>
							<td>
								<div class=\"btn-group\">
                                    <a class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                    data-num='$num' data-item='$item' data-ans='$ans' data-exp='$exp' 
                                    data-A='$sel_A' data-B='$sel_B' data-C='$sel_C' data-D='$sel_D'>修改</a>
                                    <a class=\"btn btn-danger\" href=\"problems_delete.php?num=$num\">删除</a>
                                </div>
							</td>
						</tr>
					</tbody>
				";
        }
        ?>
    </table>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">修改信息</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form class="form-horizontal" role="form" action="problems_update_submit.php" method="post">
                    <!-- 模态框主体 -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="num">题号:</label>
                            <input class="form-control" id="num" name="num" readonly="value" type="text">
                        </div>
                        <div class="form-group">
                            <label for="item">题目:</label>
                            <textarea class="form-control" id="item" name="item" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sel_A">选项A:</label>
                            <textarea class="form-control" id="sel_A" name="sel_A" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sel_B">选项B:</label>
                            <textarea class="form-control" id="sel_B" name="sel_B" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sel_C">选项C:</label>
                            <textarea class="form-control" id="sel_C" name="sel_C" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sel_D">选项D:</label>
                            <textarea class="form-control" id="sel_D" name="sel_D" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ans">答案:</label>
                            <textarea class="form-control" id="ans" name="ans" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exp">解析:</label>
                            <textarea class="form-control" id="exp" name="exp" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                    <!-- 模态框底部 -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">提交</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).on('click', '.btn-warning', function () {
        // 模态框传值
        let num = $(this).attr('data-num');
        let item = $(this).attr('data-item');
        let ans = $(this).attr('data-ans');
        let A = $(this).attr('data-A');
        let B = $(this).attr('data-B');
        let C = $(this).attr('data-C');
        let D = $(this).attr('data-D');
        let exp = $(this).attr('data-exp');
        $('#num').val(num);
        $('#item').val(item);
        $('#ans').val(ans);
        $('#sel_A').val(A);
        $('#sel_B').val(B);
        $('#sel_C').val(C);
        $('#sel_D').val(D);
        $('#exp').val(exp);
    });
</script>
</html>