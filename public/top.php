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
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/public.js"></script>
</head>

<body>
    <?php include("../assets/_inc/header.php") ?>
    <main>
        <form id="search" method="get" action="search.php">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="card form-group">
                            <div class="card-header pb-0">
                                <h4 class="card-title">落とし物、お店の名前</h4>
                            </div>
                            <div class="card-body">
                                <input class="form-control" type="search" name="name" placeholder="search" aria-label="Search">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card form-group">
                            <div class="card-header pb-0">
                                <h4 class="card-title">落とし物の種類</h4>
                            </div>
                            <div class="card-body">
                                <select name="categories" class="form-control" required>
                                    <option value="カテゴリーを選択してください">カテゴリーを選択してください</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category; ?>"><?= $category; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card form-group">
                            <div class="card-header pb-0">
                                <h4 class="card-title">地域</h4>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <select name="prefectures" class="form-control" required>
                                        <option value="都道府県を選択してください">都道府県を選択してください</option>
                                        <?php foreach ($regions as $region => $prefectures) : ?>
                                            <optgroup label="<?= $region ?>">
                                                <?php foreach ($prefectures as $prefecture) : ?>
                                                    <option value="<?= $prefecture ?>"><?= $prefecture ?></option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endforeach; ?>
                                    </select>
                                </li>
                                <li class="list-group-item">
                                    <select name="cities" class="form-control" required>
                                        <option value="市区町村を選択してください">市区町村を選択してください</option>
                                    </select>
                                </li>
                                <li class="list-group-item">
                                    <select name="towns" class="form-control" required>
                                        <option value="町域を選択してください">町域を選択してください</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="m-2">
                &nbsp;
            </div>
            <div class="fixed-bottom m-2">
                <button type="submit" class="btn btn-success btn-block">検索する</button>
            </div>
        </form>
    </main>
    <?php include('../assets/_inc/footer.php') ?>