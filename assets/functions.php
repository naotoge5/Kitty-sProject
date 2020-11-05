<?php
session_start();
//定数
define('DSN', 'mysql:host=localhost;dbname=kittydb');
define('DB_USER', 'kitty');
define('DB_PASS', 'pro02');
<<<<<<< HEAD
=======

//カテゴリー
$categorys = ['現金','かばん類','袋・封筒類','財布類','カードケース類','カメラ類','時計類','めがね類','電気製品類','携帯電話類','貴金属類','趣味・娯楽用品類','証明書類・カード類','有価証券類','著作品類','手帳・文具類','書類・紙類','小包・箱類','衣類・履物類','雨具類','鍵類','正解用品類','医療・化粧品類','食料品類','動植物類','その他'];

>>>>>>> main
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
<<<<<<< HEAD
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
=======
        if ($stmt->execute(array(":id" => $id))) {
>>>>>>> main
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
<<<<<<< HEAD
        $stmt->bindValue(':company_id', $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
=======
        if ($stmt->execute(array(":company_id" => $id))) {
>>>>>>> main
            return $stmt->fetchAll();
        }
        return false;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
<<<<<<< HEAD

/*--データの更新等--*/
=======
?>
>>>>>>> main
