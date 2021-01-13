<?php
	include('../conn.php');
	$num = $_POST['num'];
	// echo "数量.$num";
	$type = $_POST['type'];
	// echo "题型$type";
	$sel_A = 0;
	$sel_B = 0;
	$sel_C = 0;
	$sel_D = 0;
	for($t = 1; $t <= $num; $t++) {
		$item   = $_POST['item'.$t];
		@$sel_A = $_POST['sel_A'.$t];
		@$sel_B = $_POST['sel_B'.$t];
		@$sel_C = $_POST['sel_C'.$t];
		@$sel_D = $_POST['sel_D'.$t];
		$ans    = $_POST['ans'.$t];
		$exp    = $_POST['exp'.$t];
		// echo "<br>题干$item<br>";
		// echo "<br>A$sel_A<br>";
		// echo "<br>B$sel_B<br>";
		// echo "<br>C$sel_C<br>";
		// echo "<br>D$sel_D<br>";
		// echo "<br>答案$ans<br>";
		// echo "<br>解析$exp<br>";
		// alter table `subjects` change num num int not null auto_increment UNIQUE;
		//用户表
		$insert="INSERT INTO `problems` (`item`, `A`, `B`, `C`, `D`, `ans`, `exp`, `type`) VALUES ('$item','$sel_A','$sel_B','$sel_C','$sel_D','$ans','$exp','$type');";
  		$result = mysqli_query($conn,$insert);
  		
  		$url_1="problems_add.html";//成功
  		$url_2="problems_add.html";//失败

  		if ($result) 
  		  echo "<script>alert('添加成功！');window.location.href='$url_1';</script>"; 
  		else 
  			echo "<script>alert('添加失败！请使内容合规！');window.location.href='$url_2';</script>"; 
	}
?>