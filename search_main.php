<?php require('lib/top.php'); ?>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/main.css">
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/bar.css">
</head>
<body>
<?php
	$search = $_POST["search"];

if($search == ""){
	echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
}
else {?>
  <header>
      	<?php include "header.php";?>
    </header>
    <?php
		if (isset($_GET["page"]))
			$page = $_GET["page"];
		else
			$page = 1;

		$con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
		$sql = "select * from product_my where id='이민형' and (product_name like '%$search%' or memo like '%$search%') order by num desc";
		$result = mysqli_query($con, $sql);
		$total_record = mysqli_num_rows($result);
    if($total_record==0){
      echo "<script>
  				alert('겸색 결과가 없습니다!');
  				location.href = 'index.php';
  				</script>";
    }else{
		$scale = 16;

		if ($total_record % $scale == 0)
			$total_page = floor($total_record/$scale);
		else
			$total_page = floor($total_record/$scale) + 1;

		$start = ($page - 1) * $scale;

		?>
	 <table  cellspacing="15" cellpadding="15">
	 <?php

		$number = $total_record - $start;

	   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
	   {
	      mysqli_data_seek($result, $i);

	      $row = mysqli_fetch_array($result);

		    $num            = $row["num"];
		    $id             = $row["id"];
		    $name           = $row["name"];
		    $product_name   = $row["product_name"];
	      $memo           = $row["memo"];
	      $price          = $row["price"];
	      $regist_day     = $row["regist_day"];
	      $file_copied     = $row["file_copied"];

	?>

	<td style="text-align:center;">
		<a href=basket_want.php?num=<?=$num?>>
		<img src="./data/<?=$file_copied?>" width="200px" height="200px"><br>
		<?=$product_name?><br>
		<?=$memo?><br>
		<?=number_format($price)?>원
		</td>
		<?php
		if(($i+1)%4==0){?>
			<tr></tr>
		<?php
			}
		 ?>



	<?php
	   	   $number--;
	   }?>
	 </table>
	   <?php
	   mysqli_close($con);

	?>

				<ul id="page_num" >
	<?php
		if ($total_page>=2 && $page >= 2)
		{
			$new_page = $page-1;
			echo "<li><a href='index.php?page=$new_page'>◀ 이전</a> </li>";
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
				echo "<li><a href='index.php?page=$i'> $i </a><li>";
			}
	   	}
	   	if ($total_page>=2 && $page != $total_page)
	   	{
			$new_page = $page+1;
			echo "<li> <a href='index.php?page=$new_page'>다음 ▶</a> </li>";
		}
		else
			echo "<li>&nbsp;</li>";
	?>
	</ul>

<?php
}
}
?>
<?php require('lib/bottom.php'); ?>
	<script src="js/jquery-2.1.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

