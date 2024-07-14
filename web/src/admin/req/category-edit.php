<?php
session_start();
include "../../DB_Config/db_config.php";
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin"
) {
    if (
        isset($_POST['category1'])
    ) {
        $category1 = $_POST['category'];
        $category = $_POST['category1'];
        $id = $_POST['ID'];
        if (empty($category)) {
            $em = "Tên Danh Mục Trống";
            header("Location: ../category-add.php?error=$em");
            exit;
        } else {
            $sql = "UPDATE category SET Category_Name =? WHERE ID =?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$category, $id]);
            if ($res) {
                $sql1 = "INSERT INTO history(User_ID,Category_Name,Event_ID) VALUES (?,?,?)";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->execute([$_SESSION["ID"], $category1, 9]);
                $sm = "Sửa danh mục thành công";
                header("Location: ../category-add.php?success=" . urlencode($sm));
                exit;
            } else {
                $em = "Lỗi Không xác định";
                header("Location: ../category-add.php?error=" . urlencode($em));
                exit;
            }
        }
    } else {
        header("Location: ../category-add.php");
        exit;
    }
} else {
    header("Location: ../404.php");
    exit;
}
