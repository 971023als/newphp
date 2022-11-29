<? php
     $conn = new mysqli("localhost", "user", "1q2w3e4r", "sample");
     mysqli_query($conn, "set names uft8");
    $sql ="INSERT INTO `blog1` (`num`, `tilte`, `category`, `content`, `id`, `img_file`, `img_size`, `name`, `del_flg`, `reg_date`, `mod_date`) VALUES (NULL, '테스트입니다.', '테스트', '테스트 컨텐츠입니다.', '971023als', NULL, NULL, '테스트 1', NULL, current_timestamp(), NULL);";
    $result = mysqli_query($con, $sql);

   $num_match = mysqli_num_rows($result);
    ?>