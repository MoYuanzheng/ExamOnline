<?php
	include('../conn.php');
	$stu_num=$_POST['stu_num'];//考号
	$pap_num=$_POST['pap_num'];//卷子号
	$start_num=$_POST['start_num'];//开始题号
	$end_num=$_POST['end_num'];//结束题号
	$flag = 0;//判定修改结果
	$score_2 = 0;
	for ($i= $start_num; $i <= $end_num ; $i++) { 
		$temp = $_POST['s'.$i];
		$score_2 = $_POST['s'.$i] +$score_2;
		$sql_1=" UPDATE exam_$pap_num SET s$i = '$temp' WHERE students_num = '$stu_num'";
		$result_1 = mysqli_query($conn,$sql_1);
	}
	
	//更新总分
	$sql="SELECT * FROM exam_$pap_num WHERE students_num = '$stu_num'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$score_1 = $row['score_1'];
	$score = $score_1 + $score_2;
	$sql_7=" UPDATE exam_$pap_num SET score = '$score' WHERE students_num = '$stu_num'";
	$result_7 = mysqli_query($conn,$sql_7);

	$url_1="paper_marking_select.php?num=$pap_num";//成功
  	$url_2="paper_marking_select.php?num=$pap_num";//失败

    if ($result_1) {
    	$sql_9=" UPDATE exam_$pap_num SET score_2 = '$score_2' WHERE students_num = '$stu_num'";
		$result_9 = mysqli_query($conn,$sql_9);

    	$sql_2=" UPDATE exam_$pap_num SET flag = 1 WHERE students_num = '$stu_num'";
		$result_2 = mysqli_query($conn,$sql_2);
   	}
    else{
    	echo "<script>alert('提交信息有误！请确保分值为数值！');window.location.href='$url_2';</script>"; 
    }


  	/*******************************************/
  	$flag_2 = 0;
    $sql_3="SELECT * FROM exam_$pap_num ;";
	//查询改编号所指向的试卷
	$result_3 = mysqli_query($conn,$sql_3);
	while ( $row_3 = mysqli_fetch_assoc($result_3)) {
		if ($row_3['flag'] == 0) {
			$flag_2 = 1;
		}
	}
	if ($flag_2 == 0) {
		//如果所有考试都批阅结束，那么该试卷已批阅结束，将试卷的标志位置为一
		$sql_4=" UPDATE exam_history SET flag = 1 WHERE  num = '$pap_num';";
		$result_4 = mysqli_query($conn,$sql_4);

		echo "<script>window.location.href='rank.php';</script>"; 
	}
	else{
		echo "<script>alert('批阅成功！进行下一位~');window.location.href='$url_1';</script>"; 
	}
	/*******************************************/
 ?>