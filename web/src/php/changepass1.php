<?php
session_start();
if (
    $_POST['pass'] &&
    $_POST['pass1']
) {
    include('../DB_Config/db_config.php');
    $pass = $_POST['pass'];
    $pass1 = $_POST['pass1'];
    if (empty($pass)) {
        $em = "Vui lòng điền mật khẩu mới!";
        header("Location: ../changepass1.php?error=" . urlencode($em));
        exit;
    } else if (empty($pass1)) {
        $em = "Vui lòng nhập nhập lại mật khẩu mới";
        header("Location: ../changepass1.php?error=" . urlencode($em));
        exit;
    } else if ($pass !== $pass1) {
        $em = "Mật khẩu mới và nhập lại mật khẩu không giống nhau!";
        header("Location: ../changepass1.php?error=" . urlencode($em));
        exit;
    } else {
        $sql = "UPDATE account SET Password = ? WHERE Username = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([md5($pass), $_SESSION["Username"]]);
        $_SESSION["Username"] = "";
        $sm = "Thay đổi mật khẩu thành công!";
        header("Location: ../changepass1.php?success=" . urlencode($sm));
        exit;
    }
} else {
?>
    <script>
        alert("Bạn chưa đăng nhập!");
        setTimeout(function() {
            window.location.href = "/Project-PHP/index.php";
        }, 0)
    </script>
<?php
}
