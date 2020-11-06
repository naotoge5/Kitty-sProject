<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>SignUp</title>
    <script src="../../assets/js/jquery-3.5.1.js"></script>
    <script src="../../assets/js/company.js"></script>
</head>
<body>
<header></header>
<h1>新規登録</h1>
<form id="signup" action="create.php" method="post">
    <dl>
        <dt>企業名</dt>
        <dd>
            <input type="text" name="name_first" placeholder="会社名,チェーン名" required>
            <input type="text" name="name_second" placeholder="支店名,店舗名" required>
        </dd>
        <dt>電話番号</dt>
        <dd><input type="tel" name="tel" placeholder="ハイフン無し,半角" required></dd>
        <dt>郵便番号</dt>
        <dd>
            <input type="text" pattern="[0-9]{7}" maxlength="7" minlength="7"
                   name="postal" placeholder="ハイフン無し,半角" required>
            <input type="button" value="住所自動入力" id="auto"/>
        </dd>
        <dt>住所</dt>
        <dd>
            <input type="text" name="address_first" placeholder="京都府" required>
            <input type="text" name="address_second" placeholder="京都市南区" required>
            <input type="text" name="address_third" placeholder="西九条寺ノ前町10-5" required>
        </dd>
        <dt>メールアドレス</dt>
        <dd>
            <input type="email" name="mail" value="st071959@m03.kyoto-kcg.ac.jp" required>
        </dd>
        <dt>パスワード</dt>
        <dd>
            <input type="password" name="password" placeholder="半角英数" required>
            <input type="password" name="password_check" placeholder="確認" required>
        </dd>
    </dl>
    <input type="submit">
</form>
</body>
</html>
