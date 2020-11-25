<?php
include('../assets/functions.php');
include('../assets/_inc/header.php');
//var_dump($_SESSION['companies']);

if (isset($_SESSION['results'])) {
    switch ($_SESSION['results']) {
        case -1:
            $_SESSION['alert'] = alertType('データーベース接続エラー', 'ERROR');
            break;
    }
}
?>
<main>
    <h1>落とし物検索</h1>
    <div>
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
                    </optgroup>
                <?php endforeach; ?>
            </select>
            <select name="cities" required>
                <option value="市区町村を選択してください">市区町村を選択してください</option>
            </select>
            <select name="towns" required>
                <option value="町域を選択してください">町域を選択してください</option>
            </select>
            <select name="categories" required>
                <option value="カテゴリーを選択してください">カテゴリーを選択してください</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category; ?>"><?= $category; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="絞り込み">
        </form>
        <table>

            <?php if (isset($_SESSION['results'])): ?>
                <?php foreach ($_SESSION['results'] as $row): ; ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</main>
<?php include('../assets/_inc/footer.php') ?>
