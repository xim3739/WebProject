<?php

if (isset($_POST["addr"])) {
    $name = $_POST["name"];
    $addr = $_POST["addr"];
    include "../db_connector.php";
    $sql = "SELECT * FROM hospital_list";
    $result = mysqli_query($con, $sql);
    if (!(mysqli_num_rows($result) > 0)) {
        for ($i = 0; $i < count($name); $i++) {
            $sql = "INSERT INTO hospital_list VALUES (NULL, '$name[$i]', '$addr[$i]')";
            mysqli_query($con, $sql);
        }
    }
}else{
    $a=$_GET["data"];
    echo true;
}



?>