<?php
	include('../conn.php');
	$paper_num = $_POST['paperNum'];//试卷编号
	$number_questions = $_POST['numberQuestions'];//本次试卷题目个数
	//echo ($paper_num);
	session_start();
	//获取提交本次考试答案用户
	$username = $_SESSION['username'];
	//$username = 'admin';

    //在exam_$paper_num表中插入本次考试人员学号
	$sql="INSERT INTO exam_$paper_num (students_num) VALUES ('$username');";
	$result = mysqli_query($conn,$sql);

	$score = 0;//客观分
	for ($i=1; $i <= $number_questions; $i++) {
			$a = $_POST['a'.$i];echo($a);
			$t = $_POST['t'.$i];echo($t);
			$s = $_POST['s'.$i];echo($s);
		//在exam_$paper_num表，该用户行中修改作答:默认为零
		$sql_2 = "UPDATE exam_$paper_num SET t$i = '$t' WHERE students_num = '$username'";
		$result_2 = mysqli_query($conn,$sql_2);

		if ($_POST['a'.$i] == $_POST['t'.$i]) {
			//在exam_$paper_num表，该用户行中修改分值:默认为零
			$sql_3 = "UPDATE exam_$paper_num SET s$i = '$s' WHERE students_num = '$username'";
			$result_3 = mysqli_query($conn,$sql_3);
			//计算客观分
			$score = $score + $_POST['s'.$i];
		}
	}
	//echo($score);
	//修改此次客观题得分score_1
	$sql_4 = "UPDATE exam_$paper_num SET score_1 = '$score' WHERE students_num = '$username'";
	$result_4 = mysqli_query($conn,$sql_4);
	$url_1 = 'student.php';
  	echo "<script>alert('交卷成功！请听从监考老师安排有序离场！');window.location.href='$url_1';</script>"; 
