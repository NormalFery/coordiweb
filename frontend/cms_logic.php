<!DOCTYPE html>
<html lang="en">
<?php
// Especificamos las creendciales DE PRUEBA
$servername = "localhost";
$username = "fery";
$password = "pruebas456";
// Nos conectamos a MySQL para crear todo
$pdo = new PDO("mysql:host=localhost", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Especificamos el nombre de la base de datos, y creamos esta si no existe
$dbname = "coordicms";
$dbname = "`".str_replace("`","``",$dbname)."`";
$pdo->query("CREATE DATABASE IF NOT EXISTS $dbname");
$pdo->query("use $dbname");
// Si las tablas no existen, las creamos tambien
$pdo->query("CREATE TABLE IF NOT EXISTS Ocio(PostId int NOT NULL AUTO_INCREMENT,PostTitle varchar(255),PostDescription varchar(1024),ImageLink varchar(255),PostDate DATETIME,PRIMARY KEY (PostId));");
$pdo->query("CREATE TABLE IF NOT EXISTS Empleo(PostId int NOT NULL AUTO_INCREMENT,PostTitle varchar(255),PostDescription varchar(1024),ImageLink varchar(255),PostDate DATETIME,PRIMARY KEY (PostId));");
$pdo->query("CREATE TABLE IF NOT EXISTS Formacion(PostId int NOT NULL AUTO_INCREMENT,PostTitle varchar(255),PostDescription varchar(1024),ImageLink varchar(255),PostDate DATETIME,PRIMARY KEY (PostId));");
$pdo->query("CREATE TABLE IF NOT EXISTS Igualdad(PostId int NOT NULL AUTO_INCREMENT,PostTitle varchar(255),PostDescription varchar(1024),ImageLink varchar(255),PostDate DATETIME,PRIMARY KEY (PostId));");
$pdo->query("CREATE TABLE IF NOT EXISTS Atencion(PostId int NOT NULL AUTO_INCREMENT,PostTitle varchar(255),PostDescription varchar(1024),ImageLink varchar(255),PostDate DATETIME,PRIMARY KEY (PostId));");
// Y por último, requerimos la página bonita sin la lógica
require_once './cms.php';
?>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

</body>
</html>