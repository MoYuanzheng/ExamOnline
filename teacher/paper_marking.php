<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>试卷批阅</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class="jumbotron text-center" style="margin-bottom:0;margin-top:0;">
    <h1>您已进入客观题批阅中心</h1>
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
        <li class="nav-item ">
            <a class="nav-link " href="make_paper_1.php">试卷制作</a>
        </li>
        <li class="nav-item active">
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
<table class="table table-hover" style="width: 80%;margin-left: 10%;">
    <thead>
    <tr>
        <th>本次题号</th>
        <th>题库位置</th>
        <th>问题</th>
        <th>标准答案</th>
        <th>考生作答</th>
        <th>满分</th>
        <th>得分</th>
    </tr>
    </thead>
    <?php

    include('../conn.php');
    $paper_num = $_GET['num'];//获得试卷编号
    //查询该编号所指向的试卷，并记录所有客观题题号
    $sql_history = "SELECT * FROM exam_history WHERE num = '$paper_num';";
    $result_history = mysqli_query($conn, $sql_history);
    $row_history = mysqli_fetch_assoc($result_history);
    $number = $row_history['number'];//题目数量
    $paper_name = $row_history['paper_name'];//考试名字
    //如果flag==1，则说明该试卷已批阅结束
    if ($row_history['flag']) {
        $historyFlag = $row_history['flag'];
        $str = '该试卷已批阅结束！';
        echo "<script> alert( '$historyFlag' . $str);window.location.href='paper_marking_select.php'; </script>";
    }
    $j = 0;
    //记录所有客观题题号
    for ($i = 1; $i <= $number; $i++) {
        $temp = $row_history['t' . $i];
        //在题库查找该题号所指向的题目
        $sql_problem = "SELECT * FROM problems WHERE num = $temp ;";
        $result_problem = mysqli_query($conn, $sql_problem);
        $row_problem = mysqli_fetch_assoc($result_problem);
        //记录主观题题号
        if ($row_problem['type'] == '3') {
            $subQuestions_code[$j] = $row_problem['num'];//题号
            $subQuestions_item[$j] = $row_problem['item'];//题目
            $subQuestions_ans[$j] = $row_problem['ans'];//标准答案
            $subQuestions_score[$j] = $row_history['s' . $i];//满分分数
            $subQuestions_codeTemp[$j] = 't' . $i;//相对题号(在此次试卷中的位置)
            $j++;
        }
    }
    echo "<form action='paper_marking.php'>";

    //flag为0是未批阅考生的试卷
    //$sql_examNum = "SELECT * FROM exam_$paper_num WHERE flag = '0';";
    //$result_examNum = mysqli_query($conn, $sql_examNum);
    // echo "<select name=\"username\" id=\"username\" onchange=\"s_click(this)\" >
    // 	  <option>↓请选择考生↓</option>";
    // 	while($row_4 = mysqli_fetch_assoc($result_4))
    // 	{
    // 		echo "
    // 			<option  value=\"paper_marking.php?num=$paper_num&username=$row_4[students_num]\" >
    // 				$row_4[students_num]
    // 			</option>
    // 		";
    // 	}
    // echo "</select><br>	";


    //查找考生作答
    $sql_studentsNum = "SELECT students_num FROM exam_$paper_num WHERE flag = '0' ";
    $result_studentsNum = mysqli_query($conn, $sql_studentsNum);
    //拿到所有未批阅考生的学号
    $p = 0;
    while ($row_studentsNum = mysqli_fetch_assoc($result_studentsNum)) {
        $students[$p++] = $row_studentsNum['students_num'];
    }
    if (@$_GET['$studentsNum']) $studentsNum = $_GET['$studentsNum'];
    else $studentsNum = $students[0];
    echo '该答题卡所属学号：' . $studentsNum;
    //foreach ($students as $studentsNum){
    //拿到某个学生的答题记录
    $sql_ans = "SELECT * FROM exam_$paper_num WHERE students_num = '$studentsNum' ";
    $result_ans = mysqli_query($conn, $sql_ans);
    $row_ans = mysqli_fetch_assoc($result_ans);
    //根据相对题号数组将其客观题作答提取
    $codeTempToString = '';
    foreach ($subQuestions_codeTemp as $index => $codeTemp) {
        //在此输出表格，相对题号、绝对题号、问题、标准答案、考生作答.
        $codeTempToString .= $codeTemp;
        echo "
				<tbody>
					<tr>
						<td>$codeTemp</td>
						<td>$subQuestions_code[$index]</td>
						<td>$subQuestions_item[$index]</td>
						<td>$subQuestions_ans[$index]</td>
						<td>$row_ans[$codeTemp]</td>
						<td>$subQuestions_score[$index]</td>
						<td><input type=\"text\" name=\"s$index\" ></td>
					</tr>
				</tbody>
			";
    }
    //}

    //    $sql_6 = "SELECT * FROM exam_$paper_num WHERE flag = '0';";
    //    $result_6 = mysqli_query($conn, $sql_6);
    //    $count = 0;//未批阅数
    //    while (mysqli_fetch_assoc($result_6)) {
    //        $count = $count + 1;
    //    }


    //    echo "
    //			<div class=\"form-group\">
    //				<div class=\"col-sm-offset-2 col-lg-8\">
    //					<p>剩余批阅试卷数：$count</p>
    //					<button type=\"submit\" class=\"btn btn-success\" style=\"min-width: 20%;margin-left:92%;margin-top:-5%;\" >提交</button>
    //				</div>
    //			</div>
    //		";
    echo "
        <input type='hidden' value='$codeTempToString' id='codeTempToString' name='codeTempToString'>
        <input type='hidden' value='$studentsNum' id='student_num' name='student_num'>
        <input type='hidden' value='$paper_num' id='num' name='num'>
        <input type=\"submit\" value=\"提交\" class='btn-primary'>
    ";
    echo "</form>";
    ?>
