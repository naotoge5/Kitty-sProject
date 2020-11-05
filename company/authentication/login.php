<?php
if (isset($_SESSION['id'])) {
    header('../management.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>login</title>
    <script src="../../assets/js/jquery-3.5.1.js"></script>
    <script src="../../assets/js/company.js"></script>
</head>
<body>
<header></header>
<h1>ログインページ</h1>
<h2>ログイン</h2>
<form id="sign" action="check.php" method="post">
    <table>
        <tr>
            <th>メールアドレス</th>
            <td><input type="email" name="mail" required></td>
        </tr>
        <tr>
            <th>パスワード</th>
            <td><input type="password" name="password"></td>
        </tr>
    </table>
    <input type="submit">
</form>
<h2>新規登録</h2>
<form action="create.php" method="post">
    <table>
        <tr>
            <th>企業名</th>
            <td><input type="text" name="name" required></td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td><input type="tel" name="tel" required></td>
        </tr>
        <tr>
            <th>郵便番号</th>
            <td><input type="text" pattern="[0-9]{7}" maxlength="7" minlength="7" name="postal" placeholder="郵便番号"
                       required></td>
        </tr>
        <tr>
            <th>住所</th>
            <td><input type="text" name="address" placeholder="例：東京都新宿区西新宿二丁目8番1号" required></td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td><input type="email" name="mail" required></td>
        </tr>
        <tr>
            <th>パスワード</th>
            <td><input type="password" name="password" required></td>
        </tr>
    </table>
    <input type="submit">
</form>
</body>
</html>