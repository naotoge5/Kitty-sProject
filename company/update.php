<?php
include('../assets/functions.php');
try {
    $pdo = getPDO();//pdo取得
    $id = $_POST['id'];
    $name = $_POST['name'];
    $details = $_POST['details'];
    $category = $_POST['category'];
    $datetime = $_POST['datetime'];
    $company_id = $_SESSION['id'];

    if (!empty($id)) {
        //落し物の編集
        $stmt = $pdo->prepare("UPDATE objects SET name = :name, details = :details, category = :category, datetime = :datetime WHERE id = :id");
        $stmt->execute(array(":name" => $name, ":details" => $details, ":category" => $category, ":datetime" => $datetime, ":id" => $id));

        $stmt = $pdo->prepare("UPDATE companies SET object_update = now() WHERE id = :id");
        $stmt->bindValue(":id", $company_id, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['notice'] = "落し物の編集が完了しました";
    } else {
        //落し物の新規登録
        $stmt = $pdo->prepare("INSERT INTO objects VALUES(null, :name, :details, :category, :datetime, :company_id)");
        $stmt->execute(array(":name" => $name, ":details" => $details, ":category" => $category, ":datetime" => $datetime, ":company_id" => $company_id));

        $stmt = $pdo->prepare("UPDATE companies SET object_update = now() WHERE id = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['notice'] = "落し物の登録が完了しました";
    }
    header('Location:management.php');

} catch (PDOException $e) {
    //die($e->getMessage());
    $_SESSION['alert'] = !empty($_POST['id']) ? '落し物の編集に失敗しました' : '落し物の登録に失敗しました';

    header('Location:register.php');
}