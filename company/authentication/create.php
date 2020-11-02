<?php
try {
    include("connect.php");
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $mail = $_POST['mail'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare(
        "INSERT INTO companies VALUES(null, :name  , :tel , :address, :mail, :password )");
    //$stmt->bindValue();
    $stmt->execute(array(":name" => $name, ":tel" => $tel, ":address" => $address, ":mail" => $mail, ":password" => $password));
    $_SESSION['id'] = $pdo->lastInsertId();
} catch (PDOException $e) {
    die($e->getMessage());
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
