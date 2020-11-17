<?php
include('../assets/functions.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>top</title>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/public.js"></script>
</head>
<body>
<form id="search" method="get" action="search.php">
    <input type="search" name="name" placeholder="店舗名,お忘れ物名">
    <p>複数入力はスペースで区切る</p>
    <h6>絞り込み↓</h6>
    <select name="prefectures" required>
        <option value="都道府県を選択してください">都道府県を選択してください</option>
        <?php foreach ($regions as $region => $prefectures): ?>
            <optgroup label="<?= $region ?>">
                <?php foreach ($prefectures as $prefecture): ?>
                    <option value="<?= $prefecture ?>"><?= $prefecture ?></option>
                <?php endforeach; ?>
            </optgroup> git checkout 
    <?php endforeach;?>
    </select>
    <select name="cities" required>
        <option value="市区町村を選択してください">市区町村を選択してください</option>
    </select>
    <select name="towns" required>
        <option value="町域を選択してください">町域を選択してください</option>
    </select>
    <select name="categories" required>
        <option value="カテゴリーを選択してください">カテゴリーを選択してください</option>
        <?php foreach ($categorys as $category): ?>
            <option value="<?= $category; ?>"><?= $category; ?></option>
        <?php endforeach;?>
    </select>
    <input type="submit" value="絞り込み">
</form>
<table>
<?php foreach (($_SESSION['companies']) as $row): ; ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
            </tr>
        <?php endforeach; ?>
</table>

</body>
</html>
