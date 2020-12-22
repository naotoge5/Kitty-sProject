<?php
include('../assets/functions.php');
?>
<!DOCTYPE html>
<head>
<html lang="ja">
<meta charaset="UTF-8">
<title>カテゴリー選択</title>
 <!-- style -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/public.js"></script>
</head>
<body>
<main>
<form id="search" method="get" action="search.php">
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
                    <div class="fixed-bottom m-2">
                <button type="submit" class="btn btn-success btn-block">検索する</button>
            </div>
</form>
</main>
</body>
</html>