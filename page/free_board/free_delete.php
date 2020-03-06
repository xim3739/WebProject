<?php
  $num = $_GET["num"];
  $page = $_GET["page"];

  include_once "../../db/db_connector.php";

  $sql = "select * from free where num = $num";
  $result = mysqli_query($connect,$sql);
  $row = mysqli_fetch_array($result);
  $copied_name = $row["file_copied"];

  if ($copied_name) {
    $file_path = "../../data/".$copied_name;
    unlink($file_path);
  }
  $sql = "delete from free where num = $num";
  mysqli_query($connect,$sql);
  mysqli_close($connect);
  echo "<script>location.href = 'free_list.php?page=$page';</script>";
 ?>
