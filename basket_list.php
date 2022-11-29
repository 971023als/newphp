<?php require('lib/top.php'); ?>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/basket.css">
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
   	<div id="basket_box">
	    <h3>
	    	장바구니
		</h3>
	    <ul id="basket_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">상품명</span>
          <span class="col3">이미지</span>
          <span class="col4">가격</span>
          <span class="col5">수량</span>
					<span class="col6">금액</span>
          <span class="col7">기타</span>
				</li>
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

	$con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
    $sql = "select * from basket_my where id='$_SESSION[userid]' order by num desc";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);

	$scale = 1;

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);

      $row = mysqli_fetch_array($result);

      $num            = $row["num"];
      $id             = $row["id"];
      $name           = $row["name"];
      $product_name   = $row["product_name"];
      $price          = $row["price"];
      $count          = $row["count"];
      $file_copied     = $row["file_copied"];
      $totalmoney     = $row["totalmoney"];
?>
				<li>
					<span class="col1" align="center"><?=$number?></span>
					<span class="col2"><?=$product_name?></a></span>
          <span class="col3"><img src="./data/<?=$file_copied?>" width="200px" height="200px"></span>
          <span class="col4"><?=number_format($price)?>원</span>
					<span class="col5"><?=$count?>개</span>
					<span class="col6"><?=number_format($totalmoney)?>원</span>
          <span class="col7"><a href="basket_order_form.php?num=<?=$num?>&page=<?=$page?>&id=<?=$_SESSION['userid']?>">주문하기</a><br><br>
          <a href="basket_delete.php?num=<?=$num?>&page=<?=$page?>">삭제</a></span>
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
		echo "<li><a href='basket_list.php?page=$new_page'>◀ 이전</a> </li>";
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
			echo "<li><a href='basket_list.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)
   	{
		$new_page = $page+1;
		echo "<li> <a href='basket_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";
?>
			</ul>
	</div>
</section>

<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php require('lib/bottom.php'); ?>

