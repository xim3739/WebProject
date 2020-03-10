<?php

    $sum = 0;
    $today = date("Y-m-d");
    $sql = "SELECT * FROM `counter` WHERE `date` = $today";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);

    if(!$row) {
      //현재 날짜가 잇는지 없는지
        $sql = "INSERT INTO `counter`(`date`, `count`) VALUES('$today', 1)";
        mysqli_query($connect, $sql);
    } else {
      //count로 1을 증가
        $sql = "UPDATE `counter` SET `count` = `count` + 1 WHERE `date` = $today";
        mysqli_query($connect, $sql);
    }
    $sql = "SELECT * FROM `counter` WHERE `date` = '$today'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $count = $row['count'];

    $sql = "SELECT * FROM `counter`";
    $result = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_array($result)) {
        $sum += $row['count'];
    }
    echo "
        <script>
            console.log($count);
            console.log($sum);
        </script>
    "
?>
