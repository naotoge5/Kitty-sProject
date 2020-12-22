<?php
include('../assets/functions.php');
function update($mail,$password){
    try{
        $pdo = getPDO(); //pdo取得
        $stmt = $pdo->prepare("UPDATE companies SET password=:password  WHERE mail=:mail");
        $stmt->bindValue(":mail",$mail, PDO::PARAM_INT);
        $stmt->bindValue(":password",$password, PDO::PARAM_INT);
        $stmt->execute();
    }catch(PDOException $e){
    
    }


}








?>