</table>
<?php
/*
 * 卷子号    $paper_num++++
 * 相对题号   $objQuestions_codeTemp++
 * 对应分数   s$i++
 * 学号      $studentsNum++++
 * 客观题总分      $objScore_total--
 * */

//给单个客观题赋分
//通过get得到相对题号并根据
if (@$_GET['codeTempToString']) {


    $getCodeTempArray = explode('t', @$_GET['codeTempToString']);

    $subScore_total = 0;
    foreach ($getCodeTempArray as $index => $codeTemp) {
        if (@$_GET['s' . $index]) {
            //$temp 为临时题目得分
            $temp = $_GET['s' . $index];
            $paper_num = @$_GET['num'];
            $subScore_total += $temp;
            //echo $codeTemp;
            $studentsNum = $_GET['student_num'];
            $sql_updateSingleSubScore =
                "UPDATE exam_$paper_num SET s$codeTemp = '$temp' WHERE students_num = '$studentsNum'";
            $result_updateSubScore = mysqli_query($conn, $sql_updateSingleSubScore);
        }
    }
//计算其客观题总分、卷子总分，更新该考生答题卡批阅状态

//查找出客观题得分总分
    $sql_objScore_total = "SELECT score_1 from exam_$paper_num WHERE students_num = '$studentsNum' ";
    $result_objScore_total = mysqli_query($conn, $sql_objScore_total);
    $row_score_1 = mysqli_fetch_assoc($result_objScore_total);
    $objScore_total = $row_score_1['score_1'];

    $score = (int)$objScore_total + (int)$subScore_total;
//更新主观题得分总分 （score_2）
    $sql_updateTotalSubScore =
        "UPDATE exam_$paper_num SET 
          score_2 = '$subScore_total',
          score = '$score',
          flag = '1'
    WHERE students_num = '$studentsNum'";
    $result_updateSubScore = mysqli_query($conn, $sql_updateTotalSubScore);

//判断是否还有未批阅试卷
    $sql_studentsNum = "SELECT students_num FROM exam_$paper_num WHERE flag = '0' ";
    $result_studentsNum = mysqli_query($conn, $sql_studentsNum);
    $row_studentsNum = mysqli_fetch_assoc($result_studentsNum);
    if (!$row_studentsNum) {
        //更新exam_history中本次考试批阅标志位
        $sql_upHistoryFlag = "UPDATE exam_history SET flag = 1 WHERE num = $paper_num";
        $result_upHistoryFlag = mysqli_query($conn, $sql_upHistoryFlag);
        //更新排名rank
        $sql_rank = "SELECT * FROM exam_$paper_num ORDER BY score desc";
        $result_rank = mysqli_query($conn, $sql_rank);
        $rank = 1;
        while ($row_rank = mysqli_fetch_assoc($result_rank)) {

            $username = $row_rank['students_num'];
            //UPDATE 表名称 SET 列名称 = 新值 WHERE 列名称 = 某值
            $sql_upRank = "UPDATE exam_$paper_num SET scoreRank = '$rank' WHERE students_num = '$username';";
            $result_upRank = mysqli_query($conn, $sql_upRank);
            $rank = $rank + 1;
        }
        //alert未检测到未批阅试卷或已批阅完成，将返回试卷选择页面
        echo "<script>alert('未检测到未批阅试卷或已批阅完成！将返回试卷选择页面');window.location.href='paper_marking_select.php';</script>";
    }
}
?>
</body>
<script type="text/javascript">
    //select跳页
    // function s_click(obj) {
    //     let num = 0;
    //     for (let i = 0; i < obj.options.length; i++) {
    //         if (obj.options[i].selected === true) {
    //             num++;
    //         }
    //     }
    //     if (num === 1) {
    //         let url = obj.options[obj.selectedIndex].value;
    //         window.open(url, "_self"); //这里修改打开连接方式
    //     }
    // }
</script>
</html>