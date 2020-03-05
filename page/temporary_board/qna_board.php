<?php
include "../../db/db_connector.php";

@session_start();
if (isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
} else {
    $userid = "";
}
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    $username = "";
}

if(isset($_GET['num'])&&isset($_GET['page'])){
  $num=$_GET['num'];
  $page=$_GET['page'];
}else{
  echo "<script>
    alert('error_num_page');
    history.go(-1);
  </script>";
}

if(isset($_GET['mode'])){
  $mode=$_GET['mode'];
}else{
  echo "<script>
    alert('error_mode');
    history.go(-1);
  </script>";
}


$dbconn = mysqli_select_db($connect,"joo_db") or die('Error: '.mysqli_error($connect));
//use ansisung 과 같다.

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<meta charset="utf-8">
<?php
//*****************************************************
$content= $q_content = $sql= $result = $username="";
$group_num = 0;
//*****************************************************
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

// 삽입하는경우
if ($mode=="reply") {

    $r_content = trim($_POST["r_content"]);
    if (empty($r_content)) {
        echo "<script>alert('댓글 내용 입력요망!');history.go(-1);</script>";
        exit;
    }
    $r_content = test_input($_POST["r_content"]);
    $userid = test_input($userid);
    $q_content = mysqli_real_escape_string($connect, $r_content);
    $q_userid = mysqli_real_escape_string($connect, $userid);
    $regist_day=date("Y-m-d (H:i)");

    //그룹번호, 들여쓰기 기본값
    $group_num = 0;
    $depth=0;
    $ord=0;

    // ==========================================================================================================
    // 세 필드가 있다. a,b,c. 답변글 없이 기본적으로 입력할때는 a은 해당된 넘버값, 나머지 두개는 0의 값을 갖는다.
    // 그 글을 누르고 답변을 달았을 때, a는 원글의 그룹넘버값을 가져오고 b는 1추가해서 자기자신에게 저장한다.
    // c는 c
    // ==========================================================================================================

    $sql="INSERT INTO `temporary_comment` VALUES (null,$group_num,$depth,$ord,'$q_userid','$username','$q_content','$regist_day');";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }

    //현재 최대큰번호를 가져와서 그룹번호로 저장하기
    $sql="SELECT max(num) FROM `temporary_comment`;";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }
    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];
    $sql="UPDATE `temporary_comment` SET `group_num`= $max_num WHERE `num`=$max_num;";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }
    mysqli_close($connect);

    echo "<script>location.href='./temporary_board_view.php';</script>";

}elseif ($mode=="update_reply") {
    $r_content = trim($_POST["r_content"]);
    if (empty($r_content)) {
        echo "<script>alert('댓글 내용 입력요망!');history.go(-1);</script>";
        exit;
    }
    $r_content = test_input($_POST["r_content"]);
    $userid = test_input($userid);
    $num = test_input($_POST["num"]);
    $q_content = mysqli_real_escape_string($connect, $r_content);
    $q_userid = mysqli_real_escape_string($connect, $userid);
    $q_num = mysqli_real_escape_string($connect, $num);
    $regist_day=date("Y-m-d (H:i)");

    $sql="UPDATE `temporary_comment` SET `content`='$q_content',`regist_day`='$regist_day' WHERE `num`=$q_num;";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }





} elseif ($mode=="re_reply") {
    $content = trim($_POST["r_content"]);
    if (empty($content)) {
      echo "<script>alert('댓글 내용 입력요망!');history.go(-1);</script>";
        exit;
    }
    $r_content = test_input($_POST["r_content"]);
    $userid = test_input($userid);
    $num = test_input($_POST["num"]);
    $q_content = mysqli_real_escape_string($connect, $content);
    $q_userid = mysqli_real_escape_string($connect, $userid);
    $q_num = mysqli_real_escape_string($connect, $num);
    $regist_day=date("Y-m-d (H:i)");

    $sql="SELECT * FROM `temporary_comment` WHERE `num`=$q_num;"; //부모넘버
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }
    $row=mysqli_fetch_array($result);

    //현재 그룹넘버값을 가져와서 저장한다.
    $group_num=(int)$row['group_num'];
    //현재 들여쓰기값을 가져와서 증가한후 저장한다.
    $depth=(int)$row['depth'] + 1;
    //현재 순서값을 가져와서 증가한후 저장한다.
    $ord=(int)$row['ord'] + 1;

    //현재 그룹넘버가 같은 모든 레코드를 찾아서 현재 $ord값보다 같거나 큰 레코드에 $ord 값을 1을 증가시켜 저장한다.
    //새로 저장한 그 글의 ord 값은 일단 부모글의 ord값에 1을 더해서 저장하는데, 그 저장한 값보다 같거나 큰 값에는 다 1을 더해서 저장을 한다.
    $sql="UPDATE `temporary_comment` SET `ord`=`ord`+1 WHERE `group_num` = $group_num and `ord` >= $ord";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }

    $sql="INSERT INTO `temporary_comment` VALUES (null,$group_num,$depth,$ord,
    '$q_userid','$username','$q_content','$regist_day');";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }

    $sql="SELECT max(num) from `temporary_comment`;";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($connect));
    }
    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];

}//end of if insert
?>
