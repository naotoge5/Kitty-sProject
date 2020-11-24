<?php
include('../assets/functions.php');
$id = isset($_POST['id']) ? $_POST['id'] : null;
static $alert;
if (is_null($id)) {
    $alert = alertType('不正なアクセスです', 'ERROR');
} else {
    switch (deleteObject()) {
        case -1:
            $_SESSION['alert'] = alertType('データベース接続エラー', 'ERROR');
            $url = empty($object_id) ? 'Location:register.php' : 'Location:register.php?id=' . $object_id;
            header($url);
            exit;
        case 1:
            $alert = alertType('落し物の削除が完了しました', 'SUCCESS');
            break;
    }
}
$_SESSION['alert'] = $alert;
header('Location:management.php');

function deleteObject()
{
    global $id;
    try {
        $pdo = getPDO();//pdo取得
        $stmt = $pdo->prepare("DELETE FROM objects WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return 1;

    } catch (PDOException $e) {
        return -1;
    } finally {
        unset($pdo);
    }
}

?>