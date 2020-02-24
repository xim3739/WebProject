<?php
    $num   = $_GET["num"];

    $con = mysqli_connect("localhost", "root", "123456", "joo_db");
    $sql = "select * from board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

	if ($copied_name)
	{
		$file_path =  "../../data/".$copied_name;
		unlink($file_path);
    }

    $sql = "delete from board where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'board_myboard_form.php?num=$num';
	     </script>
	   ";
?>
