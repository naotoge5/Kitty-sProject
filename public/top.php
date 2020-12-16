<?php
include('../assets/functions.php');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="description" content="落とし物検索システム">
    <title>落とし物検索システム</title>

    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/public.js"></script>
</head>

<body>
    <?php include("../assets/_inc/header.php") ?>
    <main>
        <div class="vh-100 d-flex align-items-center">
            <div class="container px-4">
                <h3 class="text-center text-black pb-4">落とし物検索</h3>
                <form id="search" method="get" action="search.php">
                    <div class="input-group">
                        <input class="form-control border-secondary" type="search" name="name" placeholder="店舗名" aria-label="Search">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-secondary rounded-right" style="border-radius: 0px;"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <div class="fixed-bottom m-2">
                    <button type="button" data-toggle="collapse" data-target="#narrow" class="btn btn-success btn-block">絞り込み検索</button>
                    <div id="narrow" class="collapse">
                        <div class="card card-body m-2 bg-light">
                            <form action="" method="GET">
                                <div class="form-group">
                                    <label>カテゴリ</label>
                                    <select name="categories" class="form-control" required>
                                        <option value="カテゴリーを選択してください">カテゴリーを選択してください</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?= $category; ?>"><?= $category; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('../assets/_inc/footer.php') ?>
</body>

</html>