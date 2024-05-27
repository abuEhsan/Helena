<?php
session_start();
error_reporting(1);
require_once('ADMIN/Link/config.php');
//require_once('ADMIN/Link/CSRF_Protect.php');
//require_once('ADMIN/Link/functions.php');
//include('config.php');
include("ADMIN/Link/Favicons.php");
include('Dir.php');
//include('CSRF_Protect.php');
// Add View to website
 $sql = "INSERT INTO tblvisits (lastvisitdate) VALUES (CURRENT_TIMESTAMP);";
 $query = $dbh->prepare($sql);
 $query->execute();

$sql = "SELECT * FROM tblcompnydata limit 1;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
    foreach($results as $result)
    { 
        $MAP=$result->map; 
        //
        $CNAME=$result->Name;
        $LOGO=$result->logo;
        $ICON=$result->icon;
        $ADDRESS=$result->Address;
        $MetaTitleHome=$result->MetaTitleHome;
        $MetaKeywordHome=$result->MetaKeywordHome;
        $MetaDescriptionHome=$result->MetaDescriptionHome;
        $ShortDescHero=$result->ShortDescHero;
        $ShortDesc=$result->ShortDesc;
        //
        $about=$result->about;
        $goal=$result->goal;
        $Domain=$result->Domain;
        $phone1=$result->phone1;
        $phone2=$result->phone2;
        $Email=$result->Email;
        $CommercialNumber=$result->CommercialNumber;

    }
}

