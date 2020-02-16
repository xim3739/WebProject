<?php 
    date_default_timezone_set("Asia/seoul");

    define("SERVER_NAME", "127.0.0.1");
    define("USER_NAME", "root");
    define("PASSWORD", "123456");
    define("DB_NAME", "joo_db");
    
    $dbFlag = "NO";

    $connect = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD);

    if(!$connect) {
        die("Connection failed : " . mysqli_connect_error());
    }
    $sql = "show databases";
    $result = mysqli_query($connect, $sql) or die("ERROR : " . mysqli_error($connect));

    while($row = mysqli_fetch_row($result)) {
        if($row[0] === DB_NAME) {
            $dbFlag = "OK";
            break;
        }
    }

    if($dbFlag === "NO") {
        $sql = "CREATE DATABASE " . DB_NAME;

        if(mysqli_query($connect, $sql)) {
            echo '<script >
            alert("Create joo_db!");
          </script>';
        } else {
            echo "Error : " . mysqli_error($conn);
        }
    }

    $dbConnection = mysqli_select_db($connect, DB_NAME) or die("ERROR : " . mysqli_error($connect));
?>