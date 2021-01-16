<?php
include('../../assets/functions.php');
$token = isset($_GET['token']) ? $_GET['token'] : '';
$pre_company = read($token, "select * from pre_companies where token = ? and datetime > now() - interval 24 hour");

if ($pre_company) {
    $company = read($pre_company['mail'], "select * from companies where mail = ?");
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
    <title>パスワード変更</title>

    <!-- style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- script -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/company.js"></script>
</head>

<body>
    <?php include('../../assets/_inc/header.php') ?>
    <div class="my-4 py-4">&nbsp;</div>
    <main>
        <div class="container" style="max-width: 28rem;">
            <div class="card my-4">
                <h3 class="card-header">パスワード変更</h3>
                <div class="card-body d-none d-sm-block">
                    <h4 class="card-title"><?= h($company['name']) ?></h4>
                    <form id="reset" action="change.php" method="post">
                        <div class="form-group">
                            <label>メールアドレス</label>
                            <input type="email" name="mail" readonly class="form-control" value="<?= h($company['mail']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>新規パスワード</label>
                            <input type="password" class="form-control" name="password" placeholder="password" required>
                        </div>
                        <div class="form-group">
                            <label>パスワード（確認）</label>
                            <input type="password" class="form-control" name="password_check" placeholder="password" required>
                        </div>
                        <input type="submit" class="btn btn-info" value="変更する">
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