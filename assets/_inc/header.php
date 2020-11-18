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
    <link rel="stylesheet" href="<?= $level ?>../assets/css/style.css">
</head>
<body>
<div id="alert">
    <?php
    if (isset($_SESSION['notice'])) {
        echo '<p class="notice">' . $_SESSION['notice'] . '</p>';
        unset($_SESSION['notice']);
    } else if (isset($_SESSION['alert'])) {
        echo '<p class="alert">' . $_SESSION['alert'] . '</p>';
        unset($_SESSION['alert']);
    }
    ?>
</div>
