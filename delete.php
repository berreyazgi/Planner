<?php
$connection = require_once './Connection.php';

$connection->removeNotes($_POST['id']);

header('Location: index.php');
