
<?php require('lib/top.php'); ?>
<?php require('blog_top.php'); ?>
<style>
  table, th, td {
    border: 1px solid #bcbcbc;
    margin-left:auto;
    margin-right:auto;
    width: 200px;
    height: 50px;
  }
.btn-like .heart-shape {
    display: inline;
    color: red;
}
.btn-like {
    border: none;
    background-color: inherit;
}

  
</style>
<link rel="stylesheet" type="text/css" href="./css/board.css">
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
	  $file_name    = $row["file_name"];
	  $file_type    = $row["file_type"];
	  $file_copied  = $row["file_copied"];
      $hit         = $row["hit"];
      if ($row["file_name"])
      	$file_image = "<img src='./img/file.gif'>";
      else
      	$file_image = " ";
?>
	    <!-- 1 start -->
        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                <table><img src="./data/<?=$file_copied?>">
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i><?=$regist_day?></li>
                                        <li><i class="fa fa-comment-o"></i><?=$name?></li>
                                        <li><a href="#"><?=$subject?></a></li>
                                        <li><a href="./board_view.php?num=<?=$num?>&page=<?=$page?>" class="blog__btn">자세한 내용<span class="arrow_right"></span></a></li>
                                        <li>
  
  
</div>
</div>
</div>
		</div>

                                        </ul>                               
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
   	   $number--;
   }
   mysqli_close($con);

?>
	    	</ul>   	
			<div class="buttons">
				<button onclick="location.href='board_list.php'">목록</button>
				
<?php 
    if($userid) {
?>
					<button onclick="location.href='board_form.php'">글쓰기</button>
<?php
	} else {
?>
					<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
<?php
	}
?>
</div>
        <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                            </div>
	</div> <!-- board_box -->
    </section>
    <!-- Blog Section End -->

    <?php require('lib/bottom.php'); ?>
