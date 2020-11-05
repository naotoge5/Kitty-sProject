<?php include('header.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>login</title>
    <script src="../assets/js/jquery-3.5.1.js"></script>
    <script src="../assets/js/company.js"></script>
</head>
<body>
<h1>管理画面</h1>
<table>
    <thead>
    <tr>
        <th>企業名</th>
        <th>電話番号</th>
        <th>住所</th>
        <th>メールアドレス</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?php foreach (read_companyData($_SESSION['id']) as $row): ?>
            <td><?= $name = htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['tel']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td><?= htmlspecialchars($row['mail']) ?></td>
        <?php endforeach; ?>
    </tr>
    </tbody>
</table>
<div>
    <iframe src="https://maps.google.co.jp/maps?output=embed&q=<?= $name ?>"></iframe>
</div>
<a href="">企業データの編集</a>
<h2>落とし物一覧</h2>
<a href="register.php">新規登録</a>
<?php if (read_objectData($_SESSION['id'])) { ?>
    <table>
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
            <form name="edit<?= htmlspecialchars($row['id']) ?>" action="register.php" method="post">
                <input type="hidden" name="id" value="<?php htmlspecialchars($row['id']) ?>">
            </form>
            <tr onClick="document.edit<?= htmlspecialchars($row['id']) ?>.submit();return false;">
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
<?php } ?>
</body>
</html>
