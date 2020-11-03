<?php
try {
    include('../assets/functions.php');
   
    $pdo = getPDO();//pdo取得

    //落し物の新規登録
    //変数に格納
    $name = $_POST['name'];
    $details = $_POST['details'];
    $category = $_POST['category'];
    $datetime = $_POST['datetime'];
    $company_id = $_SESSION['id'];
    //insert文の発行
    $stmt = $pdo->prepare("INSERT INTO objects VALUES(null, :name, :details, :category, :datetime, :company_id)");
    $stmt->execute(array(":name" => $name, ":details" => $details, ":category" => $category, ":datetime" => $datetime, ":company_id" => $company_id));

    header("Location:management.php");

    //落し物の編集

} catch (PDOException $e) {
    die($e->getMessage());
    header("Location:register.php");
}
?>