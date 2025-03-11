<?php
include "db.php";
$action = $_POST['action'];
$result = $_POST['result'];
$answer = $pdo->query("SELECT * FROM `tickets` WHERE `$action` LIKE '%$result%'")->fetchAll()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draggable Verification</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="jquery-ui.css">
    <style>
        .card {
            text-align: center;
            overflow: hidden;
            text-align: center;
            width: 1000px !important;
            transform: translateY(150px);
            margin: auto;
            padding: 70px;
        }
        div.card::before{
            content: "";
            height: 150px;
            width: 150px;
            background: gold;
            position: absolute;
            z-index: -1;
            filter: blur(10px);
            border-radius: 50px;
            animation: 10s spin linear infinite;
        }
        div.card::after{
            content: "";
            height: 300px;
            width: 300px;
            background: goldenrod;
            position: absolute;
            z-index: -1;
            filter: blur(10px);
            border-radius: 50px;
            animation: 8s spin linear infinite;
        }
        @keyframes spin {
            from {
                rotate: 0deg;
            }
            to {
                rotate: 360deg;
            }
        }
        form.card img{
            width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <header class="shadow">
        <img src="./img/logo.png" class="logo" alt="">
        <h1 id="site-title">2025 國際交響樂團演奏會(ISOC)</h1>
        <a href="home.html" class="links">Home</a>
        <a href="news.html" class="links">News</a>
        <a href="performance.html" class="links">Performance</a>
        <a href="tickets.html" class="links">Tickets</a>
        <a href="search.html" class="links">Search</a>
    </header>
    <div class="card">
            <?php
            if (count($answer) > 0) {
                foreach ($answer as $row) {
                    echo "<h1>你的完整資料為</h1>"?>
                    <table class="table">
                        <tr>
                            <th>名字</th>
                            <th>姓氏</th>
                            <th>手機號碼</th>
                            <th>密碼</th>
                            <th>圖片</th>
                            <th>動作</th>
                        </tr>
                        <tr>
                            <td><?=$row['firstname']?></td>
                            <td><?=$row['lastname']?></td>
                            <td><?=$row['phone']?></td>
                            <td><?=$row['password']?></td>
                            <td>
                                <img src='data:image/png;base64,<?=$row['image']?>'></img><br><br>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="del(<?=$row['id']?>)">刪除</button>
                                <button class="btn btn-warning edit" data-row="<?=json_encode($row)?>">修改</button>
                            </td>
                        </tr>
                    </table>
                <?php }
            } else {
                echo "<h1 class='danger'>查無資料</h1>";
            }
            ?>
            <a href="search.html" class="btn btn-secondary" id="back-button">回到查詢頁面</a>
    </div>
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <table class="table">
                    <tr>
                        <th>名字</th>
                        <th>姓氏</th>
                        <th>手機號碼</th>
                        <th>密碼</th>
                    </tr>
                    <tr>
                        <th><input type="text" class="form-control" id="firstname"></th>
                        <th><input type="text" class="form-control" id="lastname"></th>
                        <th><input type="text" class="form-control" id="phone"></th>
                        <th><input type="text" class="form-control" id="password"></th>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="medias">
            <img src="./img/2023_Facebook_icon.svg" alt="">
            <img src="./img/1600x1600_wmkn_423662835613_0.jpg" alt="">
            <img src="./img/Instagram_logo_2022.svg" alt="">
            <img src="./img/YouTube_social_white_circle_(2017).svg.png" alt="">
        </div>
        <p>Copyright © 2024 FIBEX All Rights Reserved</p>
    </footer>

    <script src="jquery.js"></script>
    <script src="bootstrap.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script>
        function del(id) {
            var check = confirm("確認刪除資料?")
            if (check) {
                $.post("del.php",function () {
                    alert("資料已刪除")
                    location.href = "home.html"
                })
            }
        }
        $(".edit").click(function name(params) {
            let array = $(this).data('row')
            console.log(array);
            
            $("#firstname").val(array.firstname)
            $("#lastname").val(array.lastname)
            $("#phone").val(array.phone)
            $("#password").val(array.password)
            $(".modal").modal("show")
        })
    </script>
</body>
</html>