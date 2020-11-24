<?php
//サインアップから遷移
include('../../assets/functions.php');

//変数に格納
$name = $_POST['name_first'] . ' ' . $_POST['name_second'];
$tel = $_POST['tel'];
$postal = $_POST['postal'];
$address_first = $_POST['address_first'];
$address_second = $_POST['address_second'];
$address_third = $_POST['address_third'];
$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

static $alert;
if (is_null($mail)) {
    $alert = messageType('不正なアクセスです');
} else {
    switch ($id = white_Company()) {
        case -1:
            $alert = messageType('データベース接続エラー');
            break;
        default:
            $_SESSION['id'] = $id;
            $_SESSION['alert'] = messageType('新規登録が完了しました', true);
            header('Location:../management.php');
            exit;
    }
}
header('Location:login.php');

function white_Company()
{
    global $name;
    global $tel;
    global $postal;
    global $address_first;
    global $address_second;
    global $address_third;
    global $mail;
    global $password;
    try {
        $pdo = getPDO();//pdo取得
        //insert文の発行
        $stmt = $pdo->prepare("insert into companies values(null, :name, :tel ,:postal, :address_first, :address_second,:address_third, null, :mail, :password ,null)");
        $stmt->execute(array(":name" => $name, ":tel" => $tel, ":postal" => $postal, ":address_first" => $address_first, ":address_second" => $address_second, ":address_third" => $address_third, ":mail" => $mail, ":password" => $password));
        $id = $pdo->lastInsertId();
        $stmt = $pdo->prepare("delete from pre_companies where mail = :mail");
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        return $id;
    } catch (PDOException $e) {
        return -1;
    } finally {
        unset($pdo);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>create</title>
</head>
<body>
<p>登録が完了しました。</p>
</body>
</html>
