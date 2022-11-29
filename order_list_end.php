<?php require('lib/top.php'); ?>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/order_mall.css">
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/bar.css">
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
   	<div id="order_box">
	    <h3>
	    	포인트몰 상품권
		</h3>
	    <ul id="order_list">
				<li>
					<span class="col1">상품명</span>
          <span class="col2">핀번호</span>
          <span class="col3">상태</span>
				</li>
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

  $con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
  $sql = "select * from point_mall_buy where id='$_SESSION[userid]' and order_check ='구매완료' order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result);

	$scale = 8;

	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1;

	$start = ($page - 1) * $scale;

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);

      $row = mysqli_fetch_array($result);

	    $num            = $row["num"];
	    $id             = $row["id"];
      $pin_number     = $row["pin_number"];
	    $product_name   = $row["product_name"];
      $order_check     = $row["order_check"];

?>
				<li>
					<span class="col1" align="center"><?=$product_name?></a></span>
          <span class="col2"><?=$pin_number?></span>
          <span class="col5"><?=$order_check?></span>
				</li>
<?php
   	   $number--;
   }
   mysqli_close($con);

?>
	    	</ul>
			<ul id="page_num">
<?php
	if ($total_page>=2 && $page >= 2)
	{
		$new_page = $page-1;
		echo "<li><a href='order_list_end.php?page=$new_page'>◀ 이전</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";

   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='order_list_end.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)
   	{
		$new_page = $page+1;
		echo "<li> <a href='order_list_end.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";
?>

			</ul>
      <ul class="buttons">
					<button onclick="location.href='order_list.php'">주문현황</button>
			</ul>
	</div>
</section>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php require('lib/bottom.php'); ?>
