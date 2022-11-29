<?php


  $num   = $_GET["num"];


	$con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
	$sql = "select * from point_mall where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

  $num            = $row["num"];
  $product_name   = $row["product_name"];
  $point          = $row["point"];
  $file_copied     = $row["file_copied"];

  ?>

<?php require('lib/top.php'); ?>
  <link rel="stylesheet" type="text/css" href="./css/common.css">
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
  <center>
    <form name="wantbasket" method="post" action="point_mall_buy_02.php">
      <input type="hidden" name="num" value="<?=$num?>">
      <table border="0" cellspacing="50" cellpadding="10">
        <tr>
          <td><img src="./data/<?=$file_copied?>"></td>
          <td><b><?=$product_name?></b><br><br>
                  <?=number_format($point)?>P<br><br>
                  <select name="count">
                    <option value="1">1</option>
                    <script type="text/javascript">
                    for(var i = 2; i < 11; i++){
                      document.write("<option value="+i+">"+i+"</option>");
                    }
                    </script>
                    </select><br><br>

                    <input type="submit" value="구매하기"><br><br>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding-top:50px" align="center">
                      <input type="button" onClick="location.href='point_mall_index.php'" value="목록으로"></td>
                  </tr>
                </table><br><br>
              </form>
            </center>
  <script src="js/jquery-2.1.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <?php require('lib/bottom.php'); ?>
