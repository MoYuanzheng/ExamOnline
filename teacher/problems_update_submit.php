<?php
include('../conn.php');

$num = $_POST['num'];
$item = $_POST['item'];
$sel_A = $_POST['sel_A'];
$sel_B = $_POST['sel_B'];
$sel_C = $_POST['sel_C'];
$sel_D = $_POST['sel_D'];
$ans = $_POST['ans'];
$exp = $_POST['exp'];

$url_1 = "problems_show.php?kind=1";//成功
$url_2 = "problems_show.php?kind=1";//失败

$sql = " UPDATE problems SET 
                     item = '$item', 
                     A = '$sel_A',
                     B = '$sel_B',
                     C = '$sel_C',
                     D = '$sel_D',
                     ans = '$ans',
                     exp = '$exp'  
            WHERE num = '$num'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('修改成功！');window.location.href='$url_1';</script>";
} else {
    echo "<script>alert('修改信息有误！重新填写');window.location.href='$url_2';</script>";
}
