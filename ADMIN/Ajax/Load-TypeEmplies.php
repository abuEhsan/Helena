<?php

session_start();

	$conn = mysqli_connect("localhost","root","","pnt_db") or die("Connection failed");

	if($_POST['type'] == ""){
         
        $accoTypeAdminId="موظف";       
        $accoTypeMemberId="مسوق";      
        $i=1;
        while($i < 2){
		  $str .= "<option value='1'>{$accoTypeAdminId}</option>";
          $str .= "<option value='2'>{$accoTypeMemberId}</option>";
         $i++;
		}
        
        
//		$sql = "SELECT ID,AdminName FROM tbladmin    ORDER BY `tbladmin`.`AdminRegdate` DESC ";
//		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
//		$str = "";
//		while($row = mysqli_fetch_assoc($query)){
//		  $str .= "<option value='{$row['ID']}'>{$row['AdminName']}</option>";
//		}
        
        
        
	}else if($_POST['type'] == "stateData"){
        
        if($_POST['id'] == '1'){
           	$sql = "SELECT ID,AdminName FROM tbladmin    ORDER BY `tbladmin`.`AdminRegdate` DESC ";
            $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
            $str = "";
            while($row = mysqli_fetch_assoc($query)){
		    $str .= "<option value='{$row['ID']}'>{$row['AdminName']}</option>";
                
        }}
            
        if($_POST['id'] == '2'){
            $sql="SELECT ID,Name FROM tblmembers ";
            $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
            $str = "";
            while($row = mysqli_fetch_assoc($query)){
	    	  $str .= "<option value='{$row['ID']}'>{$row['Name']}</option>";
                
        } }
        
        
 
          
            
            
            
            
            
            
		}//End Loog Get Students Of Gruop
	

	echo $str;
 