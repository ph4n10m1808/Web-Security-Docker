<?php
session_start();
include('../DB_Config/db_config.php');
include_once('data/post.php');
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin" &&
    $_GET['ID']
) {
    $id = $_GET['ID'];
    $name = getPostNamebyID($conn, $id);
    $sql1 = "INSERT INTO history(User_ID,Post_Tittle,Event_ID) VALUES (?,?,?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute([$_SESSION['ID'], $name, 4]);
    $accept = acceptPost($conn, $id);
} else {
    header("Location:404.php");
    exit;
}
