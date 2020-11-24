<?php
//サインアップから遷移
include('../../assets/functions.php');

//変数に格納
$name = $_POST['name_first'] . ' ' . $_POST['name_second'];
$tel = $_POST['tel'];
$postal = $_POST['postal'];
$prefecture = $_POST['prefecture'];
$city = $_POST['city'];
$town = $_POST['town'];
$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

static $alert;
if (is_null($mail)) {
    $alert = alertType('不正なアクセスです', 'ERROR');
} else {
    switch ($id = white_Company()) {
        case -1:
            $alert = alertType('データベース接続エラー', 'ERROR');
            break;
        default:
            $_SESSION['id'] = $id;
            $_SESSION['alert'] = alertType('新規登録が完了しました', 'SUCCESS');
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
    global $prefecture;
    global $city;
    global $town;
    global $mail;
    global $password;
    try {
        $pdo = getPDO();//pdo取得
        //insert文の発行
        $stmt = $pdo->prepare("insert into companies values(null, :name, :tel ,:postal, :prefecture, :city,:town, null, :mail, :password ,null)");
        $stmt->execute(array(":name" => $name, ":tel" => $tel, ":postal" => $postal, ":prefecture" => $prefecture, ":city" => $city, ":town" => $town, ":mail" => $mail, ":password" => $password));
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
