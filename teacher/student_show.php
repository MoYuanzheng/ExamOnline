<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>考生管理</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class="jumbotron text-center" style="margin-bottom:0;margin-top:0;">
    <h1>考生管理</h1>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link" href="teacher.php">主页</a>
        </li>
        <li class="nav-item active">
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
            <a class="nav-link " href="make_paper_1.html">试卷制作</a>
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

<div id="student">
    <table class="table table-hover" style="width: 80%;margin-left: 10%;">
        <thead>
        <tr>
            <th>账号</th>
            <th>姓名</th>
            <th>学院</th>
            <th>专业</th>
            <th>操作</th>
        </tr>
        </thead>
        <?php
        include('../conn.php');
        session_start();
        $a = $_SESSION['realname'];
        $sql_3 = "SELECT * FROM user WHERE kind = 3;";
        $result_3 = mysqli_query($conn, $sql_3);

        while ($row_3 = mysqli_fetch_assoc($result_3)) {
            $username = $row_3['username'];
            $realname = $row_3['realname'];
            $collage = $row_3['collage'];
            $profession = $row_3['profession'];

            echo "
					<tbody>
						<tr>
							<td>$username</td>
							<td>$realname</td>
							<td>$collage</td>
							<td>$profession</td>
							<td>
								<div class=\"btn-group\">
                                    <a class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                    data-username='$username' data-realname='$realname' data-collage='$collage' 
                                    data-profession='$profession' >修改</a>
                                    <a class=\"btn btn-danger\" href=\"student_delete.php?username=$username\">删除</a>
                                </div>
							</td>
						</tr>
					</tbody>
				";
        }
        ?>
    </table>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- 模态框头部 -->
            <div class="modal-header">
                <h4 class="modal-title">修改信息</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-horizontal" role="form" action="student_update_submit.php" method="post">
                <!-- 模态框主体 -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">账号：</label>
                        <input class="form-control" id="username" name="username" readonly="value" type="text">
                    </div>
                    <div class="form-group">
                        <label for="realname">真实姓名：</label>
                        <input class="form-control" id="realname" name="realname">
                    </div>
                    <div class="form-group">
                        <label for="collage">学院：</label>
                        <input class="form-control" id="collage" name="collage">
                    </div>
                    <div class="form-group">
                        <label for="profession">专业：</label>
                        <input class="form-control" id="profession" name="profession">
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
</body>
<script>
    $(document).on('click', '.btn-warning', function () {
        // 模态框传值
        let username = $(this).attr('data-username');
        let realname = $(this).attr('data-realname');
        let collage = $(this).attr('data-collage');
        let profession = $(this).attr('data-profession');

        $('#username').val(username);
        $('#realname').val(realname);
        $('#collage').val(collage);
        $('#profession').val(profession);

    });
</script>
</html>