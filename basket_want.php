<?php
    $num   = $_GET["num"];

  $con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
	$sql = "select * from product_my where num= $num " ;
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

  $num_match = mysqli_num_rows($result);

  $num            = $row["num"];
  $id             = $row["id"];
  $name           = $row["name"];
  $product_name   = $row["product_name"];
  $memo           = $row["memo"];
  $price          = $row["price"];
  $regist_day     = $row["regist_day"];
  $file_copied     = $row["file_copied"];
  ?>

<?php require('lib/top.php'); ?>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/basket.css">
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/bar.css">
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
    <form name="basket" method="post" action="basket_insert.php">
      <input type="hidden" name="num" value="<?=$_GET['num']?>">
      <table border="0" cellspacing="50" cellpadding="10">
        <tr>
          <td><img src="./data/<?=$file_copied?>"width="200px" height="200px" ></textarea></td>
          <td><b><?=$product_name?></b><br><br>
                <?=$memo?><br><br>
                <?=number_format($price)?>원<br><br>
                  수량 :

                  <select name="count">
                    <option value="1">1</option>
                    <script type="text/javascript">
                    for(var i = 2; i < 501; i++){
                      document.write("<option value="+i+">"+i+"</option>");
                    }
                    </script>
                    </select><br><br>
                    <input type="submit" value="장바구니담기"><br><br>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding-top:50px" align="center">
                      <input type="button" onClick="location.href='index.php'" value="목록으로"></td>
                  </tr>
                </table><br><br>
              </form>
              <?php require('lib/bottom.php'); ?>
  <script src="js/jquery-2.1.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

