<?php
session_start();
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin"
) {
    include_once("data/user.php");
    include("../DB_Config/db_config.php");
    $user = getAllUser($conn);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Tất Cả Người Dùng</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/side-bar.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <?php
        include('inc/side-nav.php');
        ?>
        <div>
            <h3 class="mb-3 text-center">Tất cả người dùng</h3>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-warning">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_GET['success']) ?>
                </div>
            <?php } ?>
            <?php if ($user != 0) {
                $count = 0 ?>
                <table class="table t1 table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">ID</th>
                            <th class="text-center" scope="col">Tên đầy đủ</th>
                            <th class="text-center" scope="col">Tên Đăng Nhập</th>
                            <th class="text-center" scope="col">Thời gian tạo</th>
                            <th class="text-center" scope="col">Vai trò</th>
                            <th class="text-center" scope="col">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user as $user) {
                        ?>
                            <tr>
                                <td class="text-center" scope="row"><?php echo ($count++) ?></td>
                                <td class="text-center"><?php echo $user["FullName"] ?></td>
                                <td class="text-center"><?php echo $user["Username"] ?></td>
                                <td class="text-center"><?php echo $user["Time_create"] ?></td>
                                <td class="text-center"><?php echo $user["Role"] ?></td>
                                <td class="text-center">
                                    <a href="user-delete.php?ID=<?php echo $user["ID"] ?>" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-warning">
                    Trống
                </div>
            <?php } ?>
        </div>
        </section>
        </div>
        <!-- <script>
            var navList = document.getElementById(`navList`).children;
            navList.item(0).classList.add("active");
        </script> -->
    </body>

    </html>
<?php } else {
    header("Location:404.php");
    exit;
}
?>