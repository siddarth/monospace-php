<?php

  include 'constants.php';

  function db_connect() {
    $con = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
    if (!$con)
    {
      throw new Exception('Could not connect to the database: ' . mysql_error());
    }

    $db_selected = mysql_select_db(MYSQL_DB, $con);
    if (!$db_selected) {
        throw new Exception('Could not select database: ' . mysql_error());
    }
  }

?>