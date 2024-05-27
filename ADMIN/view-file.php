<?php 

include('Link/config.php');
        include('Link/Setting.php');
        include("Link/Dir.php"); 
        include("Link/Favicons.php");
//        include("Link/languge.php"); 

if(isset($_GET['select']) && ! empty($_GET['select'])){
   
   $file=$_GET['select']; 

?><html>
    <head>
        <style type="text/css">
            #myiframe {
                width: 600px;
                height: 100%;
            }
        </style>
    </head>
    <body>
        <div id="scroller">
            <iframe name="myiframe" id="myiframe" src="<?php echo $DirUPLOADIN_Uploads_File.$file; ?>"></iframe>
        </div>
    </body>
</html>
<?php } ?>

<?php
if(isset($_GET['selectRT']) && ! empty($_GET['selectRT'])){
   
   $file=$_GET['selectRT']; 
?>
<html>
    <head>
        <style type="text/css">
            #myiframe {
                width: 600px;
                height: 100%;
            }
        </style>
    </head>
    <body>
        <div id="scroller">
            <iframe name="myiframe" id="myiframe" src="UPLOADING/Uploads-StudingTables/<?php echo $file; ?>"></iframe>
        </div>
    </body>
</html>

<?php } ?>

<?php
if(isset($_GET['selectSC']) && ! empty($_GET['selectSC'])){
   
   $file=$_GET['selectSC']; 
?>
<html>
    <head>
        <style type="text/css">
            #myiframe {
                width: 600px;
                height: 100%;
            }
        </style>
    </head>
    <body>
        <div id="scroller">
            <iframe name="myiframe" id="myiframe" src="UPLOADING/Uploads-StudingTables/<?php echo $file; ?>"></iframe>
        </div>
    </body>
</html>

<?php } ?>