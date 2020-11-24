<?php
include('../../assets/functions.php');
$title = 'ログイン';
$level = '../';
include('../../assets/_inc/header.php');
?>
    <main>
        <h1>ログイン</h1>
        <div>
            <form id="login" action="check.php" method="post">
                <dl>
                    <dt>メールアドレス</dt>
                    <dd><input type="email" name="mail" required></dd>
                    <dt>パスワード</dt>
                    <dd><input type="password" name="password"></dd>
                </dl>
                <input type="submit">
            </form>
            <p>※パスワードは半角英数字をそれぞれ1種類以上含む8文字以上</p>
            <p>新規登録の企業様はメールアドレスを入力後、送信ボタンをクリックしてください。</p>
            </body>
            <p>st071959@m03.kyoto-kcg.ac.jp</p>
            <p>kittypro0201</p>
            <p>10naotoge5.ykputi@gmail.com</p>
            <p>kittypro02</p>
        </div>
    </main>
    <script src="../../assets/js/jquery-3.5.1.js"></script>
    <script src="../../assets/js/company.js"></script>
<?php include('../../assets/_inc/footer.php') ?>