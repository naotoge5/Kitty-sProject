<?php
//会社側のログイン・新規登録ページ
include('../../assets/functions.php');

$title = 'ログイン ／ ご新規';
include('../../assets/_inc/header.php');
?>
    <main>
        <div class="container">
            <div class="card my-4">
                <div class="card-header">
                    <h3 class="card-title mb-0"><?= $title ?></h3>
                </div>
                <div class="card-body d-none d-sm-block">
                    <form id="login" action="check.php" method="post">
                        <div class="form-group">
                            <label>メールアドレス</label>
                            <input type="email" class="form-control" name="mail" required>
                            <small class="form-text text-warning">新規の企業様はメールアドレスを入力後、<br>送信ボタンをクリックしてください。確認のメールが送信されます。</small>
                        </div>
                        <div class="form-group">
                            <label>パスワード</label>
                            <input type="password" class="form-control" name="password">
                            <small class="form-text text-muted">パスワードを忘れた<a href="">場合</a></small>
                        </div>
                        <input type="submit" class="btn btn-success">
                        <small class="text-muted">st071959@m03.kyoto-kcg.ac.jp kittypro0201</small>
                        <small class="text-muted">10naotoge5.ykputi@gmail.com kittypro02</small>
                    </form>
                </div>
                <div class="card-body d-block d-sm-none">
                    <p class="card-text">
                        この画面ではご利用になれません
                    </p>
                </div>
            </div>
        </div>
    </main>
<?php include('../../assets/_inc/footer.php') ?>