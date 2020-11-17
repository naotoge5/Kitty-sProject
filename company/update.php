<?php
try {
    include('../assets/functions.php');
    //タイムゾーンを日本に設定
    date_default_timezone_set('Asia/Tokyo');
   
    $pdo = getPDO();//pdo取得

    $id = $_POST['id'];
    $name = $_POST['name'];
    $details = $_POST['details'];
    $category = $_POST['category'];
    $datetime = $_POST['datetime'];
    $company_id = $_SESSION['id'];
    $object_update = date("Y-m-d H:i:s");

    if(!empty($id)){
      //落し物の編集
      $stmt = $pdo->prepare("UPDATE objects SET name = :name, details = :details, category = :category, datetime = :datetime WHERE id = :id");
      $stmt->execute(array(":name" => $name, ":details" => $details, ":category" => $category, ":datetime" => $datetime, ":id" => $id));

      $company_id = $_SESSION['id'];
      $stmt = $pdo->prepare("UPDATE companies SET object_update = :object_update WHERE id = :id");
      $stmt->execute(array(":object_update" => $object_update, ":id" => $company_id));

      $_SESSION['message'] = "落し物の編集が完了しました";
    }else{
      //落し物の新規登録
      $stmt = $pdo->prepare("INSERT INTO objects VALUES(null, :name, :details, :category, :datetime, :company_id)");
      $stmt->execute(array(":name" => $name, ":details" => $details, ":category" => $category, ":datetime" => $datetime, ":company_id" => $company_id));
      
      $stmt = $pdo->prepare("UPDATE companies SET object_update = :object_update WHERE id = :id");
      $stmt->execute(array(":object_update" => $object_update, ":id" => $company_id));
      
      $_SESSION['message'] = "落し物の登録が完了しました";
    }
    header("Location:management.php");

} catch (PDOException $e) {
    die($e->getMessage());
    $_SESSION['message'] = !empty($_POST['id']) ? "落し物の編集に失敗しました" : "落し物の登録に失敗しました";

    header("Location:register.php");
}
?>