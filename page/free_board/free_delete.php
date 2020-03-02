<?php
  $num = $_GET["num"];
  $page = $_GET["page"];
  var_dump($num);
  var_dump($page);

  include_once "../../db/db_connector_main.php";
  // $connect = mysqli_connect("localhost","root","123456","test");

  $sql = "select * from free where num = $num";
  $result = mysqli_query($connect,$sql);
  $row = mysqli_fetch_array($result);
  $copied_name = $row["file_copied"];
  var_dump($copied_name);

  if ($copied_name) {
    $file_path = "../../data/".$copied_name;
    var_dump($file_path);
    unlink($file_path);
  }
  $sql = "delete from free where num = $num";
  mysqli_query($connect,$sql);
  mysqli_close($connect);
  echo "<script>location.href = 'free_list.php?page=$page';</script>";
 ?>
