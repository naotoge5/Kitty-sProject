<?php
session_start();
//定数
define('DSN', 'mysql:host=localhost;dbname=kittydb');
define('DB_USER', 'kitty');
define('DB_PASS', 'pro02');
//pdoの取得
function getPDO()
{
    static $pdo;
    try {
        $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO(DSN, DB_USER, DB_PASS, $option);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $pdo;
}

//企業データの呼び出し
function read_companyData($id)
{
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM companies WHERE id=:id");
        if ($stmt->execute(array(":id" => $id))) {
            return $stmt->fetchAll();
        }
        return false;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function read_objectData($id)//落とし物データの呼び出し
{
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM objects WHERE company_id=:company_id");
        if ($stmt->execute(array(":company_id" => $id))) {
            return $stmt->fetchAll();
        }
        return false;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>