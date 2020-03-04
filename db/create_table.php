<?php
    function createTable($connect, $tableName, $DB_NAME) {
        $flag = "NO";
        $sql = "SHOW TABLES FROM " . $DB_NAME;
        $result = mysqli_query($connect, $sql) or die("ERROR : " . mysqli_error($connect));

        while($row = mysqli_fetch_row($result)) {
            if($row[0] === "$tableName") {
                $flag = "OK";
                break;
            }
        }

        if($flag === "NO") {
            switch ($tableName) {
                case 'member' :
                    $sql = "CREATE TABLE `member`(
                        `num` int(11) NOT NULL AUTO_INCREMENT,
                        `id` varchar(30),
                        `password` varchar(30),
                        `name` varchar(20),
                        `phone` varchar(30),
                        `premium` varchar(10),
                        PRIMARY KEY(`num`)
                    )";
                    break;
                case 'message' :
                    $sql = "CREATE TABLE `message`(
                        `num` int NOT NULL AUTO_INCREMENT,
                        `send_id` varchar(30) NOT NULL,
                        `rv_id` varchar(30) NOT NULL,
                        `send_name` varchar(20) NOT NULL,
                        `rv_name` varchar(20) NOT NULL,
                        `content` text NOT NULL,
                        `regist_day` char(20),
                        PRIMARY KEY(num)
                    )";
                    break;
                case 'board' :
                    $sql = "CREATE TABLE `board`(
                        `num` int NOT NULL AUTO_INCREMENT,
                        `id` char(20) NOT NULL,
                        `name` char(20) NOT NULL,
                        `category` char(20) NOT NULL,
                        `subject` varchar(200) NOT NULL,
                        `content` text NOT NULL,
                        `regist_day` char(30) NOT NULL,
                        `hit` int NOT NULL,
                        `file_name` varchar(200),
                        `file_type` char(25),
                        `file_copied` char(25),
                        `locationY` char(50),
                        `locationX` char(50),
                        PRIMARY KEY(num)
                    )";
                    break;
                case 'temporary_board' :
                    $sql = "CREATE TABLE `temporary_board`(
                        `num` int NOT NULL AUTO_INCREMENT,
                        `id` char(20) NOT NULL,
                        `name` char(20) NOT NULL,
                        `subject` varchar(200) NOT NULL,
                        `content` text NOT NULL,
                        `regist_day` char(30) NOT NULL,
                        `hit` int NOT NULL,
                        `file_name` varchar(200),
                        `file_type` char(25),
                        `file_copied` char(25),
                        PRIMARY KEY(num)
                    )";
                    break;

                case 'comment' :
                  $sql = "CREATE TABLE `comment`(
                      `num` int NOT NULL AUTO_INCREMENT,
                      `group_num` int NOT NULL,
                      `comment_num` int NOT NULL,
                      `depth` int NOT NULL,
                      `ord` int NOT NULL,
                      `id` varchar(15) NOT NULL,
                      `content` text NOT NULL,
                      `regist_day` varchar(20),
                      PRIMARY KEY(`num`)
                  )";
                  break;
                case 'temporary_comment' :
                  $sql = "CREATE TABLE `temporary_comment`(
                      `num` int NOT NULL AUTO_INCREMENT,
                      `group_num` int NOT NULL,
                      `comment_num` int NOT NULL,
                      `depth` int NOT NULL,
                      `ord` int NOT NULL,
                      `id` varchar(15) NOT NULL,
                      `content` text NOT NULL,
                      `regist_day` varchar(20),
                      PRIMARY KEY(`num`)
                  )";
                  break;

                  case 'free' :
                    $sql = "CREATE TABLE `free`(
                        `num` int NOT NULL AUTO_INCREMENT,
                        `id` varchar(30) NOT NULL,
                        `name` varchar(15) NOT NULL,
                        `category` varchar(20) NOT NULL,
                        `subject` varchar(200) NOT NULL,
                        `content` text NOT NULL,
                        `regist_day` char(20) NOT NULL,
                        `hit` int NOT NULL,
                        `file_name` char(40),
                        `file_type` char(40),
                        `file_copied` char(40),
                        PRIMARY KEY(`num`)
                    )";
                    break;

                case 'hospital_list' :
                    $sql = "CREATE TABLE `hospital_list`(
                        `num` int NOT NULL AUTO_INCREMENT,
                        `name` char(30) NOT NULL,
                        `address` char(60) NOT NULL,
                        PRIMARY KEY(`num`)
                    )";
                    break;
                case 'counter' :
                    $sql = "CREATE TABLE `counter`(
                        `num` int NOT NULL AUTO_INCREMENT,
                        `date` varchar(30) NOT NULL,
                        `count` int NOT NULL DEFAULT 0,
                        PRIMARY KEY(num)
                    )";
                    break;
                default:
                    echo "<script>alert('해당 테이블이름이 없습니다. ');</script>";
                    break;
            }// end of switch

            if(mysqli_query($connect, $sql)) {
                echo "<script>alert('$tableName 테이블이 생성되었습니다.');</script>";
            } else {
                echo "ERROR : ".mysqli_error($connect);
            }//end of if query
        }//end of if flag
    }//end of function
?>
