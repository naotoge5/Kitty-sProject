<?php
echo $_GET['name'];
echo $_GET['prefectures'];

$name=$_GET['name'];
$prefecture=$_GET['prefectures'];
$citie=$_GET['cities'];
$town=$_GET['towns'];
$categorie=$_GET['categories'];
    /*var_dump($name);
    var_dump($prefecture);
    var_dump($citie);
    var_dump($town);
    var_dump($categorie);*/


/*
    if($prefecture!=='都道府県を選択してください'){
        
    }

    if(isset()){
        
    }
*/




$_SESSION['companies']=search_name($name);
header("Location:top.php");

function search_name($name){//落とし物店舗名検索

try {
    include('../assets/functions.php');
    $pdo = getPDO();//pdo取得
    $stmt = $pdo->prepare("SELECT distinct companies.name  FROM objects JOIN companies ON objects.company_id=companies.id WHERE companies.name LIKE :name OR objects.name LIKE :name");
    $stmt->bindValue(":name",'%'.$name.'%', PDO::PARAM_STR);
    if ($stmt->execute()) {
        return $stmt->fetchAll();
    }
    return false;
} catch (PDOException $e) {
    die($e->getMessage());
}
}


function  category(){//カテゴリでの検索
try{
   $pdo = getPDO();//pdo取得
   $sql='SELECT * FROM objects INNER JOIN  companies  on  company_id = id';
   $pdo->query($sql);
}catch(PDOException $e){
        die($e->getMessage());
}
}



function  prefectures(){//町域検索

try{
    $pdo = getPDO();//pdo取得
}catch(PDOException $e){
        die($e->getMessage());
}
}
?>
