<?php 
	include('../conn.php');

  	$url_1="make_paper_1.php";//成功
	$url_2 ="make_paper_1.php";//失败

	$time_start = $_GET['time'];
	$time_start['10'] = ' ';
	$time_start_1 = strtotime($time_start);
	$date_start=date('Y-m-d H:i:s',"$time_start_1");

	$duration = $_GET['duration'];
	$paper_name = $_GET['paper_name'];
	$number = $_GET['number'];

	for ($i=1; $i <= 50; $i++) {
		if ($_GET['num'.$i]) {
		 	$num[$i] =  $_GET['num'.$i];
		} 
		else {
			$num[$i] = '0';
		} 
	}

	for ($i=1; $i <= 50; $i++) {
		if ($_GET['num_s'.$i]) {
		 	$num_s[$i] =  $_GET['num_s'.$i];
		}
		else {
			$num_s[$i] = '0';
		} 
	}
	$insert="INSERT INTO `exam_history` (
			`paper_name`, `time_start`, `duration`, `number`, 
			`t1`, `t2`,`t3`,`t4`,`t5`,`t6`,`t7`,`t8`,`t9`,`t10`,
			`t11`,`t12`,`t13`,`t14`,`t15`,`t16`,`t17`,`t18`,`t19`,`t20`,
			`t21`,`t22`,`t23`,`t24`,`t25`,`t26`,`t27`,`t28`,`t29`,`t30`,
			`t31`,`t32`,`t33`,`t34`,`t35`,`t36`,`t37`,`t38`,`t39`,`t40`,
			`t41`,`t42`,`t43`,`t44`,`t45`,`t46`,`t47`,`t48`,`t49`,`t50`, 
			`s1`, `s2`,`s3`,`s4`,`s5`,`s6`,`s7`,`s8`,`s9`,`s10`,
			`s11`,`s12`,`s13`,`s14`,`s15`,`s16`,`s17`,`s18`,`s19`,`s20`,
			`s21`,`s22`,`s23`,`s24`,`s25`,`s26`,`s27`,`s28`,`s29`,`s30`,
			`s31`,`s32`,`s33`,`s34`,`s35`,`s36`,`s37`,`s38`,`s39`,`s40`,
			`s41`,`s42`,`s43`,`s44`,`s45`,`s46`,`s47`,`s48`,`s49`,`s50`) 
			VALUES ('$paper_name','$date_start','$duration','$number',
			'$num[1]' ,'$num[2]' ,'$num[3]' ,'$num[4]' ,'$num[5]',
			'$num[6]' ,'$num[7]' ,'$num[8]' ,'$num[9]' ,'$num[10]',
			'$num[11]','$num[12]','$num[13]','$num[14]','$num[15]',
			'$num[16]','$num[17]','$num[18]','$num[19]','$num[20]',
			'$num[21]','$num[22]','$num[23]','$num[24]','$num[25]',
			'$num[26]','$num[27]','$num[28]','$num[29]','$num[30]',
			'$num[31]','$num[32]','$num[33]','$num[34]','$num[35]',
			'$num[36]','$num[37]','$num[38]','$num[39]','$num[40]',
			'$num[41]','$num[42]','$num[43]','$num[44]','$num[45]',
			'$num[46]','$num[47]','$num[48]','$num[49]','$num[50]',
			'$num_s[1]' ,'$num_s[2]' ,'$num_s[3]' ,'$num_s[4]' ,'$num_s[5]' ,
			'$num_s[6]' ,'$num_s[7]' ,'$num_s[8]' ,'$num_s[9]' ,'$num_s[10]',
			'$num_s[11]','$num_s[12]','$num_s[13]','$num_s[14]','$num_s[15]',
			'$num_s[16]','$num_s[17]','$num_s[18]','$num_s[19]','$num_s[20]',
			'$num_s[21]','$num_s[22]','$num_s[23]','$num_s[24]','$num_s[25]',
			'$num_s[26]','$num_s[27]','$num_s[28]','$num_s[29]','$num_s[30]',
			'$num_s[31]','$num_s[32]','$num_s[33]','$num_s[34]','$num_s[35]',
			'$num_s[36]','$num_s[37]','$num_s[38]','$num_s[39]','$num_s[40]',
			'$num_s[41]','$num_s[42]','$num_s[43]','$num_s[44]','$num_s[45]',
			'$num_s[46]','$num_s[47]','$num_s[48]','$num_s[49]','$num_s[50]');";

	$result = mysqli_query($conn,$insert);

	$sql_2 = "SELECT * from exam_history where num = (SELECT max(num) FROM exam_history);";
	$result_2 = mysqli_query($conn,$sql_2);
	$row_2 = mysqli_fetch_assoc($result_2); 

	$paper_num = $row_2['num'];
	echo "paper_num".$paper_num;

	$sql_1 = "
		CREATE TABLE IF NOT EXISTS `exam_$paper_num` (
		  `students_num` varchar(20) NOT NULL,
		  `flag` int(11) NOT NULL DEFAULT '0',
		  `t1` varchar(110) DEFAULT NULL COMMENT '考生作答',
		  `t2` varchar(110) DEFAULT NULL,
		  `t3` varchar(110) DEFAULT NULL,
		  `t4` varchar(110) DEFAULT NULL,
		  `t5` varchar(110) DEFAULT NULL,
		  `t6` varchar(110) DEFAULT NULL,
		  `t7` varchar(110) DEFAULT NULL,
		  `t8` varchar(110) DEFAULT NULL,
		  `t9` varchar(110) DEFAULT NULL,
		  `t10` varchar(110) DEFAULT NULL,
		  `t11` varchar(110) DEFAULT NULL,
		  `t12` varchar(110) DEFAULT NULL,
		  `t13` varchar(110) DEFAULT NULL,
		  `t14` varchar(110) DEFAULT NULL,
		  `t15` varchar(110) DEFAULT NULL,
		  `t16` varchar(110) DEFAULT NULL,
		  `t17` varchar(110) DEFAULT NULL,
		  `t18` varchar(110) DEFAULT NULL,
		  `t19` varchar(110) DEFAULT NULL,
		  `t20` varchar(110) DEFAULT NULL,
		  `t21` varchar(110) DEFAULT NULL,
		  `t22` varchar(110) DEFAULT NULL,
		  `t23` varchar(110) DEFAULT NULL,
		  `t24` varchar(110) DEFAULT NULL,
		  `t25` varchar(110) DEFAULT NULL,
		  `t26` varchar(110) DEFAULT NULL,
		  `t27` varchar(110) DEFAULT NULL,
		  `t28` varchar(110) DEFAULT NULL,
		  `t29` varchar(110) DEFAULT NULL,
		  `t30` varchar(110) DEFAULT NULL,
		  `t31` varchar(110) DEFAULT NULL,
		  `t32` varchar(110) DEFAULT NULL,
		  `t33` varchar(110) DEFAULT NULL,
		  `t34` varchar(110) DEFAULT NULL,
		  `t35` varchar(110) DEFAULT NULL,
		  `t36` varchar(110) DEFAULT NULL,
		  `t37` varchar(110) DEFAULT NULL,
		  `t38` varchar(110) DEFAULT NULL,
		  `t39` varchar(110) DEFAULT NULL,
		  `t40` varchar(110) DEFAULT NULL,
		  `t41` varchar(110) DEFAULT NULL,
		  `t42` varchar(110) DEFAULT NULL,
		  `t43` varchar(110) DEFAULT NULL,
		  `t44` varchar(110) DEFAULT NULL,
		  `t45` varchar(110) DEFAULT NULL,
		  `t46` varchar(110) DEFAULT NULL,
		  `t47` varchar(110) DEFAULT NULL,
		  `t48` varchar(110) DEFAULT NULL,
		  `t49` varchar(110) DEFAULT NULL,
		  `t50` varchar(110) DEFAULT NULL,
		  `s1` int(11) NOT NULL DEFAULT '0' COMMENT '考生得分',
		  `s2` int(11) NOT NULL DEFAULT '0',
		  `s3` int(11) NOT NULL DEFAULT '0',
		  `s4` int(11) NOT NULL DEFAULT '0',
		  `s5` int(11) NOT NULL DEFAULT '0',
		  `s6` int(11) NOT NULL DEFAULT '0',
		  `s7` int(11) NOT NULL DEFAULT '0',
		  `s8` int(11) NOT NULL DEFAULT '0',
		  `s9` int(11) NOT NULL DEFAULT '0',
		  `s10` int(11) NOT NULL DEFAULT '0',
		  `s11` int(11) NOT NULL DEFAULT '0',
		  `s12` int(11) NOT NULL DEFAULT '0',
		  `s13` int(11) NOT NULL DEFAULT '0',
		  `s14` int(11) NOT NULL DEFAULT '0',
		  `s15` int(11) NOT NULL DEFAULT '0',
		  `s16` int(11) NOT NULL DEFAULT '0',
		  `s17` int(11) NOT NULL DEFAULT '0',
		  `s18` int(11) NOT NULL DEFAULT '0',
		  `s19` int(11) NOT NULL DEFAULT '0',
		  `s20` int(11) NOT NULL DEFAULT '0',
		  `s21` int(11) NOT NULL DEFAULT '0',
		  `s22` int(11) NOT NULL DEFAULT '0',
		  `s23` int(11) NOT NULL DEFAULT '0',
		  `s24` int(11) NOT NULL DEFAULT '0',
		  `s25` int(11) NOT NULL DEFAULT '0',
		  `s26` int(11) NOT NULL DEFAULT '0',
		  `s27` int(11) NOT NULL DEFAULT '0',
		  `s28` int(11) NOT NULL DEFAULT '0',
		  `s29` int(11) NOT NULL DEFAULT '0',
		  `s30` int(11) NOT NULL DEFAULT '0',
		  `s31` int(11) NOT NULL DEFAULT '0',
		  `s32` int(11) NOT NULL DEFAULT '0',
		  `s33` int(11) NOT NULL DEFAULT '0',
		  `s34` int(11) NOT NULL DEFAULT '0',
		  `s35` int(11) NOT NULL DEFAULT '0',
		  `s36` int(11) NOT NULL DEFAULT '0',
		  `s37` int(11) NOT NULL DEFAULT '0',
		  `s38` int(11) NOT NULL DEFAULT '0',
		  `s39` int(11) NOT NULL DEFAULT '0',
		  `s40` int(11) NOT NULL DEFAULT '0',
		  `s41` int(11) NOT NULL DEFAULT '0',
		  `s42` int(11) NOT NULL DEFAULT '0',
		  `s43` int(11) NOT NULL DEFAULT '0',
		  `s44` int(11) NOT NULL DEFAULT '0',
		  `s45` int(11) DEFAULT '0',
		  `s46` int(11) NOT NULL DEFAULT '0',
		  `s47` int(11) NOT NULL DEFAULT '0',
		  `s48` int(11) NOT NULL DEFAULT '0',
		  `s49` int(11) DEFAULT '0',
		  `s50` int(11) NOT NULL DEFAULT '0',
		  `score_1` int(11) NOT NULL DEFAULT '0' COMMENT '客观题总分',
		  `score_2` int(11) NOT NULL DEFAULT '0' COMMENT '主观题总分',
		  `score` int(11) NOT NULL DEFAULT '0' COMMENT '得分',
		  `scoreRank` int(11) NOT NULL DEFAULT '0' COMMENT '名次',
		  PRIMARY KEY (`students_num`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	;";

	$result_1 = mysqli_query($conn,$sql_1);

	if ($result)
   		echo "<script>alert('添加成功！');window.location.href='$url_1';</script>";
   	else
   		echo "<script>alert('添加失败！请按规则输入！');window.location.href='$url_2';</script>";
