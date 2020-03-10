<?php
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
