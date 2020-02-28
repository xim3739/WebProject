<?php
include "../../db/db_connector.php";

    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $sql = "update temporary_board set subject='$subject', content='$content' ";
    $sql .= " where num=$num";
    mysqli_query($connect, $sql);

    mysqli_close($connect);

    echo "
	      <script>
	          location.href = 'temporary_board_list.php?page=$page';
	      </script>
	  ";
?>
