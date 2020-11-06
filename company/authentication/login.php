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
<h1>ログイン</h1>
<form id="sign" action="check.php" method="post">
    <dl>
        <dt>メールアドレス</dt>
        <dd><input type="email" name="mail" required></dd>
        <dt>パスワード</dt>
        <dd><input type="password" name="password"></dd>
    </dl>
    <input type="submit">
</form>
</body>
<footer><p>新規登録の企業様はメールアドレスを入力後、送信ボタンをクリックしてください。</p></footer>
</html>