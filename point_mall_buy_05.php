<?php
session_start();
if (isset($_SESSION["userid"])) $id = $_SESSION["userid"];
else $userid = "";

    $totalpoint = $_GET["totalpoint"];
    $count = $_GET["count"];
    $product_name = $_GET["product_name"];

    $id = $_SESSION["userid"];

    $con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $point = $row["point"];

    $newpoint = $point - $totalpoint;

    $sql = "update members set point='$newpoint'";
    $sql .= " where id='$id'";
    mysqli_query($con, $sql);

    $_SESSION["userpoint"] = $newpoint;

    for($i = 0; $i < $count; $i++){

    $value1=rand(1000, 9999);
    $value2=rand(1000, 9999);
    $value3=rand(1000, 9999);
    $value4=rand(100000, 999999);

    $pin_number = $value1." ".$value2." ".$value3." ".$value4;


    $sql = "insert into point_mall_buy(product_name, pin_number, id, order_check) ";
    $sql .= "values('$product_name', '$pin_number','$id','구매완료')";
    mysqli_query($con, $sql);
    }




    mysqli_close($con);


  echo "
	      <script>
        alert('사용자의 번호로 PIN번호를 보내드렸습니다.');
	          location.href = 'point_mall_index.php';
	      </script>
	  ";
?>
