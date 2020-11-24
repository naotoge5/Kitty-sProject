<?php
echo $_GET['name'];
echo $_GET['prefectures'];
$name = empty($_GET['name']) ? '' : "%" . $_GET['name'] . "%";
$prefecture = isset($_GET['prefectures']) ? $_GET['prefectures'] : null;
$city = $_GET['cities'];
$town = $_GET['towns'] . '%';
$category = $_GET['categories'];
$query = "";
$value = [];


if (is_null($prefecture)) {
    $alert = alertType('不正なアクセスです', 'ERROR');
    header("Location:top.php");
    exit;
} else {
    if ($prefecture !== '都道府県を選択してください') {
        $query .= " or prefecture=:prefecture and city=:city and town  like :town";
        $value = array_merge(array(":prefecture" => $prefecture,
            ":city" => $city,
            ":town" => $town
        ));

    }
    if ($category !== "カテゴリーを選択してください") {
        $query .= "  or category=:category";
        $value = array_merge($value, array("category" => $category));

    }
    $_SESSION['results'] = searchName($query, $value);
    header("Location:top.php");
}


function searchName($plus_query = "", $plus_value = [])
{
    global $name;
    $query = "SELECT distinct companies.name  FROM objects JOIN companies ON objects.company_id=companies.id WHERE companies.name LIKE :name OR objects.name LIKE :name" . $plus_query;
    $value = array_merge(array(":name" => $name), $plus_value);
    print_r($value);
    try {
        include('../assets/functions.php');
        $pdo = getPDO();//pdo取得         
        $stmt = $pdo->prepare($query);
        $stmt->execute($value);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return -1;
    } finally {
        unset($pdo);
    }
}

?>
