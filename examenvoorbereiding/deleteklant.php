<?php
include 'database.php';
$db = new database();
$klant = $db->deleteklant($_GET['klantID_rs']);
?>