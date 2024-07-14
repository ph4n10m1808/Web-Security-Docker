<?php
// $sName = "localhost";
// $uName = "root";
// $pass = "Administrator";
// $db_name = "PHP_Myblog";

try {
    $conn = new PDO(
        "mysql:host=getenv(MYSQL_HOSTNAME);dbname=getenv(MYSQL_DATABASE)",
        getenv('MYSQL_USER'),
        getenv('MYSQL_PASSWORD')
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
} 

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// $db = new mysqli(getenv('MYSQL_HOSTNAME'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'));
