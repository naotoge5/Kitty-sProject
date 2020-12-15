<?php
include('../assets/functions.php');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>落とし物検索システム</title>

    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/public.js"></script>
    <style>
        .rounded-right {
            border-radius: 0px;
        }
    </style>
</head>

<body>
    <?php include("../assets/_inc/header.php") ?>
    <main>
        <div class="vh-100 d-flex align-items-center">
            <div class="container">
                <h3 class="text-center text-black pb-4">落とし物検索</h3>
                <form id="search" method="get" action="search.php">
                    <div class="input-group">
                        <input class="form-control border-secondary" type="search" name="name" placeholder="店舗名" aria-label="Search">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-secondary rounded-right"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <div class="fixed-bottom m-2">
                    <button type="button" class="btn btn-success btn-block">絞り込み条件を選ぶ</button>
                </div>
            </div>
        </div>
    </main>
    <?php include('../assets/_inc/footer.php') ?>
</body>

</html>