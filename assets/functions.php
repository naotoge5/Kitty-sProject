<?php
session_start();
//定数
define('DSN', 'mysql:host=localhost;dbname=kittydb');
define('DB_USER', 'kitty');
define('DB_PASS', 'pro02');

//
$regions = ["北海道" => ["北海道"], '東北' => ['青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県'], '関東' => ['茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県'], '中部' => ['新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県'], '近畿' => ['三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県'], '中国' => ['鳥取県', '島根県', '岡山県', '広島県', '山口県'], '四国' => ['徳島県', '香川県', '愛媛県', '高知県'], '九州' => ['福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県']];
//カテゴリー
$categorys = ['現金', 'かばん類', '袋・封筒類', '財布類', 'カードケース類', 'カメラ類', '時計類', 'めがね類', '電気製品類', '携帯電話類', '貴金属類', '趣味・娯楽用品類', '証明書類・カード類', '有価証券類', '著作品類', '手帳・文具類', '書類・紙類', '小包・箱類', '衣類・履物類', '雨具類', '鍵類', '正解用品類', '医療・化粧品類', '食料品類', '動植物類', 'その他'];

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
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        }
        return false;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

//仮登録アドレスデータの呼び出し
function read_pre_mailData($id)
{
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM pre_companies WHERE id=:id");
        $stmt->bindValue(":mail_id", $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        }
        return false;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

//落とし物データの呼び出し
function read_objectData($id)
{
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT * FROM objects WHERE company_id=:company_id");
        $stmt->bindValue(":company_id", $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchAll();
        }
        return false;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
