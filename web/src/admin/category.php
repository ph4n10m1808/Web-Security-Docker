<?php
session_start();
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin"
) {
    include_once("data/category.php");
    include("../DB_Config/db_config.php");
    $category = getAllCategory($conn);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Tất Cả Danh Mục</title>
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
            <h3 class="mb-3 text-center ">Tất Cả Danh Mục
                <br>
                <a href="category-add.php" class="btn btn-success">Thêm Danh Mục mới</a>
            </h3>
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
            <?php if ($category != 0) {
                $count = 0 ?>
                <table class="table t1 table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col" class="text-center">Tên Danh Mục</th>
                            <th scope="col" class="text-center">Thời gian tạo</th>
                            <th scope="col" class="text-center">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($category as $category) {
                        ?>
                            <tr>
                                <th scope="row" class="text-center"><?php echo ($count++) ?></th>
                                <td class="text-center"><a href="single-category.php?ID=<?php echo $category["ID"] ?>"> <?php echo $category["Category_Name"] ?></td>
                                <td class="text-center"><?php echo $category["Time_Create"] ?></td>
                                <td class="text-center">
                                    <a href="category-edit.php?ID=<?php echo $category["ID"] ?>" class="btn btn-success">Sửa</a>
                                    &nbsp;
                                    <a href="category-delete.php?ID=<?php echo $category["ID"] ?>" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-warning">
                    Trống!
                </div>
            <?php } ?>
        </div>
        </section>
        </div>
        <!-- <script>
            var navList = document.getElementById('navList').children;
            navList.item(2).classList.add("active");
        </script> -->
    </body>

    </html>
<?php } else {
    header("Location:404.php");
    exit;
}
?>