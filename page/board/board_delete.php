<?php

    include "../../db/db_connector.php";
    $num   = $_GET["num"];
    $sql = "SELECT * FROM `board` WHERE `num` = $num";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

	if ($copied_name)
	{
		$file_path =  "../../data/".$copied_name;
		unlink($file_path);
    }

    $sql = "DELETE FROM `board` WHERE `num` = $num";
    mysqli_query($connect, $sql);
    mysqli_close($connect);

    echo "
       <script>
        alert('삭제했습니다.');   
	      location.href = 'board_myboard_form.php';
	     </script>
	   ";
?>
