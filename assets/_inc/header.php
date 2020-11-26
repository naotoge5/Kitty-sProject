<?php
$title = isset($title) ? $title : '落とし物検索';
$sever_url = $_SERVER['REQUEST_URI'];
$level = preg_match('/authentication/', $sever_url) ? '../' : '';
$jslink = strpos($sever_url, 'public') !== false ? '../assets/js/public.js' : '../assets/js/company.js';
$flag = true;
?>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title ?></title>
        <!-- jQueryの読み込み -->
        <script src="<?= $level ?>../assets/js/jquery-3.5.1.js"></script>
        <!-- javascriptの読み込み -->
        <script src="<?= $level . $jslink ?>"></script>
        <!-- BootstrapのCSS読み込み -->
        <link href="<?= $level ?>../assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- BootstrapのJS読み込み -->
        <script src="<?= $level ?>../assets/js/bootstrap.min.js"></script>
    </head>
<body>
    <header class="fixed-top">
        <?php if (preg_match('/authentication/', $sever_url)):
            unset($_SESSION['id']);
            if (isset($_POST['logout'])) {
                alert('ログアウトしました', 'SUCCESS');
            } ?>
        <?php else: ?>
            <div class="pos-f-t">
                <?php if (preg_match('/public/', $sever_url)): ?>
                    <!-- top, show -->
                    <nav class="navbar navbar-dark bg-dark py-3">
                        <a class="navbar-brand" href="#">落とし物検索サービス</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarToggleExternalContent"
                                aria-controls="navbarToggleExternalContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                    <div class="collapse" id="navbarToggleExternalContent">
                        <form id="search" method="get" action="search.php">
                            <li class="list-group-item">
                                <input class="form-control" type="search" name="name" placeholder="落とし物、お店の名前"
                                       aria-label="Search">
                            </li>
                            <a class="list-group-item list-group-item-action" data-toggle="collapse"
                               href=".category">
                                カテゴリーで絞り込む
                            </a>
                            <div class="collapse category">
                                <li class="list-group-item list-group-flush">
                                    <select name="categories" class="form-control" required>
                                        <option value="カテゴリーを選択してください">カテゴリーを選択してください</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category; ?>"><?= $category; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </li>
                            </div>
                            <a class="list-group-item list-group-item-action" data-toggle="collapse"
                               href=".area">地域から絞り込む
                            </a>
                            <div class="collapse area">
                                <li class="list-group-item list-group-flush">
                                    <select name="prefectures" class="form-control" required>
                                        <option value="都道府県を選択してください">都道府県を選択してください</option>
                                        <?php foreach ($regions as $region => $prefectures): ?>
                                            <optgroup label="<?= $region ?>">
                                                <?php foreach ($prefectures as $prefecture): ?>
                                                    <option value="<?= $prefecture ?>"><?= $prefecture ?></option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php endforeach; ?>
                                    </select>
                                </li>
                                <li class="list-group-item list-group-flush">
                                    <select name="cities" class="form-control" required>
                                        <option value="市区町村を選択してください">市区町村を選択してください</option>
                                    </select>
                                </li>
                                <li class="list-group-item">
                                    <select name="towns" class="form-control" required>
                                        <option value="町域を選択してください">町域を選択してください</option>
                                    </select>
                                </li>
                                <li class="list-group-item list-group-flush list-group-item-action">
                                    <input type="submit" value="絞り込み">
                                </li>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <!-- management, register -->
                    <form method="POST" name="logout" action="authentication/login.php">
                        <input type="hidden" name="logout">
                    </form>
                    <nav class="navbar navbar-dark bg-dark py-3">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                    <div class="collapse" id="navbarToggleExternalContent">
                        <?php
                        if (!isset($_SESSION['id'])) {
                            alert('ログインしてください', 'CAUTION');
                            header('Location:authentication/login.php');
                            exit;
                        }
                        ?>
                        <a href="management.php"
                           class="list-group-item list-group-flush list-group-item-action">管理画面</a>
                        <a href="#" class="list-group-item list-group-flush list-group-item-action">メール、パスワード変更</a>
                        <a href="register.php" class="list-group-item list-group-flush list-group-item-action">新規登録</a>
                        <a href="javascript:logout.submit()"
                           class="list-group-item list-group-flush list-group-item-action">ログアウト</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['alert'])): ?>
            <div class="<?= $_SESSION['alert']['class'] ?> fade show text-center mb-0" role="alert">
                <strong><?= $_SESSION['alert']['message'] ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $flag = $_SESSION['alert']['continue'];
            unset($_SESSION['alert']);
            ?>
        <?php endif; ?>
    </header>
    <div class="py-4">&nbsp;</div>
    <div class="py-1">&nbsp;</div>
<?php if (!$flag): ?>
    <main>
        <div class="container">
            <div class="card my-4">
                <div class="card-header pb-0">
                    <h3 class="card-title">読み込みエラー</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-subtitle">申し訳ございません、<br>しばらくしてからもう一度お試しください。</h4>
                </div>
            </div>
        </div>
    </main>
<?php exit; endif; ?>