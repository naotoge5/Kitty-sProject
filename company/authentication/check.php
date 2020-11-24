<?php
//遷移ページのチェック
include('../../assets/functions.php');
$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
$password = $_POST['password'];
static $alert;
if (is_null($mail)) {
    $alert = messageType('不正なアクセスです');
} else {
    switch ($id = login_check()) {
        case -1:
            $alert = messageType('データベース接続エラー');
            break;
        case 0:
            $alert = messageType('メールアドレス、またはパスワードが違います');
            break;
        default:
            $_SESSION['id'] = $id;
            $_SESSION['alert'] = messageType('ログインしました', true);
            header('Location:../management.php');
            exit;
    }
}
$_SESSION['alert'] = $alert;
header('Location:login.php');

function login_check()
{
    global $mail;
    global $password;
    try {
        $pdo = getPDO();//pd
        $stmt = $pdo->prepare("SELECT * FROM companies WHERE mail=:mail");
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        //結果の取り出し
        $result = $stmt->fetch();
        // 可否を判断する
        return password_verify($password, $result['password']) ? $result['id'] : 0;
    } catch
    (PDOException $e) {
        return -1;
    } finally {
        unset($pdo);
    }
}
