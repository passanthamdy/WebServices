<?php

session_start();

require_once("vendor/autoload.php");

$db = new dbConnector();
$db->connect();
$api = new apiHandler($db);