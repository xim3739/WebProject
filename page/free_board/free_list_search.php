<?php
  $search = $_POST["search_word"];
  $category = $_POST["category"];
  $search_option = $_POST["search_option"];
  $search = trim($search);
  if ($category===" ") {
    echo "
      <script>
      location.href = './free_list.php?key_word=$search&search_option=$search_option';
      </script>";
  }else {
    echo "
      <script>
      location.href = './free_list.php?category=$category&key_word=$search&search_option=$search_option';
      </script>";
  }
 ?>
