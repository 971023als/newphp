<?php
session_start();
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";


$num   = $_POST["num"];
$count  = $_POST["count"];


$con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
$sql = "select * from point_mall where num=$num";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$product_name   = $row["product_name"];
$point          = $row["point"];

$totalpoint = $count * $point;

$sql = "select * from members where id = '$userid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$userpoint   = $row["point"];

	mysqli_close($con);


if($userpoint < $totalpoint){
  echo("<script>
      alert('보유포인트가 부족합니다!');
      history.go(-1);
      </script>
    ");
}else {
  ?>
  <script>
		location.href="point_mall_buy_03.php?num=<?=$num?>&id=<?=$userid?>&totalpoint=<?=$totalpoint?>&count=<?=$count?>";

</script>

<?php }
?>