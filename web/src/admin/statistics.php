<?php
session_start();
if (isset($_SESSION["User"]) && $_SESSION["Role"] === "Admin") {

    $connect  = new mysqli('localhost', 'root', 'Administrator', 'PHP_Myblog', 3306);
    //////////////////////////////////////////////////////////////////////////////
    $arr = [];
    $sql = "SELECT post.Status_ID,post_status.Status_Name,COUNT(*) AS total FROM post JOIN post_status ON post.Status_ID = post_status.Status_ID GROUP BY post.Status_ID;";
    $rs = $connect->query($sql);
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $arr[] = $row;
        }
    }
    $arrJSON = json_encode($arr);
    /////////////////////////////////////////////////////////////////////////////
    $arr1 = [];
    $sql1 = "SELECT post.Category_ID,category.Category_Name,COUNT(*) AS total FROM post JOIN category ON post.Category_ID = category.ID GROUP BY post.Category_ID;";
    $rs1 = $connect->query($sql1);
    if ($rs1->num_rows > 0) {
        while ($row1 = $rs1->fetch_assoc()) {
            $arr1[] = $row1;
        }
    }
    $arr1JSON = json_encode($arr1);


?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Thống kê </title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="../css/side-bar.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <?php include('inc/side-nav.php') ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 card">
                    <div class="card-header">
                        Tỉ lệ duyệt bài
                    </div>
                    <canvas id="Bieudo1"></canvas>
                </div>
                <div class="col-6 card">
                    <div class="card-header">
                        Số lượng theo thể loại
                    </div>
                    <canvas id="Bieudo2"></canvas>
                </div>
            </div>
        </div>
        <script>
            var arr = <?= $arrJSON ?>;
            console.log(arr);
            var label = [];
            var amount = [];
            for (let i = 0; i < arr.length; i++) {
                label.push(arr[i].Status_Name)
                amount.push(arr[i].total)
            }
            const ctx = document.getElementById('Bieudo1');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'số lượng',
                        data: amount,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <script>
            var arr1 = <?= $arr1JSON ?>;
            console.log(arr1);
            var label1 = [];
            var amount1 = [];
            for (let i = 0; i < arr1.length; i++) {
                label1.push(arr1[i].Category_Name)
                amount1.push(arr1[i].total)
            }
            const ctx1 = document.getElementById('Bieudo2');

            new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: label1,
                    datasets: [{
                        label: 'số lượng',
                        data: amount1,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        </section>
        </div>
    </body>

    </html>
<?php } else {
    header("Location:404.php");
    exit;
}
?>