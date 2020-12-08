<?php
$title = isset($title) ? $title : '落とし物検索';
$sever_url = $_SERVER['REQUEST_URI'];
$level = preg_match('/authentication/', $sever_url) ? '../' : '';
$link = preg_match('/public/', $sever_url) ? 'public' : 'company';
$flag = true;
?>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <title><?= $title ?></title>

        <!-- css読み込み -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
        <!-- 外部js読み込み -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/ja.js"></script>
        <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
        <!-- 各js読み込み -->
        <script src="<?= $level . '../assets/js/' . $link . '.js' ?>"></script>
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
                    <div class="navbar navbar-dark bg-dark py-3">
                        <a class="navbar-brand" href="top.php">&nbsp;&nbsp;落とし物検索</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarContent"
                                aria-controls="navbarContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse bg-white" id="navbarContent">
                        <ul class="list-group list-group-flush">
                            <a href="top.php"
                               class="list-group-item list-group-item-action">検索ページ</a>
                            <button class="list-group-item list-group-item-action"
                                    data-toggle="collapse"
                                    data-target="#favoriteContent"
                                    aria-controls="favoriteContent"
                                    aria-expanded="false">お気に入り
                            </button>
                            <div class="collapse px-3 border-bottom" id="favoriteContent">
                                <ul class="list-group list-group-flush">
                                    <a class="list-group-item text-decoration-none text-dark">お店1</a>
                                    <a class="list-group-item text-decoration-none text-dark">お店2</a>
                                </ul>
                            </div>
                        </ul>
                    </div>
                <?php else: ?>
                    <!-- management, register -->
                    <form method="POST" name="logout" action="authentication/login.php">
                        <input type="hidden" name="logout">
                    </form>
                    <nav class="navbar navbar-dark bg-dark py-3">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarContent" aria-controls="navbarContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand" href="#">管理画面</a>
                    </nav>
                    <div class="collapse" id="navbarContent">
                        <?php
                        if (!isset($_SESSION['id'])) {
                            alert('ログインしてください', 'CAUTION');
                            header('Location:authentication/login.php');
                            exit;
                        }
                        ?>
                        <a href="management.php"
                           class="list-group-item list-group-flush list-group-item-action">ホーム</a>
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