<?php
  // session_start();
  // $userid =(isset($_SESSION["userid"]))?$_SESSION["userid"]:"";
  // if ($userid !== "admin1234") {
  //   echo "
  //         <script>
  //         alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
  //         history.go(-1)
  //         </script>
  //        ";
  //   exit;
  // }
  $num = $_GET["num"];
  include_once "../../db/db_connector.php";
  $sql = "delete from member where num=$num";
  mysqli_query($connect,$sql);
  mysqli_close($connect);
  echo "
	     <script>
	         location.href = 'admin_member.php';
	     </script>
	   ";
 ?>
