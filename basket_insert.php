<?php
session_start();
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";

$num   = $_POST["num"];
$count  = $_POST["count"];

$con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
$sql = "select * from product_my where num=$num";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$product_name   = $row["product_name"];
$memo           = $row["memo"];
$price          = $row["price"];
$file_copied    = $row["file_copied"];

$totalmoney = $count * $price;

  $sql = "insert into basket_my(id, name, product_name, price, count, file_copied ,totalmoney) ";
  $sql .= "values('$userid', '$username','$product_name', '$price', '$count', '$file_copied','$totalmoney')";
	mysqli_query($con, $sql);
	mysqli_close($con);
  ?>

	<script>
	if(confirm("장바구니에 담겼습니다.\n확인을 누르면 장바구니로 이동합니다.\n쇼핑을 계속하시려면 취소를 눌러주세요.")){
		location.href="basket_list.php?id=<?=$userid?>";
	}else{
		location.href="index.php";
	}
</script>
