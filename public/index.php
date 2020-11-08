<?php
include('../assets/functions.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8"/>
    <title>sample</title>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/public.js"></script>
</head>
<body>
<form method="post" action="">
    <input type="text" name="name" placeholder="店舗名,お忘れ物名">
    <p>複数入力はスペースで区切る。</p>
    <h6>絞り込み↓</h6>
    <select name="prefectures" required>
        <option selected value>未選択</option>
        <?php foreach ($regions as $region => $prefectures): ?>
            <optgroup label="<?= $region ?>">
                <?php foreach ($prefectures as $prefecture): ?>
                    <option value="<?= $prefecture ?>"><?= $prefecture ?></option>
                <?php endforeach; ?>
            </optgroup>
        <?php endforeach; ?>
    </select>
    <select name="cities" required>
        <option selected>未選択</option>
    </select>
    <select name="categories" required>
        <option disabled selected>未選択</option>
        <?php foreach ($categorys as $category): ?>
            <option value="<?= $category; ?>"><?= $category; ?></option>
        <?php endforeach; ?>
    </select>
</form>
</body>
</html>
