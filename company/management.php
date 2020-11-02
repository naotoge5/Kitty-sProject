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
<header></header>
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
        <?php
        include('../assets/functions.php');
        foreach (read_companyData($_SESSION['id']) as $row) {
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['tel']) . '</td>';
            echo '<td>' . htmlspecialchars($row['address']) . '</td>';
            echo '<td>' . htmlspecialchars($row['mail']) . '</td>';
        }
        ?>
    </tr>
    </tbody>
</table>
<a href="">企業データの編集</a>
<h2>落とし物一覧</h2>
<a href="register.php">新規登録</a>
<?php
if (read_objectData($_SESSION['id'])) {
    echo '<table><thead><tr><th>名前</th><th>詳細</th><th>ジャンル</th><th>登録日時</th></tr></thead><tbody>';
    foreach (read_objectData($_SESSION['id']) as $row) {
        echo '<form name="edit' . htmlspecialchars($row['id']) . '" action="register.php" method="post">';
        echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '"></form>';
        echo '<tr onClick="document.edit' . htmlspecialchars($row['id']) . '.submit();return false;">';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['details']) . '</td>';
        echo '<td>' . htmlspecialchars($row['category']) . '</td>';
        echo '<td>' . htmlspecialchars($row['datetime']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>落とし物が登録されていません。</p>';
}
?>
</body>
</html>
