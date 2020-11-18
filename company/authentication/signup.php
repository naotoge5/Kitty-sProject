<?php
include('../../assets/functions.php');
$title = 'サインアップ';
$level = '../';
include('../../assets/_inc/header.php');
if (isset($_GET['token'])) {
    $mail = read_preCompanyData($_GET['token'])['mail'];
    /*
    if (!$mail) {
        $_SESSION['message'] = '無効なURLです。';
        header("Location:login.php");
    }*/
} else {
    $_SESSION['alert'] = '無効なURLです。';
    header("Location:login.php");
}
?>
<main>
    <h1>サインアップ</h1>
    <div>
        <form id="signup" action="create.php" method="post">
            <dl>
                <dt>企業名</dt>
                <dd>
                    <input type="text" name="name_first" placeholder="会社名,チェーン名" required>
                    <input type="text" name="name_second" placeholder="支店名,店舗名" required>
                </dd>
                <dt>電話番号</dt>
                <dd><input type="tel" name="tel" placeholder="ハイフン無し,半角" required></dd>
                <dt>郵便番号</dt>
                <dd>
                    <input type="text" pattern="[0-9]{7}" maxlength="7" minlength="7"
                           name="postal" placeholder="ハイフン無し,半角" required>
                    <input type="button" id="auto" value="住所自動入力">
                </dd>
                <dt>住所</dt>
                <dd>
                    <input type="text" name="address_first" placeholder="都道府県" required>
                    <input type="text" name="address_second" placeholder="市区町村" required>
                    <input type="text" name="address_third" placeholder="町名番地" required>
                </dd>
                <dt>メールアドレス</dt>
                <dd>
                    <input type="email" name="mail" value="<?= $mail ?>" required disabled>
                </dd>
                <dt>パスワード</dt>
                <dd>
                    <input type="password" name="password" placeholder="半角英数" required>
                </dd>
                <dt>パスワード（確認）</dt>
                <dd>
                    <input type="password" name="password_check" placeholder="半角英数" required>
                </dd>
            </dl>
            <input type="submit">
        </form>
    </div>
</main>
<script src="../../assets/js/jquery-3.5.1.js"></script>
<script src="../../assets/js/company.js"></script>
<?php include('../../assets/_inc/footer.php') ?>
