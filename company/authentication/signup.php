<?php
//新規登録
include('../../assets/functions.php');
$flag = true;
if (!isset($_GET['token'])) {
    $_SESSION['alert'] = alertType('無効なURLです', 'ERROR');
    header("Location:login.php");
    exit;
} else {
    switch ($result = read_preCompanyData($_GET['token'])) {
        case 0:
            $_SESSION['alert'] = alertType('トークンが違うか、24時間以上経っている可能性があります', 'ERROR');
            header('Location:login.php');
            exit;
        case -1:
            $flag = false;
            $_SESSION['alert'] = alertType('データベース接続エラー', 'ERROR');
            break;
        default:
            $mail = $result['mail'];
    }
}
$title = 'サインアップ';
include('../../assets/_inc/header.php');
?>
<main>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $title ?></h3>
            </div>
            <div class="card-body">
                <?php if ($flag): ?>
                <div class="ml-3">
                    <form id="signup" action="create.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <h5 class="card-title">企業名</h5>
                                <input type="text" name="name_first" class="form-control" placeholder="会社名,チェーン名"
                                       required>
                            </div>
                            <div class="form-group col-sm-6">
                                <h5 class="card-title"> 　 </h5>
                                <input type="text" name="name_second" class="form-control" placeholder="支店名,店舗名"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="card-title">電話番号</h5>
                            <input type="tel" name="tel" class="form-control" placeholder="ハイフン無し,半角" required>
                        </div>
                        <div class="form-group">
                            <h5 class="card-title">郵便番号</h5>
                            <input type="text" class="form-control" pattern="[0-9]{7}" maxlength="7" minlength="7"
                                   name="postal" placeholder="ハイフン無し,半角" required>
                            <input type="button" class="form-control" id="auto" value="住所自動入力">
                        </div>
                        <div class="form-group">
                            <h5 class="card-title">住所</h5>
                            <input type="text" name="prefecture" class="form-control" placeholder="都道府県" required>
                            <input type="text" name="city" class="form-control" placeholder="市区町村" required>
                            <input type="text" name="town" class="form-control" placeholder="町名番地" required>
                        </div>
                        <div class="form-group">
                            <h5 class="card-title">メールアドレス</h5>
                            <input type="email" name="mail" class="form-control" value="<?= $mail ?>" required>
                        </div>
                        <div class="form-group">
                            <label>パスワード</label>
                            <input type="password" name="password" class="form-control" placeholder="半角英数"
                                   pattern="^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,20}$" required>
                            <small class="form-text text-muted">パスワードは半角英数字をそれぞれ1種類以上含む8文字以上</small>
                        </div>
                        <div class="form-group">
                            <label>パスワード（確認）</label>
                            <input type="password" name="password_check" class="form-control" placeholder="半角英数"
                                   required>
                        </div>
                        <input type="submit" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
        <h4>申し訳ございません、<br>しばらくしてからもう一度お試しください。</h4>
    <?php endif; ?>
</main>
<?php include('../../assets/_inc/footer.php') ?>
