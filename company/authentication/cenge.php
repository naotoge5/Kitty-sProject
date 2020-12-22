<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
 <title>パスワードを忘れた場合</title>
</head>
<body>
    <form action="mail.php" method="post">
    <p>パスワード忘れた場合はメールアドレスを入力してください</p>
    <p>*登録時のメールアドレスでお願いします*</p>
    <input type="email"  name="confirmation_email" >
    <p>変更したいパスワードを入力してください</p>
    <input type="text"  name="password" >
    <input type="submit" class="btn">
</form>
</body>

</html>