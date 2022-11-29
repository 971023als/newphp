<?php
    $id = $_GET["id"];

    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];
    $address  = $_POST["address"];

    $email = $email1."@".$email2;

    $con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
    $sql = "update members set pass='$pass', name='$name' , email='$email', address='$address'";
    $sql .= " where id='$id'";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>
