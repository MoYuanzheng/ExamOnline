<?php 
	include('../conn.php');
	$username = $_GET['username'];
	$sql_3="DELETE FROM user WHERE username = '$username';";
	$result_3 = mysqli_query($conn,$sql_3);
	if ($result_3) {
		echo "<script>alert('删除成功！');history.back();</script>";
    }
    else{
    	echo "<script>alert('删除失败！');history.back();</script>";
    }
 ?>