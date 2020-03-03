<?php
    include "../../db/db_connector.php";
    include "../../db/create_table.php";

    createTable($connect, 'member', DB_NAME);
    createTable($connect, 'message', DB_NAME);
    createTable($connect, 'board', DB_NAME);
    createTable($connect, 'comment', DB_NAME);
    createTable($connect, 'free', DB_NAME);
    createTable($connect, 'hospital_list', DB_NAME);
    createTable($connect, 'counter', DB_NAME);
    createTable($connect, 'temporary_board', DB_NAME);
    createTable($connect, 'temporary_comment', DB_NAME);
    createTable($connect, 'free', DB_NAME);

?>
