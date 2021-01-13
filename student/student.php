<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>个人信息</title>
</head>
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.staticfile.org/echarts/4.3.0/echarts.min.js"></script>
<script src="https://unpkg.com/vue/dist/vue.js"></script>

<body>
<div class="jumbotron text-center" style="margin-bottom:0;margin-top:0;max-height: 10%;">
  <h1>在线考试系统</h1>
    <?php include('../conn.php');
    session_start();
    $username = $_SESSION['username'];
    ?>
  <p>欢迎您：<strong><?php echo $_SESSION['realname']; ?></strong>同学 <a href="../destroy.php">注销</a></p>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav" id="nav">
    <li class="nav-item" v-for="(tagName, index) in tagNames_tch">
      <a :class="isActiveClass(urls_tch[index])" :href='urls_tch[index]'>{{ tagName }}</a>
    </li>
  </ul>
</nav>

<?php
//拿到试卷主键
$sql_paper = "SELECT * FROM exam_history ORDER BY num desc;";
$result_paper = mysqli_query($conn, $sql_paper);
$i = 0;
while ($row_paper = mysqli_fetch_assoc($result_paper)) {
    $paper_name[$i] = $row_paper['paper_name'];
    $paper_num = $row_paper['num'];
    //通过试卷主键与session的用户ID找到成绩
    $sql_student = "SELECT * FROM exam_$paper_num WHERE students_num = '$username' ;";
    $result_student = mysqli_query($conn, $sql_student);
    $row_student = mysqli_fetch_assoc($result_student);
    $rank[$i] = @$row_student['scoreRank'];
    $score[$i] = @$row_student['score'];
    $i++;
}
$rank = json_encode($rank);
$score = json_encode($score);
$paper_name = json_encode($paper_name);
echo "
    <script>
        let rank = $rank; 
        let score = $score;
        let paper_name = $paper_name;
    </script>
";

?>
<div id="main" style="width: 90%;height:500px;margin-left: 4%;"></div>

</body>
<script>
    //Echarts
    let myChart = echarts.init(document.getElementById('main'));
    const colorList = ["#9E87FF", '#73DDFF', '#fe9a8b', '#F56948', '#9E87FF']
    let option = {
        backgroundColor: '#fff',
        title: {
            text: '成绩统计',
            textStyle: {
                fontSize: 12,
                fontWeight: 400
            },
            left: 'center',
            top: '5%'
        },
        legend: {
            icon: 'circle',
            top: '5%',
            right: '5%',
            itemWidth: 6,
            itemGap: 20,
            textStyle: {
                color: '#556677'
            }
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                label: {
                    show: true,
                    backgroundColor: '#fff',
                    color: '#556677',
                    borderColor: 'rgba(0,0,0,0)',
                    shadowColor: 'rgba(0,0,0,0)',
                    shadowOffsetY: 0
                },
                lineStyle: {
                    width: 0
                }
            },
            backgroundColor: '#fff',
            textStyle: {
                color: '#5c6c7c'
            },
            padding: [10, 10],
            extraCssText: 'box-shadow: 1px 0 2px 0 rgba(163,163,163,0.5)'
        },
        grid: {
            top: '15%'
        },
        xAxis: [{
            type: 'category',
            inverse:true,
            axisLine: {
                lineStyle: {
                    color: '#DCE2E8'
                }
            },
            axisTick: {
                show: false
            },
            axisLabel: {
                interval: 0,
                textStyle: {
                    color: '#556677'
                },
                // 默认x轴字体大小
                fontSize: 12,
                // margin:文字到x轴的距离
                margin: 15
            },
            axisPointer: {
                label: {
                    // padding: [11, 5, 7],
                    padding: [0, 0, 10, 0],
                    /*
                      除了padding[0]建议必须是0之外，其他三项可随意设置
                      和CSS padding相同，[上，右，下，左]
                      如果需要下边线超出文字，设左右padding即可，注：左右padding最好相同
                      padding[2]的10:
                      10 = 文字距下边线的距离 + 下边线的宽度
                      如：UI图中文字距下边线距离为7 下边线宽度为2
                      则padding: [0, 0, 9, 0]
                    */
                    // 这里的margin和axisLabel的margin要一致!
                    margin: 15,
                    // 移入时的字体大小
                    fontSize: 12,
                    backgroundColor: {
                        type: 'linear',
                        x: 0,
                        y: 0,
                        x2: 0,
                        y2: 1,
                        colorStops: [{
                            offset: 0,
                            color: '#fff' // 0% 处的颜色
                        }, {
                            // offset: 0.9,
                            offset: 0.86,
                            /*
                            0.86 = （文字 + 文字距下边线的距离）/（文字 + 文字距下边线的距离 + 下边线的宽度）
                            */
                            color: '#fff' // 0% 处的颜色
                        }, {
                            offset: 0.86,
                            color: '#33c0cd' // 0% 处的颜色
                        }, {
                            offset: 1,
                            color: '#33c0cd' // 100% 处的颜色
                        }],
                        global: false // 缺省为 false
                    }
                }
            },
            boundaryGap: false
        }],
        yAxis: [
            {
                type: 'value',
                axisTick: {
                    show: false
                },
                axisLine: {
                    show: true,
                    lineStyle: {
                        color: '#DCE2E8'
                    }
                },
                axisLabel: {
                    textStyle: {
                        color: '#556677'
                    }
                },
                splitLine: {
                    show: false
                }
            },
            {
                type: 'value',
                position: 'right',
                axisTick: {
                    show: false
                },
                inverse: true,
                minInterval: 1,
                max: 50,
                min: 1,
                axisLabel: {
                    textStyle: {
                        color: '#556677'
                    },
                    formatter: '{value}'
                },
                axisLine: {
                    show: true,
                    lineStyle: {
                        color: '#DCE2E8'
                    }
                },
                splitLine: {
                    show: false
                }
            }],
        series: [
            {
            name: '分数',
            type: 'line',
            // 数据
            symbolSize: 1,
            symbol: 'circle',
            smooth: true,
            yAxisIndex: 0,
            showSymbol: false,
            lineStyle: {
                width: 5,
                color: new echarts.graphic.LinearGradient(0, 1, 0, 0, [{
                    offset: 0,
                    color: '#9effff'
                },
                    {
                        offset: 1,
                        color: '#9E87FF'
                    }
                ]),
                shadowColor: 'rgba(158,135,255, 0.3)',
                shadowBlur: 10,
                shadowOffsetY: 20
            },
            itemStyle: {
                normal: {
                    color: colorList[0],
                    borderColor: colorList[0]
                }
            }
        }, {
            name: '排名',
            type: 'line',
            // data: [],
            symbolSize: 1,
            yAxisIndex: 1,
            symbol: 'circle',
            smooth: true,
            showSymbol: false,
            lineStyle: {
                width: 5,
                color: new echarts.graphic.LinearGradient(0, 0, 1, 0, [{
                    offset: 0,
                    color: '#fe9a'
                },
                    {
                        offset: 1,
                        color: '#fe9a8b'
                    }
                ]),
                shadowColor: 'rgba(254,154,139, 0.3)',
                shadowBlur: 10,
                shadowOffsetY: 20
            },
            itemStyle: {
                normal: {
                    color: colorList[2],
                    borderColor: colorList[2]
                }
            }
        }
        ]
    };

    option.series[0].data = score;
    option.series[1].data = rank;
    option.xAxis[0].data = paper_name;
    myChart.setOption(option);
</script>
<script src="./js/nav.js"></script>

</html>