<?php
include('../assets/functions.php');
$company = read_companyData($_SESSION['id'])[0];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>login</title>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/company.js"></script>
</head>
<body>
<table>
    <thead>
    <tr>
        <th colspan="2"><?= $name = htmlspecialchars($company['name']) ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= htmlspecialchars($company['address_first']) . htmlspecialchars($company['address_second']) . htmlspecialchars($company['address_third']) ?></td>
        <td>TEL：<a href="tel:<?= htmlspecialchars($company['tel']) . '">' . htmlspecialchars($company['tel']) ?></a></td>
    </tr>
    <tr>
        <td>
            <iframe src=" https://maps.google.co.jp/maps?output=embed&q=<?= $name ?>"></iframe>
        </td>
        <td><?= htmlspecialchars($company['details']) ?></td>
    </tr>
    </tbody>
</table>
<div>

</div>
<h2>落とし物一覧</h2>
<?php if (read_objectData($_SESSION['id'])) { ?>
    <table border="2">
        <thead>
        <tr>
            <th>名前</th>
            <th>詳細</th>
            <th>ジャンル</th>
            <th>登録日時</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (read_objectData($_SESSION['id']) as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['details']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= htmlspecialchars($row['datetime']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>落とし物が登録されていません。</p>
<?php }
date_default_timezone_set('Asia/Tokyo'); ?>
<?= date("Y-m-d H:i:s") ?>
</body>
</html>