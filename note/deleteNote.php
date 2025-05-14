<?php
$connection = require_once (__DIR__. '/Connection.php');

$connection->removeNotes($_POST['id']);

header('Location: ../index.php');
