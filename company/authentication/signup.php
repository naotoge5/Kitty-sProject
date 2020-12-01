<?php
//新規登録
include('../../assets/functions.php');

$token = isset($_GET['token']) ? $_GET['token'] : '';
$mail = readPreCompanyData($token);

$title = 'サインアップ';
include('../../assets/_inc/header.php');

if (!$mail) {
    header("Location:login.php");
    exit;
}
?>
<main>
    <div class="container">
        <div class="card my-4">
            <div class="card-header">
                <h3 class="card-title mb-0"><?= $title ?></h3>
            </div>
            <div class="card-body">
                <div class="ml-3">
                    <form id="signup" action="create.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <h5 class="card-title">企業名</h5>
                                <input type="text" name="name_first" class="form-control" placeholder="会社名,チェーン名"
                                       required>
                            </div>
                            <div class="form-group col-sm-6">
                                <h5 class="card-title">&nbsp;</h5>
                                <input type="text" name="name_second" class="form-control" placeholder="支店名,店舗名"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="card-title">電話番号</h5>
                            <input type="text" name="tel" class="form-control" placeholder="ハイフン有り,半角" pattern="\d{2,4}-\d{2,4}-\d{3,4}" required>
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
                            <input type="email" name="mail" readonly class="form-control" value="<?= $mail ?>" required>
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
</main>
<?php include('../../assets/_inc/footer.php') ?>
