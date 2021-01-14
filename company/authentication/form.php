<?php
include('../../assets/functions.php');
if ($_GET['pattern'] == 'signup') {
    $title = '新規登録のURLが送信されます';
} else if ($_GET['pattern'] == 'forgot') {
    $title = 'パスワード変更のURLが送信されます';
} else {
    header('Location:login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>確認</title>

    <!-- css読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- 外部js読み込み -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <!-- script -->
    <script src="../../assets/js/company.js"></script>
</head>

<body>
    <?php include('../../assets/_inc/header.php') ?>
    <div class="my-4 py-4">&nbsp;</div>
    <main>
        <div class="container" style="width: 28rem;">
            <div class="card my-4">
                <h3 class="card-header">確認</h3>
                <div class="card-body d-none d-sm-block">
                <h5 class="card-title"><?= $title ?></h5>
                    <form id="form" action="mail.php?pattern=<?= $_GET['pattern'] ?>" method="post">
                        <div class="form-group">
                            <label>メールアドレス</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope fa-fw"></i></div>
                                </div>
                                <input type="email" class="form-control" name="mail" placeholder="email" required>
                            </div>
                            <small class="form-text text-muted">ログインは<a href="login.php">こちら</a></small>
                        </div>
                        <input type="submit" class="btn btn-info">
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
</body>

</html>