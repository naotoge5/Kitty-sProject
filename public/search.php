<?php
include '../assets/functions.php';

$name = $_GET['name'];
$prefecture = isset($_GET['prefectures']) ? $_GET['prefectures'] : null;
$city = $_GET['cities'];
$town = $_GET['towns'];
$category = $_GET['categories'];
$query = "";
$value = [];
$keywords = [$name];

if (is_null($prefecture)) {
    alert('不正なアクセスです', 'CAUTION');
} else {
    if ($prefecture !== '都道府県を選択してください') {
        $query .= " and prefecture=:prefecture and city=:city and town  like :town";
        $value = array_merge(array(":prefecture" => $prefecture,
            ":city" => $city,
            ":town" => $town . "%",
        ));
        array_push($keywords, $prefecture . $city . $town);
    }
    if ($category !== "カテゴリーを選択してください") {
        $query .= "  and category=:category";
        $value = array_merge($value, array("category" => $category));
        array_push($keywords, $category);
    }
    $_SESSION['data']['keywords'] = $keywords;
    $_SESSION['data']['results'] = searchCompanies($query, $value);
}
header("Location:result.php");

/**
 * @param string $plus_query
 * @param array $plus_value
 * @return array|int
 */
function searchCompanies(string $plus_query, array $plus_value)
{
    global $name;
    $query = "select distinct companies.id, companies.name, companies.details from objects join companies on objects.company_id = companies.id where (companies.name like :name or objects.name like :name)" . $plus_query . " order by objects.datetime desc";
    $value = array_merge(array(":name" => "%" . $name . "%"), $plus_value);
    print_r($value);
    try {
        $pdo = getPDO();//pdo取得         
        $stmt = $pdo->prepare($query);
        $stmt->execute($value);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        alert('データーベース接続エラー', 'ERROR');
    } finally {
        unset($pdo);
    }
    return 0;
}
