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
        $data = htmlspecialchars($data);
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
    $q_userid = mysqli_real_escape_string($connect, $userid);
    $regist_day=date("Y-m-d (H:i)");



    $ord=0;

    if($mode && $comment_num){
      var_dump($q_content);
      $depth=1;
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
