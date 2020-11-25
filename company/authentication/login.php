<?php
include('../../assets/functions.php');
$title = 'ログイン ／ ご新規';
include('../../assets/_inc/header.php');
?>
    <main>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= $title ?></h3>
                </div>
                <div class="card-body">
                    <form id="login" action="check.php" method="post">
                        <div class="form-group">
                            <label>メールアドレス</label>
                            <input type="email" class="form-control" name="mail" required>
                            <small class="form-text text-muted">新規の企業様はメールアドレスを入力後、<br>送信ボタンをクリックしてください。確認のメールが送信されます。</small>
                        </div>
                        <div class="form-group">
                            <label>パスワード</label>
                            <input type="password" class="form-control" name="password">
                            <small class="form-text text-muted">パスワードを忘れた<a href="">場合</a></small>
                        </div>
                        <input type="submit" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <p>st071959@m03.kyoto-kcg.ac.jp</p>
    <p>kittypro0201</p>
    <p>10naotoge5.ykputi@gmail.com</p>
    <p>kittypro02</p>
<?php include('../../assets/_inc/footer.php') ?>