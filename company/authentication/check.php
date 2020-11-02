<?php
try {
    include("connect.php");
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare(
        "SELECT * FROM companies WHERE mail=:mail");
    $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
    $stmt->execute();
    //結果の取り出し
    $result = $stmt->fetch();
    $pdo = null;

    // 可否を判断する
    if (password_verify($password, $result['password'])) {
        $_SESSION['id'] = $result['id'];
        // ログイン成功
        header("Location:../management.php");
    } else {// ログイン失敗
        header("Location:failure.html");
    };

} catch (PDOException $e) {
    die($e->getMessage());
}