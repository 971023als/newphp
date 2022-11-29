<?php
    $num = $_GET["num"];
    $page = $_GET["page"];


    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $memo = $_POST["memo"];

    $con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
    $sql = "update product_my set product_name='$product_name', price='$price', memo='$memo'";
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'product_list.php?page=$page';
	      </script>
	  ";
?>
