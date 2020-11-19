<?php
include('../assets/functions.php');
$name = isset($_POST['name']) ? $_POST['name'] : null;
$details = $_POST['details'];
$category = $_POST['category'];
$datetime = $_POST['datetime'];
$object_id = $_POST['id'];
$company_id = $_SESSION['id'];
static $alert;
if (is_null($name)) {
    $alert = messageType('不正なアクセスです');
} else {
    switch (empty($object_id) ? updateObject($company_id, 0) : updateObject($object_id)) {
        case -1:
            $_SESSION['alert'] = messageType('データベース接続エラー');
            $url = empty($object_id) ? 'Location:register.php' : 'Location:register.php?id=' . $object_id;
            header($url);
            exit;
        case 0:
            $alert = messageType('落し物の登録が完了しました', true);
            break;
        case 1:
            $alert = messageType('落し物の編集が完了しました', true);
            break;
    }
}
$_SESSION['alert'] = $alert;
header('Location:management.php');

function updateObject($id, $type = 1)//update=1|insert=0
{
    global $name;
    global $details;
    global $category;
    global $datetime;
    global $company_id;
    $query = $type ? "update objects set name = :name, details = :details, category = :category, datetime = :datetime where id = :id" : "insert into objects values(null, :name, :details, :category, :datetime, :id)";
    try {
        $pdo = getPDO();//pdo取得
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(":name" => $name, ":details" => $details, ":category" => $category, ":datetime" => $datetime, ":id" => $id));
        $stmt = $pdo->prepare("update companies set object_update = now() where id = :id");
        $stmt->bindValue(":id", $company_id, PDO::PARAM_INT);
        $stmt->execute();
        return $type;
    } catch (PDOException $e) {
        return -1;
    } finally {
        unset($pdo);
    }
}