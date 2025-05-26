<?php

$servername = "localhost";
$username = "fery";
$password = "pruebas456";
$pdo = new PDO("mysql:host=localhost", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query("USE coordicms;");

switch ($_POST["parea"]) {
    case "integral.html":
        $pdo->query("INSERT INTO atencion (PostTitle, PostDescription, ImageLink) VALUES ('$_POST[pname]', '$_POST[pdesc]', '$_POST[pimage]');");
        break;
    case "ocio.html":
        $pdo->query("INSERT INTO ocio (PostTitle, PostDescription, ImageLink) VALUES ('$_POST[pname]', '$_POST[pdesc]', '$_POST[pimage]');");
        break;
    case "empleo.html":
        $pdo->query("INSERT INTO empleo (PostTitle, PostDescription, ImageLink) VALUES ('$_POST[pname]', '$_POST[pdesc]', '$_POST[pimage]');");
        break;
    case "formacion.html":
        $pdo->query("INSERT INTO formacion (PostTitle, PostDescription, ImageLink) VALUES ('$_POST[pname]', '$_POST[pdesc]', '$_POST[pimage]');");
        break;
    case "Igualdad.html":
        $pdo->query("INSERT INTO igualdad (PostTitle, PostDescription, ImageLink) VALUES ('$_POST[pname]', '$_POST[pdesc]', '$_POST[pimage]');");
        break;
        default:
            break;
};
require_once './cms_logic.php';
?>