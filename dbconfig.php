<?php

define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'users');

$conn = mysql_connect(dbhost,dbuser,dbpass);
$dbcon = mysql_select_db(dbname);

if ( !$conn ) {
    die("Connection failed : " . mysql_error());
}

if ( !$dbcon ) {
    die("Database Connection failed : " . mysql_error());
}

?>