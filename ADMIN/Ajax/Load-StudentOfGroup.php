<?php

session_start();
//include('../Link/error-reporting.php');
//include('../../Link/config.php');



	$conn = mysqli_connect("localhost","root","","dbees") or die("Connection failed");

	if($_POST['type'] == ""){
		$sql = "SELECT id,GruopName FROM tblgruops    ORDER BY `tblgruops`.`CreateDate` DESC ";

		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['id']}'>{$row['GruopName']}</option>";
		}
	}else if($_POST['type'] == "stateData"){

        $sql = "SELECT tbls.RollId AS RID,tbls.StudentName AS SNAME FROM tblstudents tbls\n"

            . "JOIN tblregisteringstudents_to_gruop tblgr\n"

            . "ON tbls.RollId=tblgr.StudentId\n"

            . "WHERE tblgr.PK_GruopId ={$_POST['id']};";

		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['RID']}'>{$row['SNAME']}</option>";
            
            
            //Loop Get Cources of student
            
            
            
            
            
            
		}//End Loog Get Students Of Gruop
	}

	echo $str;
 