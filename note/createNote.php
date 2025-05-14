<?php

$connection = require_once (__DIR__. '/Connection.php');

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$id = $_POST['id'] ?? '';

if(!$title || !$description){
    header('Location: index.php?error=1');
    exit;
}

if($id){
    $connection->updateNote( $_POST);
}else{
    $connection->addNote($_POST);
}

header('Location: ../index.php'); 

