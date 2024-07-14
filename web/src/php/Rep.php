<?php
$comment = $_POST['comment'];
$idPost = $_POST['idPost'];
$idUser = $_POST['idUser'];
$idCom = $_POST['idCom'];
$connect  = new mysqli('localhost', 'root', 'Administrator', 'PHP_Myblog', 3306);
$sql = "INSERT INTO comment (ID, User_ID, Post_ID, Comment, Time_Create, ID_Reply) VALUES (NULL, $idUser, $idPost, '$comment', current_timestamp(), $idCom)";
$rs = $connect->query($sql);
//echo $comment; 
