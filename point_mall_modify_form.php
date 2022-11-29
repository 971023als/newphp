<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>상품 수정 목록</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/product.css">
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/bar.css">
<script>
function check_product() {
    if (!document.product_form.product_name.value)
    {
        alert("상품명을 입력하세요!");
        document.product_form.product_name.focus();
        return;
    }
    if (!document.product_form.point.value)
    {
        alert("포인트을 입력하세요!");
        document.product_form.point.focus();
        return;
    }
    document.product_form.submit();
 }
</script>
</head>
<body>
<header>
    <?php include "header.php";?>
</header>
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
   	<div id="product_box">
	    <h3 id="product_title">
	    		게시판 > 글 쓰기
		</h3>
<?php
	$num  = $_GET["num"];
	$page = $_GET["page"];

	$con = mysqli_connect("localhost", "user", "1q2w3e4r", "goodpang");
	$sql = "select * from point_mall where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$product_name    = $row["product_name"];
  $point            = $row["point"];
	$file_name       = $row["file_name"];
?>
	    <form  name="product_form" method="post" action="point_mall_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">
        <ul id="product_form">
         <li>
           <span class="col1">상품명 : </span>
           <span class="col2"><input name="product_name" type="text" value="<?=$product_name?>"></span>
         </li>
         <li>
           <span class="col1">포인트 : </span>
           <span class="col2"><input name="point" type="text" value="<?=$point?>"></span>
         </li>
         <li>
             <span class="col1" style : bottom-padding:"10px"> 첨부 파일</span>
             <span class="col2"><?=$file_name?> </span>
         </li>
           </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_product()">수정하기</button></li>
				<li><button type="button" onclick="location.href='point_mall_list.php'">목록</button></li>
			</ul>
	    </form>
	</div>
</section>
<footer style="background-color: #000000; color: #ffffff">
    <?php include "footer.php";?>
</footer>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
