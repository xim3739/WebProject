<?php
    include "../../db/db_connector.php";
    include "../../db/create_table.php";

    createTable($connect, 'member', DB_NAME);
    createTable($connect, 'message', DB_NAME);
?>