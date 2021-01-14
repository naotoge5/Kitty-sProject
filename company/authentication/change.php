<?php
include('../../assets/functions.php');
//変数に格納
if (isset($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if (connect([$password, $_POST['mail']], "update companies set password = ? where mail = ?")) {
        connect($_POST['mail'], "delete from pre_companies where mail = ?");
        alert('パスワードを変更しました', 'SUCCESS');
    }
} else {
    alert('不正なアクセスです', 'CAUTION');
}
header("Location:login.php");
