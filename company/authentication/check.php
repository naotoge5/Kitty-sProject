<?php
//遷移ページのチェック
include('../../assets/functions.php');
$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
$password = $_POST['password'];
$url = 'Location:login.php';
if (is_null($mail)) {
    alert('不正なアクセスです', 'CAUTION');
} else if (login_check()) {
    $url = 'Location:../management.php';
}
header($url);

function login_check()
{
    global $mail;
    global $password;
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("select * from companies where mail=:mail");
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();//結果の取り出し
        if (password_verify($password, $result['password'])) {// 可否を判断する
            $_SESSION['id'] = $result['id'];
            alert('ログインしました', 'SUCCESS');
            return 1;
        } else {
            alert('メールアドレス、またはパスワードが違います', 'CAUTION');
            return 0;
        }
    } catch (PDOException $e) {
        alert('データーベース接続エラー', 'ERROR');
        return 0;
    } finally {
        unset($pdo);
    }
}
