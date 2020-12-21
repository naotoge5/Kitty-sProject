<?php
include_once("assets/functions.php"); //include_once -> result.php内でfunction読み込みの為

$company_name = isset($_GET['name']) ? $_GET['name'] : 0; // 必須

$category = isset($_GET['categories']) ? $_GET['categories'] : 0; // 必須
if (!empty($_GET['name'])) {
    $companies = readAll('%' . $_GET['name'] . '%', "select id, name, details from companies where name like ? limit 10");
} else if (!empty($_GET['categories'])) {
    if (empty($_GET['towns'])) {
        $companies = readAll([$_GET['prefectures'], $_GET['cities']], "select id, name, details from companies where prefecture = ? and city = ?");
    } else {
        $companies = readAll([$_GET['prefectures'], $_GET['cities'], $_GET['towns'] . '%'], "select id, name, details from companies where prefecture = ? and city = ? and town like ?");
    }
    $param = [$_GET['categories']];
    $query = "select distinct company_id from objects where category = ?";
    if (!empty($_GET['objects'])) {
        $param = array_push($param, $_GET['objects']);
        $query .= " and name = ?";
    }
    if (!empty($_GET['date'])) {
        $param = array_merge($param, [$_GET['date'] . ' 00:00:00', $_GET['date'] . ' 23:59:59']);
        $query .= " and datetime between ? and ?";
    }
    $company_ids = readAll($param, $query);
} else {
    header('Location:index.php');
    exit;
}

/* 検索-関数 */ // 未着手

/*
if ($prefecture) {
    if ($prefecture !== '都道府県を選択してください') {
        $query .= " and prefecture=:prefecture and city=:city and town  like :town";
        $value = array_merge(array(
            ":prefecture" => $prefecture,
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
} else {
    alert('不正なアクセスです', 'CAUTION');
}
header("Location:result.php");

function searchCompanies(string $plus_query, array $plus_value)
{
    global $name;
    $query = "select distinct companies.id, companies.name, companies.details from objects join companies on objects.company_id = companies.id where (companies.name like :name or objects.name like :name)" . $plus_query . " order by objects.datetime desc";
    $value = array_merge(array(":name" => $name), $plus_value);
    print_r($value);
    try {
        $pdo = getPDO(); //pdo取得
        //$pdo->query("set session sql_mode=(select replace(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
        $stmt = $pdo->prepare($query);
        $stmt->execute($value);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        alert($e . 'データーベース接続エラー', 'ERROR');
    } finally {
        unset($pdo);
    }
    return 0;
}
*/

function searchCompanies()
{
    global $company_name;
    $name = '%' . $company_name . '%';
    try {
        $pdo = getPDO(); //pdo取得
        $stmt = $pdo->prepare("select id, name, details from companies where name like :name");
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        alert('データーベース接続エラー', 'ERROR');
    } finally {
        unset($pdo);
    }
    return 0;
}
