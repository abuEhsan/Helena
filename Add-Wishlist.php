<?php
require_once('Links/Setting.php');
if(!isset($_REQUEST['PID'])) {
    header('location: index.php');
    exit;
} else {
    