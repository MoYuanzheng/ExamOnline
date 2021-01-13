<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>成绩公示</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<?php
include('../conn.php');
$num = $_GET['num'];
$sql_3 = "SELECT * FROM exam_history WHERE num = '$num' ;";
$result_3 = mysqli_query($conn, $sql_3);
$row_3 = mysqli_fetch_assoc($result_3);
$url_3 = 'grades_select.php';
if ($row_3['flag'] == 0) {
    echo "<script>alert('成绩未公布，禁止查阅！');window.location.href='$url_3';</script>";
}
?>
<div class="jumbotron text-center" style="margin-bottom:0">
    <h1>成绩公示</h1>
    <p>科目：<?php echo $row_3['paper_name'] ?></p>
</div>
<table class="table table-hover" style="width: 80%;margin-left: 10%;text-align: center;">
    <thead>
    <tr>
        <th style="text-align: center;">考号</th>
        <th style="text-align: center;">姓名</th>
        <th style="text-align: center;">客观分</th>
        <th style="text-align: center;">主观分</th>
        <th style="text-align: center;">总分</th>
        <th style="text-align: center;">排名</th>
    </tr>
    </thead>
    <?php
    include('../conn.php');
    $sql_1 = "SELECT * FROM exam_$num ORDER BY scoreRank";
    $result_1 = mysqli_query($conn, $sql_1);
    while ($row_1 = mysqli_fetch_assoc($result_1)) {
        $students_num = $row_1['students_num'];
        $score_1 = $row_1['score_1'];
        $score_2 = $row_1['score_2'];
        $score = $row_1['score'];
        $rank = $row_1['scoreRank'];
        $sql_9 = "SELECT * FROM user WHERE username = '$students_num';";//得到考生信息
        $result_9 = mysqli_query($conn, $sql_9);
        $row_9 = mysqli_fetch_assoc($result_9);
        $realname = $row_9['realname'];
        echo "
            <tbody>
                <tr>
                    <td>$students_num</td>
                    <td>$realname</td>
                    <td>$score_1</td>
                    <td>$score_2</td>
                    <td>$score</td>
                    <td>$rank</td>
                </tr>
            </tbody>
		";
    }
    ?>
</table>
</body>
</html>