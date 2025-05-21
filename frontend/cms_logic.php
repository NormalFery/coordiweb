<!DOCTYPE html>
<html lang="en">
<?php

$servername = "localhost";
$username = "fery";
$password = "pruebas456";
$pdo = new PDO("mysql:host=localhost", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dbname = "coordicms";
$dbname = "`".str_replace("`","``",$dbname)."`";
$pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
$pdo->query("use $dbname");
$pdo->query("CREATE TABLE IF NOT EXISTS Ocio(PostId int NOT NULL AUTO_INCREMENT,PostTitle varchar(255),PostDescription varchar(1024),ImageLink varchar(255),PRIMARY KEY (PostId));");
$pdo->query("CREATE TABLE IF NOT EXISTS Empleo(PostId int NOT NULL AUTO_INCREMENT,PostTitle varchar(255),PostDescription varchar(1024),ImageLink varchar(255),PRIMARY KEY (PostId));");
$pdo->query("CREATE TABLE IF NOT EXISTS Formacion(PostId int NOT NULL AUTO_INCREMENT,PostTitle varchar(255),PostDescription varchar(1024),ImageLink varchar(255),PRIMARY KEY (PostId));");
$pdo->query("CREATE TABLE IF NOT EXISTS Igualdad(PostId int NOT NULL AUTO_INCREMENT,PostTitle varchar(255),PostDescription varchar(1024),ImageLink varchar(255),PRIMARY KEY (PostId));");
$pdo->query("CREATE TABLE IF NOT EXISTS Atencion(PostId int NOT NULL AUTO_INCREMENT,PostTitle varchar(255),PostDescription varchar(1024),ImageLink varchar(255),PRIMARY KEY (PostId));");
require_once './cms.php';
?>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

</body>
</html>