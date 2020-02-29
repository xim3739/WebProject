<?php
  $search = $_POST["search_word"];
  $category = $_POST["category"];
  var_dump($search);
  var_dump($category);
  $search = trim($search);
  var_dump($search);
  // include_once "../../db/db_connector_main.php";
  $connect = mysqli_connect("localhost","root","123456","test");
  $sql = "select * from free where subject LIKE '%$search%'";
  $result = mysqli_query($connect,$sql);
  $row = mysqli_fetch_array($result);
  $subject = $row["subject"];
  var_dump($subject);
  if ($category===" ") {
    echo "
      <script>
      location.href = './free_list.php?search_subject=$subject&key_word=$search';
      </script>";
  }else {
    echo "
      <script>
      location.href = './free_list.php?search_subject=$subject&category=$category&key_word=$search';
      </script>";
  }

 ?>
