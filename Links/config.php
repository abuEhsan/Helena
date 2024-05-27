<?php 

// Setting up the time zone
    date_default_timezone_set('Asia/Qatar');
    $today = date("F j, Y, g:i a");
    $year = date("F , Y");

// DB credentials.
    define('DB_HOST','localhost');
    define('DB_USER','helldswh_wp563');
    define('DB_PASS','um_?Qvh}&K4y');
    define('DB_NAME','helldswh_helena'); 
// Establish database connection.

// Defining base url
    define("BASE_URL", "");

// Getting Admin url
    define("ADMIN_URL", BASE_URL . "ADMIN" . "/");

    try
    {
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        
    //Register Login
    $sql = "INSERT INTO `tblvisits`(`lastvisitdate`) VALUES (now());";
    $query = $dbh->prepare($sql);
    $query->execute();
        
    }
    catch (PDOException $e)
    {
    exit("Error: " . $e->getMessage());
    }
?>

