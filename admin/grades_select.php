<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>成绩查阅</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class="jumbotron text-center" style="margin-bottom:0">
    <h1>成绩查阅</h1>
</div>
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

    while ($row_1 = mysqli_fetch_assoc($result_1)) {
        $num = $row_1['num'];
        $paper_name = $row_1['paper_name'];
        $flag = $row_1['flag'];
        $time_start = $row_1['time_start'];
        if ($flag == 1) {
            $ZT = '已批阅';
        } else {
            $ZT = '未批阅';
        }

        echo "
            <tbody>
                <tr>
                    <td>$paper_name</td>
                    <td>$time_start</td>
                    <td>$ZT</td>
                    <td><a target='_blank' href=\"grades_show.php?num=$num\">查看</a></td>
                </tr>
            </tbody>
        ";
    }
    ?>
</table>

</body>

</html>