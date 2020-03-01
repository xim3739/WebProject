<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" href="../../css/temporary_board/board.css">
<link rel="stylesheet" href="../../css/temporary_board/common.css">

<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<!-- Bootstrap core CSS -->
<link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../../css/main/small-business.css" rel="stylesheet">
<?php include "../../lib/common_page/main_style.php" ?>
<script src="../../js/main/pop_up_menu.js"></script>
<?php   session_start(); include "../../db/db_connector.php" ?>
<style media="screen">
  #list_item{
    border: 1px solid black;
  }
  #list_item1{
    border: 1px solid black;
    display: inline;
  }
  #list_item2{
    border: 1px solid black;
    display: inline;
  }
   #list_item3{
      border: 1px solid black;
      display: inline;
      float: right;
    }
</style>
</head>
<body>
  <?php include "../../lib/common_page/header.php" ?>
  <?php  //*****************************************************
  $id= $_SESSION['userid'];

  $r_sql=$r_result=$r_total_record=$r_start="";
  $r_total_record=0;

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  //*****************************************************
?>
<section>
   	<div id="board_box">
	    <h3 class="title">
			임시보호 > 내용보기
		</h3>
<?php
	$num  = $_GET["num"];

//========================여기까지만 보여주기
	$sql = "select * from temporary_board where num=$num";
	$result = mysqli_query($connect, $sql);

	$row = mysqli_fetch_array($result);

	$id      = $row["id"];
	$name      = $row["name"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];
	$hit          = $row["hit"];

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	$sql = "update temporary_board set hit=$new_hit where num=$num";
	mysqli_query($connect, $sql);
?>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?php
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "../../data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='temporary_board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			           	}

				?>
				<?=$content?>
			</li>
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='temporary_board_list.php?page=<?=$page?>'">목록</button></li>
				<li><button onclick="location.href='temporary_board_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
				<li><button onclick="location.href='temporary_board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
				<li><button onclick="location.href='temporary_board_form.php'">글쓰기</button></li>
		</ul>
	</div> <!-- board_box -->

<div id="list_content">
<!-- =====================================댓글 입력하는 부분========================= -->
<!-- 수정댓글쓰기, 대댓글쓰기, New댓글쓰기 세부분으로 분류했음 -->
<?php
$num=$id=$r_content=$day="";
$id= $_SESSION['userid'];

  $mode="reply";
if((isset($_GET["mode"])&&$_GET["mode"]=="update_reply")
  ||(isset($_GET["mode"])&&$_GET["mode"]=="re_reply") ){

    $mode=$_GET["mode"];//$mode="update_reply"or"re_reply"
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($connect, $num);

    //update 이면 해당된글, response이면 부모의 해당된글을 가져옴.
    $sql="SELECT * from `temporary_comment` where num ='$q_num';";
    $result = mysqli_query($connect,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);

    $id=$row['id'];

    $day=$row['regist_day'];

    if($mode == "re_reply"){
      $content="ㄴ";

    }
    mysqli_close($connect);
}
 ?>
 <form name="board_form" action="./qna_board.php?mode=<?=$mode?>" method="post">
   <input type="hidden" name="num" value="<?=$num?>">
   <div class="col1"><?=$id?></div>
   <input type="text" name="r_content" value="<?=$r_content?>"></input>
   <button type="submit" name="">등록</button>
</form>




    <!-- =====================================댓글 보여지는 부분========================= -->

  <?php
    $r_sql="SELECT * from `temporary_comment` order by group_num desc, ord asc;";
    $r_result=mysqli_query($connect, $r_sql);
    $r_total_record=mysqli_num_rows($r_result);

   for ($i = 0; $i < $r_total_record; $i++) {
       mysqli_data_seek($r_result, $i);
       $r_row=mysqli_fetch_array($r_result);
       $r_num=$r_row['num'];
       $r_id=$r_row['id'];
       $r_name=$r_row['name'];
       $r_date= substr($r_row['regist_day'], 0, 10);
       $r_content=$r_row['content'];
       $r_depth=(int)$r_row['depth'];//공간을 몆칸을 띄어야할지 결정하는 숫자임
       $r_space="";
       for ($j=0;$j<$r_depth;$j++) {
           $r_space="&nbsp;&nbsp;".$r_space;
       } ?>
     <div id="list_item">
       <div id="list_item1"><?=$r_space.$r_content?></div>
       <div id="list_item2"><?=$r_id?></div>
       <div id="list_item3"><?=$r_date?></div>
     </div><!--end of list_item -->
 <?php

   }//end of for
 ?>


</div><!--end of list content -->


</section>


</body>
</html>
