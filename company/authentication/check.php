<?php
//遷移ページのチェック　ログイン可否
include('../../assets/functions.php');
if (isset($_POST['mail'])) {
    $company = read($_POST['mail'], "select * from companies where mail = ?");
    if (password_verify($_POST['password'], $company['password'])) { // 可否を判断する
        $_SESSION['id'] = $company['id'];
        alert('ログインしました', 'SUCCESS');
        header('Location:../management.php');
        exit;
    }
    alert('メールアドレス、またはパスワードが違います', 'CAUTION');
} else {
    alert('不正なアクセスです', 'CAUTION');
}
header('Location:login.php');
