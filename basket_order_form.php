<?php
$num  = $_GET["num"];
$page = $_GET["page"];
$userid = $_GET["id"];

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
mysqli_close($con);

$address = $row["address"];
?>

<?php require('lib/top.php'); ?>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/basket.css">
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/bar.css">
<script>
  function check_order() {
      if (!document.basket_order_form.address2.value)
      {
          alert("상세 주소를 입력하세요!");
          document.basket_order_form.address2.focus();
          return;
      }
      document.basket_order_form.submit();
   }
</script>
</head>
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
	    		상세주소 등록 > 등록
		</h3>
	    <form  name="basket_order_form" method="post" action="order_insert.php?num=<?=$_GET['num']?>&page=<?=$_GET['page']?>" enctype="multipart/form-data">
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
	    			<span class="col2"><?=number_format($totalmoney)?>원</span>
	    		</li>
          <li>
	    			<span class="col1">주소 : </span>
	    			<span class="col2"><?=$address?></span>
	    		</li>
          <li>
	    			<span class="col1">상세주소 : </span>
	    			<span class="col2"> <input type="text" name="address2"></span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_order()">완료</button></li>
				<li><button type="button" onclick="location.href='basket_list.php'">목록</button></li>
			</ul>
			</form>
	</div>
</section>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php require('lib/bottom.php'); ?>
