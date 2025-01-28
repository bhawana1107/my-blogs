<?php
require_once "constants.php";
require_once "functions.php";
session_start();


$host = "localhost";
$user = 'root';
$password = '';
$database = 'my_blog';

$con = mysqli_connect($host, $user, $password, $database) or die('Connection failed!!. 😢');
