<?php
    include "./db_connector.php";
    include "./create_table.php";

    createTable($connect, 'member', DB_NAME);
    createTable($connect, 'message', DB_NAME);
?>