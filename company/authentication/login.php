<?php
include('../../assets/functions.php');
unset($_SESSION['id']);
if (isset($_POST['logout'])) alert('ログアウトしました', 'SUCCESS');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>ログイン</title>

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
                <h3 class="card-header">ログイン</h3>
                <div class="card-body d-none d-sm-block">
                    <form id="login" action="check.php" method="post">
                        <div class="form-group">
                            <label>メールアドレス</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope fa-fw"></i></div>
                                </div>
                                <input type="email" class="form-control" id="inlineFormInputGroup" name="mail" placeholder="email" required>
                            </div>
                            <small class="form-text text-muted">新規の企業様は<a href="form.php?pattern=signup">こちら</a></small>
                        </div>
                        <div class="form-group">
                            <label>パスワード</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock fa-fw"></i></div>
                                </div>
                                <input type="password" class="form-control" id="inlineFormInputGroup" name="password" placeholder="password" required>
                            </div>
                            <small class="form-text text-muted">パスワードを忘れた<a href="form.php?pattern=forgot">場合</a></small>
                        </div>
                        <input type="submit" class="btn btn-info" value="ログイン">
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