<!DOCTYPE html>
<html lang="en" xmlns="">
<head>
    <meta charset="UTF-8">
    <title>人员管理</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class="jumbotron text-center" style="margin-bottom:0">
    <h1>人员管理</h1>
</div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link" href="admin.php">主页</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="users_show.php">人员管理</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="users_add.html">添加人员</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  target="_blank" href="grades_select.php">成绩公示</a>
        </li>
    </ul>
</nav>

<div id="all">
    <table class="table table-hover" style="width: 80%;margin-left: 10%;">
        <thead>
        <tr>
            <th>账号</th>
            <th>姓名</th>
            <th>学院</th>
            <th>专业 / 职称</th>
            <th>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                        <strong>类别</strong>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="users_show.php?kind=1">管理员</a>
                        <a class="dropdown-item" href="users_show.php?kind=2">教师</a>
                        <a class="dropdown-item" href="users_show.php?kind=3">学生</a>
                    </div>
                </div>
            </th>
            <th>操作</th>
        </tr>
        </thead>
        <?php
        include('../conn.php');
        session_start();
        if (@!$_GET['kind'])
            $kind = '';
        else $kind = $_GET['kind'];
        @$a = $_SESSION['realname'];
        $sql = "SELECT * FROM user WHERE kind LIKE binary '%$kind%'";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];
            $realname = $row['realname'];
            $collage = $row['collage'];
            $pwd = $row['pwd'];
            $Xkind = $row['kind'];//用于模态框传值
            if ($row['kind'] == 1) $kind = '管理员';
            else if ($row['kind'] == 2) $kind = '教师';
            else if ($row['kind'] == 3) $kind = '学生';
            $profession = $row['profession'];
            echo "
                    <tbody>
                        <tr>
                            <td>$username</td>
                            <td>$realname</td>
                            <td>$collage</td>
                            <td>$profession</td>
                            <td>$kind</td>
                            <td>                            
                                <div class=\"btn-group\">
                                    <a class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                    data-id='$username' data-realname='$realname' data-collage='$collage'
                                    data-profession='$profession' data-kind='$Xkind' data-pwd='$pwd' >修改</a>
                                    <a class=\"btn btn-danger\" href=\"../teacher/student_delete.php?username=$username\">删除</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                ";
        }
        ?>
    </table>
    <!-- 模态框 -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">修改信息</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form class="form-horizontal" role="form" action="user_update.php" method="post">
                    <!-- 模态框主体 -->
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">账号</span>
                            </div>
                            <input class="form-control" id="username" name="username" placeholder="请输入学号/教职工账号"
                                   readonly="value" type="text">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-password">密码</span>
                            </div>
                            <input type="password" class="form-control" name="pwd" id="pwd" placeholder="请输入密码">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">姓名</span>
                            </div>
                            <input class="form-control" id="realname" name="realname" placeholder="请输入真实姓名" type="text">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">学院</span>
                            </div>
                            <input class="form-control" id="collage" name="collage" placeholder="请输入所属学院" type="text">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">专业</span>
                            </div>
                            <input class="form-control" id="profession" name="profession" placeholder="请输入所属专业"
                                   type="text">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">身份</span>
                            </div>
                            <select class="form-control" id="kind" name="kind">
                                <option value="2">教师</option>
                                <option value="3">学生</option>
                            </select>
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
        let id = $(this).attr('data-id');
        let realname = $(this).attr('data-realname');
        let kind = $(this).attr('data-kind');
        let pwd = $(this).attr('data-pwd');
        let collage = $(this).attr('data-collage');
        let profession = $(this).attr('data-profession');
        $('#username').val(id);
        $('#pwd').val(pwd);
        $('#realname').val(realname);
        $('#collage').val(collage);
        $('#kind').val(kind);
        $('#profession').val(profession);
    });
</script>
</html>