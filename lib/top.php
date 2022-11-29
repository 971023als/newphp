<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
?>		
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>거래 참 잘하는 곳</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/message.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="./basket_list.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
        </div>
                  
        <?php
    if(!$userid) {
?>     
            <div class="header__top__right__language">
                <i class="arrow_carrot-down"><a href=".//member_form.php"></i> 회원가입</a>
            </div>
            <div class="header__top__right__auth">
                <i class="fa fa-user"><a href="./login_form.php"></i> 로그인</a>
                <i class="fa fa-user"><a href="./logout.php" ></i>로그아웃</a>
               </div>
            <?php
    } else {
                $logged = $username."(".$userid.")님[Level:".$userlevel.", Point:".$userpoint."]";
    }
?>
                        <li><a><?=$logged?></a> </li>
                          <li><a href="logout.php">로그아웃</a> </li>
                          <li><a href="member_modify_form.php">정보 수정</a></li>
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

	$con = mysqli_connect("localhost", "user", "1q2w3e4r", "sample");
	$sql = "select * from board order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수

	$scale = 10;

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
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
	  $num         = $row["num"];
	  $id          = $row["id"];
	  $name        = $row["name"];
	  $subject     = $row["subject"];
      $regist_day  = $row["regist_day"];
      $hit         = $row["hit"];
      if ($row["file_name"])
      	$file_image = "<img src='./img/file.gif'>";
      else
      	$file_image = " ";
?>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./order_list.php">주문현황</a></li>
                <li><a href="#">페이지</a>
                    <ul class="header__menu__dropdown">
                                    <li><a href="./product_form.php">상품등록</a></li>
                                    <li><a href="./product_list.php">상품목록</a></li>
                                    <li><a href="./basket_list.php">장바구니</a></li>
                                    <li><a href="./order_list.php">주문현황</a></li>
                    </ul>
                </li>
                <li><a href="blog.php">게시판</a></li>
                <li><a href="./point_mall_index.php">포인트몰</a></li>
            </ul>
            <?php
   	   $number--;
   }
   mysqli_close($con);

?>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> ls@naver.com</li>
                <li>거래 참 잘하는 곳</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> s@naver.com</li>
                                <li>거래 참 잘하는 곳</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>         
                            <?php
    if(!$userid) {
?>     
            <li><a href=".//member_form.php"></i> 회원가입</a>
            <li><a href="./login_form.php"></i> 로그인</a></li>
            <?php
    } else {
                $logged = $username."(".$userid.")님[Level:".$userlevel.", Point:".$userpoint."]";
?>
                <li><?=$logged?></li>
                <li><a href="logout.php" ></i>로그아웃</a></li>
                <li><a href="member_modify_form.php" ></i>정보수정</a></li>
                <?php
    } 
?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="./order_list.php">주문현황</a></li>
                            <li><a href="#">페이지</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./product_form.php">상품등록</a></li>
                                    <li><a href="./product_list.php">상품목록</a></li>
                                    <li><a href="./basket_list.php">장바구니</a></li>
                                    <li><a href="./order_list.php">주문현황</a></li>
                                </ul>
                            </li>
                            <li><a href="blog.php">게시판</a></li>
                            <li><a href="./point_mall_index.php">포인트몰</a></li>
                        </ul>
                        
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="./basket_list.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->


     <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                            <span>인기 검색어</span>
                        </div>
                        <ul>
                            <li><a href="#">포켓몬빵</a></li>
                            <li><a href="#">자전거</a></li>
                            <li><a href="#">의자</a></li>
                            <li><a href="#">냉장고</a></li>
                            <li><a href="#">캠핑</a></li>
                            <li><a href="#">아이패드</a></li>
                            <li><a href="#">아이폰</a></li>
                            <li><a href="#">노트북</a></li>
                            <li><a href="#">알바</a></li>
                            <li><a href="#">오토바이</a></li>
                            <li><a href="#">제습기</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                        <form name="search" action="./search_main.php" method="post">
                            <div class="hero__search__categories">
                            제목
                            <span class="arrow_carrot-down"></span>
                            </div>
                                <input type="text" name="search" placeholder="필요한 거 검색!!">
                                <button type="submit" name="tool" class="site-btn">검색</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__text">
                                <li><a href="./board_form.php"><i class="board_form"></i><span>글쓰기</span></a></li>
                                <li><a href="./message_form.php"><i class="message_form"></i> <span>메시지보내기</span></a></li>
                                <li><a href="./message_box.php"><i class="message_box"></i> <span>메시지함</span></a></li>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>사용 안하는 물건</span>
                            <h2>여기에서 <br />판매하세요</h2>
                            <p>폐기물 스티커 비용 아끼기</p>
                            <a href="./product_form.php" class="primary-btn">지금 판매</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
