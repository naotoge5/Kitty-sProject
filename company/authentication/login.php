<?php
include('../../assets/functions.php');
$title = 'ログイン';
$level = '../';
include('../../assets/_inc/header.php');
?>
    <main>
    <div class="container">
        <div class="card">
            <div class="card-header mb-3" >
            <h3 class="card-title"><?= $title ?></h3>
            </div>
            <div class="card-body">
            <form id="login" action="check.php" method="post">
                <div class="form-group">
                    <h5 class="card-title">メールアドレス</h5>
                    <input type="email" name="mail" required>
                    <h5 class="card-title">パスワード</h5>
                    <input type="password" name="password">
                </div>
                <input type="submit"class="btn btn-success">
            </form>
            <p>※パスワードは半角英数字をそれぞれ1種類以上含む8文字以上</p>
            <p>新規登録の企業様はメールアドレスを入力後、送信ボタンをクリックしてください。</p>
            </div>
        </div>
    </div>
    </main>
            <p>st071959@m03.kyoto-kcg.ac.jp</p>
            <p>kittypro0201</p>
            <p>10naotoge5.ykputi@gmail.com</p>
            <p>kittypro02</p>
    </body>
    <script src="../../assets/js/jquery-3.5.1.js"></script>
    <script src="../../assets/js/company.js"></script>
<?php include('../../assets/_inc/footer.php') ?>