<?php
$sql_ms = "SELECT id,FullName,Subject,Message,PostingDate FROM `tblcontactdata` WHERE Is_Read !=1 ORDER BY PostingDate DESC";
$query = $dbh->prepare($sql_ms);
$query->execute();
$results_ms=$query->fetchAll(PDO::FETCH_OBJ);
$cou=1;
if($query->rowCount() > 0)
{
foreach($results_ms as $result_ms)
{   
    $DateResult=$result_ms->PostingDate;
    $currentDate = new DateTime($DateResult);
    $DR=$currentDate->format('Y-M-j H:i:s');
    $subStr=substr($result_ms->Message, 0, 30);
?>

      <li class="notification-item">
              <i class="bi bi-chat-left-text"></i>
              <div>
                <h4><?php echo htmlentities($result_ms->FullName);?></h4>
                <p><?php echo htmlentities($subStr)." "."<i class='bi bi-arrow-right' style='color:blue;'>"."</i>";?></p>
                <p><?php echo htmlentities($DR);?></p>
              </div>
            </li>
              <hr class="dropdown-divider">
                
<?php $cou=$cou+1;}} ?>
                
