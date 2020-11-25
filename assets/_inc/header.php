<?php
$title = isset($title) ? $title : '落とし物検索';
$sever_url = $_SERVER['REQUEST_URI'];
$level = strpos($sever_url, 'authentication') !== false ? '../' : '';
$jslink = strpos($sever_url, 'public') !== false ? '../assets/js/public.js' : '../assets/js/company.js';
?>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title ?></title>
        <!-- BootstrapのCSS読み込み -->
        <link href="<?= $level ?>../assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- BootstrapのJS読み込み -->
        <script src="<?= $level ?>../assets/js/bootstrap.min.js"></script>
        <!-- jQuery読み込み -->
        <script src="<?= $level ?>../assets/js/jquery-3.5.1.js"></script>
        <!-- script -->
        <script src="<?= $level . $jslink ?>"></script>
    </head>
<body>
<?php if (isset($_SESSION['alert'])): ?>
    <div class="<?= $_SESSION['alert']['class'] ?> text-center" role="alert">
        <?= $_SESSION['alert']['message'] ?>
    </div>
    <?php unset($_SESSION['alert']); else: ?>
    <div class="alert">&nbsp;</div>
<?php endif; ?>
<?php if (preg_match('/management/', $sever_url) or preg_match('/register/', $sever_url)):
    if (!isset($_SESSION['id'])) {
        header('Location:authentication/login.php');
    } else if (isset($_POST['logout'])) {
        unset($_SESSION['id']);
        $_SESSION['alert'] = alertType('ログアウトしました', 'SUCCESS');
        header('Location:authentication/login.php');
    } ?>
    <form method="POST" name="logout" action="">
        <input type="hidden" name="logout">
        <nav class="nav justify-content-center" style="margin-bottom: 1rem">
            <a class="nav-link" href="management.php">管理画面</a>
            <a class="nav-link" href="#">メール、パスワード変更</a>
            <a class="nav-link" href="javascript:logout.submit()">ログアウト</a>
        </nav>
    </form>
<?php endif; ?>