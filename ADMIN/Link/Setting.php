<?php

//include('config.php');


$sql = "SELECT * FROM `tblcompnydata` limit 1;";
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

}
}

