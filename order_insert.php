<?php
session_start();
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";

    $num  = $_GET["num"];
    $address2 = $_POST["address2"];
    $page  = $_GET["page"];


    $con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
    $sql = "select * from basket_my where num=$num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $product_name     = $row["product_name"];
    $price         = $row["price"];
    $count         = $row["count"];
    $totalmoney    = $row["totalmoney"];

    $sql = "select * from members where id='$userid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $address = $row["address"];



    $sql = "insert into order_my(id, name, product_name, price, count, totalmoney, address, address2, order_check) ";
    $sql .= " values('$userid', '$username','$product_name', '$price', '$count', '$totalmoney','$address','$address2','입금확인중')";
  	mysqli_query($con, $sql);


    $point_up = $totalmoney/10;

	$sql = "select point from members where id='$userid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$new_point = $row["point"] + $point_up;

	$sql = "update members set point=$new_point where id='$userid'";
	mysqli_query($con, $sql);




  	mysqli_close($con);

    $_SESSION["userpoint"] = $new_point;

  echo "
	      <script>
	          location.href = 'order_list.php';
	      </script>
	  ";
?>
