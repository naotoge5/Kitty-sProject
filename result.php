<?php
include("assets/functions.php");
include("search.php");
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>落とし物検索システム-検索結果</title>

    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/public.js"></script>
</head>

<body>
    <?php include("assets/_inc/header.php") ?>
    <div class="my-4 py-4">&nbsp;</div>
    <main>
        <div class="container">
            <?php if ($companies) : ?>
                <p><?= implode(",", $param) ?>に該当するデータは<?= count($companies) ?>件です</p>
                <div class="row">
                    <?php foreach ($companies as $company) : ?>
                        <div class="col-12 col-sm-6 my-2">
                            <div class="card">
                                <a href="show.php?id=<?= h($company['id']) ?>" class="card-link card-header">
                                    <?= h($company['name']) ?>
                                </a>
                                <div class="card-body">
                                    <p class="card-text"><?= h($company['details']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="card my-2">
                    <div class="card-body">
                        <p class="card-text"><?= implode(",", $param) ?>に該当するデータがありませんでした</p>
                    </div>
                </div>
            <?php endif; ?>
            <div class="text-right">
                <button type="button" class="btn btn-primary" onclick="history.back()">検索画面に戻る</button>
            </div>
        </div>
    </main>
    <?php include 'assets/_inc/footer.php' ?>
</body>

</html>