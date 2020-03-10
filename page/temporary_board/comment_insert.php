<meta charset="utf-8">
<?php
    include "../../db/db_connector.php";
    session_start();
    $group_num  = $_GET["num"];
    $page  = $_GET["page"];
    $group_num = (int)$group_num;
    if(isset($_GET['mode'])) {
      $mode  = $_GET["mode"];
    } else {
      $mode = "";
    }
    if(isset($_GET['comment_num'])) {
      $comment_num = $_GET['comment_num'];
    } else {
      $comment_num = 0;
    }

    $userid=$_SESSION['userid'];
    function test_input($data)
    {
        $data = stripslashes($data);
        // \'  \"  \\ 로 저장되어 있는 값에서 \(백슬래시)를 제거하고 보여줌
        $data = htmlspecialchars($data);
        //문자열에서 특정한 특수 문자를 HTML 엔티티로 변환한다. 이함수를 사용하면 악성 사용자로 부터 XSS 공격을 방지 할 수 있다.
        return $data;
    }
    if (!empty($content)) {
        echo "<script>
              alert('내용을 입력 하세요!');
              history.go(-1);
              </script>";
        exit;
    }
    $content = $_POST["content"];
    $q_content = mysqli_real_escape_string($connect, $content);
    //제공하는 함수로 MYSQL과 커넥션을할때 String을 Escape한 상태로 만들어준다.
    $q_userid = mysqli_real_escape_string($connect, $userid);
    $regist_day=date("Y-m-d (H:i)");



    $ord=0;

    if($mode && $comment_num){
      var_dump($q_content);
      $depth=1;
      $sql="SELECT max(ord) FROM `temporary_comment` where `comment_num`=$comment_num;";
      $result=mysqli_query($connect, $sql);
      $row=mysqli_fetch_array($result);
      $ord=$row['max(ord)']+1;
      $sql="INSERT INTO `temporary_comment` VALUES (null,$group_num,$comment_num,$depth,$ord,'$userid','$q_content','$regist_day')";

      mysqli_query($connect, $sql);
      mysqli_close($connect);
      echo "
      <script>
      location.href='./temporary_board_view.php?num=$group_num&page=$page';
      </script>";
    }else{
      $depth=0;
      $sql = "SELECT max(`comment_num`) FROM `temporary_comment`";
      $result = mysqli_query($connect, $sql);
      $row = mysqli_fetch_array($result);
      //은 리절트 셋(result set)에서 레코드를 1개씩 리턴해주는 함수입니다.
      $comment_num = $row[0];
      $comment_num = (int)$comment_num;
      $sql="INSERT INTO `temporary_comment` VALUES (null,$group_num,$comment_num+1,$depth,$ord,'$userid','$q_content','$regist_day')";
      $result = mysqli_query($connect, $sql);

      //현재 최대큰번호를 가져와서 그룹번호로 저장하기
      $sql2="SELECT max(num) FROM `temporary_comment`;";
      $result = mysqli_query($connect, $sql2);
      $row=mysqli_fetch_array($result);
      $max_num=$row['max(num)'];
      $sql="UPDATE `temporary_comment` SET `group_num`= $max_num WHERE `num`=$max_num;";
      if (!$result) {
        die('Error: ' . mysqli_error($connect));
      }
      mysqli_close($connect);
      echo "
      <script>
      location.href='./temporary_board_view.php?num=$group_num&page=$page';
      </script>";
    }

?>
