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

/*--データの更新等--*/
//未着手
function delete_userID($id)
{
    try {
        global $conn;
        $statement = $conn->prepare("DELETE FROM users WHERE id=:id");
        $ret = $statement->execute(array(":id" => $id));
        $count = ($ret) ? $statement->rowCount() : 0;

        return $count;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

//
// ユーザを1件更新
// 成功すれば1を返す。失敗や変更がなければ0を返す。
function update_userID($id, $userID, $password, $name)
{
    try {
        global $conn;

        $statement = $conn->prepare("UPDATE users 
			SET userID=:userID , password=:password , name=:name WHERE id=:id");
        $ret = $statement->execute(
            array(":id" => $id,
                ":userID" => $userID,
                ":password" => $password,
                ":name" => $name)
        );
        $count = ($ret) ? $statement->rowCount() : 0;

        return $count;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


//
// ユーザのキーワード検索
// 成功すれば，検索結果の連想配列を返す。
function search_userID($keyword)
{
    try {
        global $conn;
        $result = $conn->prepare(
            "SELECT * FROM users WHERE name LIKE :keyword ");
        $result->execute(array(":keyword" => "%{$keyword}%"));

        return $result;

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

//public-----------------------------------------------------------------------
function objects_date($flag){ //order by id datetimeで時間順に取りたい

try{
     $pdo = getPDO();
     if($flag){
     $stmt = $pdo->query("SELECT * FROM objects order by datetime");//trueの場合は時間の古い順
     return $stmt->fetchAll();
     }else{
        $stmt = $pdo->query("SELECT * FROM objects order by datetime desc");//falseの場合は最新順
        return $stmt->fetchAll();
     }
}catch(PDOException $e){
     die($e->getMessage());
}
}

function objects_name($name){ //名前検索
try{
        $pdo = getPDO();
        $stmt = $pdo->prepare('SELECT * FROM objects WHERE name=:name');
        $stmt->bindValue(':name',$name,PDO::PARAM_STR);
        $stmt->execute();
       return $stmt->fetchAll();
}catch(PDOException $e){
        die($e->getMessage());
}   
}

function objects_category($category){//カテゴリー検索
try{
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM objects WHERE category=:category");
        $stmt->bindValue(':category',$category,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
}catch(PDOException $e){
        die($e->getMessage());
}
}