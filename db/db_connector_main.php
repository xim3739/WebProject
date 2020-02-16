<?php
    include $_SERVER['DOCUMENT_ROOT']."/db/db_connector.php";
    include $_SERVER['DOCUMENT_ROOT']."/db/create_table.php";

    createTable($connect, 'member', DB_NAME);
    createTable($connect, 'message', DB_NAME);
?>