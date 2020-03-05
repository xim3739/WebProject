<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>찾아ZOO</title>
<link rel="stylesheet" href="../../css/temporary_board/board.css">
<link rel="stylesheet" href="../../css/temporary_board/common.css">
<link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../../css/main/small-business.css" rel="stylesheet">
<?php include "../../lib/common_page/main_style.php" ?>

<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="../../js/main/pop_up_menu.js"></script>

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

  <?php   session_start(); include "../../db/db_connector.php" ?>
</head>
<body>
  <?php include "../../lib/common_page/header.php" ?>
  <?php  //*****************************************************
  $id= $_SESSION['userid'];
  $group_num = $_GET['num'];
  $page  = $_GET["page"];
  $group_num = (int)$group_num;

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
   	<div id="board_box" style="padding-top:100px;">
	    <h3 class="title">
			임시보호
		</h3>
<?php
	$num  = $_GET["num"];
  $page = $_GET['page'];
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
  $new_hit = $hit + 1;

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

						$real_name = $file_copied;
						$file_path = "../../data/".$real_name;
						$file_size = filesize($file_path);

            if ($file_name) {

                        $exist = "exist";
                        echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
            <a href='./board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                    } else {
                        $exist = "not_exist";
                        echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
            <a href='./board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                    }
				?>
				<?=$content?>
			</li>
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='temporary_board_list.php?num=<?=$num?>&page=<?=$page?>'">목록</button></li>
				<li><button onclick="location.href='temporary_board_modify_form.php?num=<?=$num?>&page=<?=$page?>&exist=<?=$exist?>'">수정</button></li>
				<li><button onclick="location.href='temporary_board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
				<li><button onclick="location.href='temporary_board_form.php'">글쓰기</button></li>
		</ul>
	</div> <!-- board_box -->



</section>
  <?php include "comment_form.php"; ?>

</body>
</html>
