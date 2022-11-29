<?php
$num  = $_GET["num"];
$userid = $_GET["id"];
$totalpoint = $_GET["totalpoint"];
$count = $_GET["count"];

$con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
$sql = "select * from point_mall where num=$num";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);


$product_name     = $row["product_name"];
$point         = $row["point"];

mysqli_close($con);

?>

<?php require('lib/top.php'); ?>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/basket.css">
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/bar.css">
<script>
  function check_order() {
      if (!document.basket_order_form.phone.value)
      {
          alert("휴대번호를 입력하세요!");
          document.basket_order_form.phone.focus();
          return;
      }
      document.basket_order_form.submit();
   }
</script>
<body>

<?php
	if (!$userid )
	{
		echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
		exit;
	}
?>
<section>

   	<div id="basket_box">
	    <h3 id="basket_title">
	    		번호입력
		</h3>
	    <form  name="basket_order_form" method="post" action="point_mall_buy_04.php?totalpoint=<?=$totalpoint?>&count=<?=$count?>&product_name=<?=$product_name?>" enctype="multipart/form-data">
	    	 <ul id="basket_form">
				<li>
					<span class="col1">상품명 : </span>
					<span class="col2"><?=$product_name?></span>
				</li>
	    		<li>
	    			<span class="col1">수량 : </span>
	    			<span class="col2"><?=$count?>개</span>
	    		</li>
          <li>
	    			<span class="col1">가격 : </span>
	    			<span class="col2"><?=number_format($totalpoint)?>P</span>
	    		</li>
          <li>
	    			<span class="col1">휴대번호 : </span>
	    			<span class="col2"><input type="text" name="phone"></span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_order()">완료</button></li>
				<li><button type="button" onclick="location.href='point_mall_index.php'">목록</button></li>
			</ul>
	    </form>
	</div>
</section>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php require('lib/bottom.php'); ?>
  