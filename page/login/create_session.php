<?php
  session_start();
  if(!isset($_SESSION['username'])) {
      $name = $_POST['name'];

      $_SESSION['username'] = $name;


      echo "$name";
  } else {
    echo "error";
  }

 ?>
