<?php

$servername = "localhost";
$username = "fery";
$password = "pruebas456";
$pdo = new PDO("mysql:host=localhost", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->query("USE coordicms;");

switch ($_POST["parea"]) {
    case "integral.html":
        $time = date('Y-m-d H:i:s');
        $pdo->query("INSERT INTO atencion (PostTitle, PostDescription, ImageLink, PostDate) VALUES ('$_POST[pname]', '$_POST[pdesc]', '$_POST[pimage]', '$time');");
        break;
    case "ocio.html":
        $time = date('Y-m-d H:i:s');
        $pdo->query("INSERT INTO ocio (PostTitle, PostDescription, ImageLink, PostDate) VALUES ('$_POST[pname]', '$_POST[pdesc]', '$_POST[pimage]', '$time');");
        break;
    case "empleo.html":
        $time = date('Y-m-d H:i:s');
        $pdo->query("INSERT INTO empleo (PostTitle, PostDescription, ImageLink, PostDate) VALUES ('$_POST[pname]', '$_POST[pdesc]', '$_POST[pimage]', '$time');");
        break;
    case "formacion.html":
        $time = date('Y-m-d H:i:s');
        $pdo->query("INSERT INTO formacion (PostTitle, PostDescription, ImageLink, PostDate) VALUES ('$_POST[pname]', '$_POST[pdesc]', '$_POST[pimage]', '$time');");
        break;
    case "Igualdad.html":
        $time = date('Y-m-d H:i:s');
        $pdo->query("INSERT INTO igualdad (PostTitle, PostDescription, ImageLink, PostDate) VALUES ('$_POST[pname]', '$_POST[pdesc]', '$_POST[pimage]', '$time');");
        break;
        default:
            break;
};
require_once './cms_logic.php';
?>