<?php
session_start();

if(!isset($_SESSION['user_id'])) {
  header("Location: ../php/login.php");
  exit;
}

require_once('db.php');

$user_id = $_SESSION['user_id'];
$user = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($user_id)]);

echo json_encode($user);
?>
