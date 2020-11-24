<?php
$title = isset($title) ? $title : '落とし物検索';
$level = isset($level) ? $level : '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?> </title>
    <!-- BootstrapのCSS読み込み -->
    <link href="<?= $level ?>../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- BootstrapのJS読み込み -->
    <script src="<?= $level ?>../assets/js/bootstrap.min.js"></script>
</head>
<body>
<div id="alert">
    <?php
    if (isset($_SESSION['alert'])):?>
        <p class="alert" style="background: <?= $_SESSION['alert']['color'] ?>"><?= $_SESSION['alert']['message'] ?></p>
        <?php unset($_SESSION['alert']);
    endif; ?>

</div>
