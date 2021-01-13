<!DOCTYPE HTML>
<html lang="">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>考试进行中...</title>
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
    <link href="css/iconfont.css" rel="stylesheet" type="text/css"/>
    <link href="css/test.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<div class="main">
    <div class="test_main">
        <div class="nr_left">
            <div class="test">
                <form action="paper_submit.php" method="post">
                    <div class="test_title">
                        <p class="test_time">
                            <i class="icon iconfont">&#xe6fb;</i><b
                                    class="alt-1">
                                <?php
                                include ('../conn.php');
                                $paper_num = $_GET['num'];
                                $sql_1 = "SELECT * FROM exam_history WHERE num = $paper_num;";
                                $result_1 = mysqli_query($conn, $sql_1);
                                $row_1 = mysqli_fetch_assoc($result_1);
                                echo($row_1['duration']); ?></b>
                        </p>
                        <input type="button" name="test_jiaojuan" id="tijiao" value="交卷"
                               onclick="confirm1();">
                    </div>

                    <div class="test_content_nr">
                        <ul>
                            <?php
                            date_default_timezone_set('PRC');
                            $time_start = $row_1['time_start'];//规定
                            $time_end = $row_1['duration'];//规定
                            $time_now = date("Y-m-d H:i:s");
                            //现在时间减去规定时间，若是小于零则说明未开始考试
                            if (strtotime($time_now) - strtotime($time_start) < 0) {//对两个时间差进行差运算
                                $ZT = '未开始';
                            } else if (strtotime($time_now) - strtotime($time_end) > 0) {
                                $ZT = '已结束';
                            } else {
                                $ZT = '进行中';
                            }

                            $temp_type = 0;
                            $number_questions_A = 0;//选择题个数
                            $number_questions_B = 0;//填空
                            $number_questions_C = 0;//主观
                            for ($i = 1; $i < 50; $i++) {

                                if ($row_1['t' . $i] != 0) {

                                    $temp = $row_1['t' . $i];//临时存储题号
                                    $score = $row_1['s' . $i];//临时存储答案
                                    $sql_2 = "SELECT * FROM problems WHERE num = $temp;";//在题库中查找题号为temp得值
                                    $result_2 = mysqli_query($conn, $sql_2);
                                    $row_2 = mysqli_fetch_assoc($result_2);
                                    $ans = $row_2['ans'];

                                    if ($row_2['type'] == 1) {
                                        if ($row_2['type'] == 1 && $temp_type != 1) {
                                            echo "
										<div class=\"test_content\">
											<div class=\"test_content_title\">
												<h2>单选题：给定的答案中有且只有一个标准答案.</h2>
												</div>
										</div>
									";
                                            $temp_type = 1;
                                        }
                                        $temp_item = $row_2['item'];
                                        $tem_A = $row_2['A'];
                                        $tem_B = $row_2['B'];
                                        $tem_C = $row_2['C'];
                                        $tem_D = $row_2['D'];

                                        $number_questions_A++;//本次试卷选择题数

                                        echo "<input type=\"text\" name=\"a$i\" style=\"display:none;\" value=\"" . $ans . "\" >";
                                        echo "<input type=\"text\" name=\"s$i\" style=\"display:none;\" value=\"" . $score . "\" >";
                                        echo "
    	<li id=\"qu_0_$i\">
			<div class=\"test_content_nr_tt\">
			<i>$i</i>
			<font>$temp_item</font><b class=\"icon iconfont\">&#xe881;</b>
			</div>

			<div class=\"test_content_nr_main\">
			<ul>
				
					<li class=\"option\">
						
							<input type=\"radio\" class=\"radioOrCheck\" value=\"A\" name=\"t$i\"
								id=\"0_answer_1_option_1\"
							/>
						
						
						<label for=\"0_answer_1_option_1\">
							A.
							<p class=\"ue\" style=\"display: inline;\">$tem_A</p>
						</label>
					</li>
				
					<li class=\"option\">
						
							<input type=\"radio\" class=\"radioOrCheck\" value=\"B\" name=\"t$i\"
								id=\"0_answer_1_option_2\"
							/>
						
						
						<label for=\"0_answer_1_option_2\">
							B.
							<p class=\"ue\" style=\"display: inline;\">$tem_B</p>
						</label>
					</li>
				
					<li class=\"option\">
						
							<input type=\"radio\" class=\"radioOrCheck\" value=\"C\" name=\"t$i\"
								id=\"0_answer_1_option_3\"
							/>
						
						
						<label for=\"0_answer_1_option_3\">
							C.
							<p class=\"ue\" style=\"display: inline;\">$tem_C</p>
						</label>
					</li>
					<li class=\"option\">
							<input type=\"radio\" class=\"radioOrCheck\" value=\"D\" name=\"t$i\"
								id=\"0_answer_1_option_4\"
							/>											
						<label for=\"0_answer_1_option_4\">
							D.
							<p class=\"ue\" style=\"display: inline;\">$tem_D</p>
						</label>
					</li>				
			</ul>
			</div>
		</li>
								";
                                    } else if ($row_2['type'] == 2) {
                                        if ($row_2['type'] == 2 && $temp_type != 2) {
                                            echo "
										<div class=\"test_content\">
											<div class=\"test_content_title\">
												<h2>填空题</h2>
												</div>
										</div>
									";
                                            $temp_type = 2;
                                        }

                                        $temp_item = $row_2['item'];
                                        $number_questions_B++;//本次试卷填空提数
                                        echo "
		<div class=\"test_content_nr\">
			<ul>
				
				<li id=\"qu_0_$i\">
					<div class=\"test_content_nr_tt\">
						<i>$i</i><font>$temp_item</font><b class=\"icon iconfont\">&#xe881;</b>
					</div>

					<div class=\"test_content_nr_main\">
						<input type=\"text\" name=\"t$i\" style=\" font-size: 2em; width: 50%;border:none;border-radius:0;border-bottom:#8D8D8D 1px solid; box-shadow: 0px 0px 0px 0px;\" >
					</div>
				</li>
			
			</ul>
		</div>
		";
                                        echo "<input type=\"hidden\" name=\"a$i\" value=\"" . $ans . "\" >";
                                        echo "<input type=\"hidden\" name=\"s$i\" value=\"" . $score . "\" >";
                                    } else if ($row_2['type'] == 3) {
                                        if ($row_2['type'] == 3 && $temp_type != 3) {
                                            echo "
										<div class=\"test_content\">
											<div class=\"test_content_title\">
												<h2>主观题</h2>
												</div>
										</div>
									";
                                            $temp_type = 3;
                                        }
                                        $temp_item = $row_2['item'];
                                        $number_questions_C++;
                                        echo "
		<div class=\"test_content_nr\">
			<ul>
				
				<li id=\"qu_0_$i\">
					<div class=\"test_content_nr_tt\">
						<i>$i</i><font>$temp_item</font><b class=\"icon iconfont\">&#xe881;</b>
					</div>

					<div class=\"test_content_nr_main\">
						<textarea class=\"form-control\" name=\"t$i\" rows=\"3\" style=\"width:100%;font-size:1.5em;\" ></textarea>
					</div>
				</li>
			
			</ul>
		</div>
		";
                                    }
                                }
                            }
                            $number_questions = $number_questions_C + $number_questions_A + $number_questions_B;
                            $number_B = $number_questions_A + $number_questions_B;
                            echo "<input type=\"text\" name=\"numberQuestions\" style=\"display:none;\" value=\"" . $number_questions . "\" >";
                            echo "<input type=\"text\" name=\"paperNum\" style=\"display:none;\" value=\"" . $paper_num . "\" >";
                            ?>
                        </ul>
                    </div>


                </form>
            </div>

        </div>
        <div class="nr_right">
            <div class="nr_rt_main">
                <div class="rt_nr1">
                    <div class="rt_nr1_title">
                        <h1>
                            <i class="icon iconfont">&#xe692;</i>答题卡
                        </h1>
                        <p class="test_time">
                            <i class="icon iconfont">&#xe6fb;</i><b class="alt-1"><?php echo($row_1['duration']); ?></b>
                        </p>
                    </div>

                    <div class="rt_content">
                        <div class="rt_content_tt">
                            <h2>单选题</h2>
                        </div>
                        <div class="rt_content_nr answerSheet">
                            <ul>
                                <?php
                                for ($i = 1; $i <= $number_questions_A; $i++) {
                                    echo "<li><a href=\"#qu_0_$i\">$i</a></li>";
                                }

                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="rt_content">
                        <div class="rt_content_tt">
                            <h2>填空题</h2>
                        </div>
                        <div class="rt_content_nr answerSheet">
                            <ul>

                                <?php
                                for (; $i <= $number_B; $i++) {
                                    echo "<li><a href=\"#qu_0_$i\">$i</a></li>";
                                }

                                ?>

                            </ul>
                        </div>
                    </div>

                    <div class="rt_content">
                        <div class="rt_content_tt">
                            <h2>主观题</h2>
                        </div>
                        <div class="rt_content_nr answerSheet">
                            <ul>

                                <?php
                                for (; $i <= $number_B + $number_questions_C; $i++) {
                                    echo "<li><a href=\"#qu_0_$i\">$i</a></li>";
                                }

                                ?>

                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--nr end-->
    <div class="foot"></div>
</div>

<script src="jquery-1.11.3.min.js"></script>
<script src="jquery.easy-pie-chart.js"></script>
<!--时间js-->
<script src="time/jquery.countdown.js"></script>
<script>

    window.jQuery(function ($) {
        "use strict";

        $('time').countDown({
            with_separators: false
        });
        $('.alt-1').countDown({
            css_class: 'countdown-alt-1'
        });
        $('.alt-2').countDown({
            css_class: 'countdown-alt-2'
        });

    });


    $(function () {
        $('li.option label').click(function () {
            debugger;
            var examId = $(this).closest('.test_content_nr_main').closest('li').attr('id'); // 得到题目ID
            var cardLi = $('a[href=#' + examId + ']'); // 根据题目ID找到对应答题卡
            // 设置已答题
            if (!cardLi.hasClass('hasBeenAnswer')) {
                cardLi.addClass('hasBeenAnswer');
            }

        });
    });

    function confirm1() {
        var flag = confirm('是否确认提交?');
        if (flag) {
            document.getElementById('tijiao').type = 'submit';
            if (flag) {
                document.getElementById('tijiao').type = 'submit';
                //document.getElementsByName('test_jiaojuan').type = 'submit';
            }
        }

    }
</script>

</body>

</html>