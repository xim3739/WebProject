<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" href="../../css/temporary_board/board.css">
<link rel="stylesheet" type="text/css" href="../../css/board/board.css">

<link rel="stylesheet" href="../../css/temporary_board/common.css">

<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<!-- Bootstrap core CSS -->
<link href="../../css/main/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="../../css/main/small-business.css" rel="stylesheet">
<?php include "../../lib/common_page/main_style.php" ?>
<script src="../../js/main/pop_up_menu.js"></script>
<?php include "../../db/db_connector.php" ?>
<style media="screen">

      #list_search {
      height:30px;
      padding-top:10px;
      margin-left: 535px;
      }

      #list_search #list_search3 {
      float:left;
      margin-left:5px;
      margin-top:1px;
      }

      #list_search #list_search3 select {
      width:80px;
      height:21px;
      border:solid 1px #cccccc;
      }

      #list_search #list_search4 {
      float:left;
      margin-left:3px;
      }

      #list_search #list_search4 input {
      width:120px;
      height:18px;
      border:solid 1px #cccccc;
      }

      #list_search #list_search5 {
      float:left;
      margin-left:5px;
      margin-top:1px;
      }


</style>
</head>
<body>
  <?php include "../../lib/common_page/header.php";?>
<section>
  <?php

  $sql=$total_record=$total_page=$start="";
  $row="";

  if (isset($_GET["mode"])&&$_GET["mode"]=="search") {
      //제목, 내용, 아이디
      $find = $_POST["find"];
      $search = $_POST["search"];
      $q_search = mysqli_real_escape_string($connect, $search);
      $sql="SELECT * from `temporary_board` where $find like '%$q_search%' order by num desc;";
  } else {
      $sql="SELECT * from `temporary_board` order by num desc;";
  }


  	$result = mysqli_query($connect, $sql); //위의 쿼리문을 실행한 결과값을 result에 레코드셋으로 저장을 하게된다.
  	$total_record = mysqli_num_rows($result); // 전체 글 수 //mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환합니다.




    if (isset($_GET["page"]))//존재하는 키값에 페이지가 존재하느냐
  		$page = $_GET["page"];
  	else
  		$page = 1;
  	$scale = 10; //목록 수 = scale

  // 1. 페이지를 정하려면 전체 갯수를 알아야한다. 138
  // 2. 목록 수를 결정한다. 10
  // 3. 페이지 수가 나온다. 14 (페이지수는 나눠떨어지지 않을 수 있다. => 그때는 1을 더해야 한다. ex. 138/10 + 1)
  // 4. 시작할 페이지를 정한다. 1
  // 5. 페이지 세팅 넘버 page set number = (시작페이지-1)*목록 수
  // 6. 페이지 별로 시작하는 번호 (138-x =138) 138 --- 129개가 나온다

  	// 전체 페이지 수($total_page) 계산
  	if ($total_record % $scale == 0)
  		$total_page = floor($total_record/$scale); //소수점 내림 함수
  	else
  		$total_page = floor($total_record/$scale) + 1;

  	// 표시할 페이지($page)에 따라 $start 계산
  	$start = ($page - 1) * $scale;
  //page = 14
  	$number = $total_record - $start;
  ?>
   	<div id="board_box" style="padding-top:100px;">
	    <h3>
	    	임시보호
		</h3>
    <form name="board_form" action="temporary_board_list.php?mode=search" method="post">
      <div id="list_search">
          <div id="list_search3">
            <select name="find">
              <option value="subject">제목</option>
              <option value="content">내용</option>
              <option value="name">이름</option>
            </select>
          </div><!--end of list_search3  -->
          <div id="list_search4"><input type="text" name="search" style="height: 21px;"></div>
          <div id="list_search5"> <input type="image" src="../../img/board/list_search_button.gif"></div>
        </div><!--end of list_search  -->
    </form>
	    <ul id="board_list">
				<li>

					<span class="col1" style="font-weight:bold;"></span>
					<span class="col2" style="font-weight:bold;">제목</span>
					<span class="col3" style="font-weight:bold;">글쓴이</span>
					<span class="col4" style="font-weight:bold;">첨부</span>
					<span class="col5" style="font-weight:bold;">등록일</span>
					<span class="col6" style="font-weight:bold;">조회</span>
				</li>

<?php
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i); //리절트=레코드셋에서 원하는 데이터를 선택
    // mysqli_data_seek 함수는 리절트 셋(result set)에서 원하는 순번의 데이터를 선택하는데 쓰입니다.
    // 보통의 경우 mysqli_data_seek 함수로 원하는 순번을 선택하고 mysqli_fetch_row 로 선택한 데이터를 가져옵니다.
    // 오프셋은 = 필드 오프셋. 0과 총 행 수 사이에 있어야합니다(-1)​

    // [참고사항] mysqli_data_seek 순번
    // mysqli_data_seek 함수의 순번은 0부터 시작하기 때문에 예제 1처럼 3번째 데이터를 원하는 경우 2를 입력하여야 합니다.

      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      //fetch_array는 인덱스와 키값으로 찾을 수 있다.
      //fetch_row는 인덱스로 찾을 수 있다.
      // 하나의 레코드 가져오기
    $num=$row['num'];
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
				<li>
					<span class="col1"></span>
					<span class="col2"><a href="temporary_board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
					<span class="col3"><?=$name?></span>
					<span class="col4"><?=$file_image?></span>
					<span class="col5"><?=$regist_day?></span>
					<span class="col6"><?=$hit?></span>
				</li>
<?php
   	   $number--;
       //number 128
   }
   mysqli_close($connect);

?>
	    	</ul>
			<ul id="page_num">
<?php
	if ($total_page>=2 && $page >= 2) //현재 페이지가 2보다 크고 토탈페이지 2보다 크면 '이전'을 보여준다.
	{
		$new_page = $page-1;
		echo "<li><a href='temporary_board_list.php?page=$new_page'>◀ 이전</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++) //1부터 토탈페이지까지 찍어준다.
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='temporary_board_list.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page) //현재 페이지가 마지막 페이지만 아니면 보여준다.
   	{
		$new_page = $page+1;
		echo "<li> <a href='temporary_board_list.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";
?>
			</ul> <!-- page -->
			<ul class="buttons">
				<li><button onclick="location.href='temporary_board_list.php'">목록</button></li>
				<li>
<?php
    if($userid) {
?>
					<button onclick="location.href='temporary_board_form.php'">글쓰기</button>
<?php
	} else {
?>
					<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
<?php
	}
?>
				</li>
			</ul>
	</div> <!-- board_box -->
</section>


</body>
</html>
