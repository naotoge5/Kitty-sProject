<?php
 try {
     include('../../assets/functions.php');
     $pdo = getPDO();//pdo取得
     //変数に格納
     $mail = $_POST['mail'];
     //insert文の発行
     $stmt = $pdo->prepare("INSERT INTO pre_mails VALUES(null,:mail)");
     $stmt->execute(array(":mail" => $mail));
     $_SESSION['id'] = $pdo->lastInsertId();
 } catch (PDOException $e) {
     die($e->getMessage());
 }

if(empty($_POST)) {
	header("Location: login.php");
	exit();
}else{
	//POSTされたデータを変数に入れる
    $mail = isset($_POST['mail']) ? $_POST['mail'] : null;
    
    //メール入力判定
		/*
		ここで本登録用のcompaniesテーブルにすでに登録されているmailかどうかをチェックする。
		$errors['member_check'] = "このメールアドレスはすでに利用されております。";
        */
        
}
	
	$urltoken = hash('sha256',uniqid(rand(),1));
	$url = "http://localhost/Kitty-sProject/company/authentication/signup.php"."?urltoken=".$urltoken;
	
	//ここでデータベースに登録する
	try{
		//例外処理を投げる（スロー）ようにする
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$statement = $dbh->prepare("INSERT INTO pre_member (urltoken,mail,date) VALUES (:urltoken,:mail,now() )");
		
		//プレースホルダへ実際の値を設定する
		$statement->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
		$statement->bindValue(':mail', $mail, PDO::PARAM_STR);
		$statement->execute();
			
		//データベース接続切断
		$dbh = null;	
		
	}catch (PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}
	
	//メールの宛先
	$mailTo = $mail;
 
	//Return-Pathに指定するメールアドレス
	$returnMail = 'web@sample.com';
 
	$name = "落とし物検索サービス";
	$mail = 'Kitty-sProject@sample.com';
	$subject = "【落とし物検索サービス】会員登録用URLのお知らせ";
 
$body = <<< EOM
24時間以内に下記のURLからご登録下さい。
{$url}
EOM;
 
	mb_language('ja');
	mb_internal_encoding('UTF-8');
 
	//Fromヘッダーを作成
	$header = 'From: ' . mb_encode_mimeheader($name). ' <' . $mail. '>';
 
	if (mb_send_mail($mailTo, $subject, $body, $header, '-f'. $returnMail)) {
	
	 	//セッション変数を全て解除
		$_SESSION = array();
	
		//クッキーの削除
		if (isset($_COOKIE["PHPSESSID"])) {
			setcookie("PHPSESSID", '', time() - 1800, '/');
		}
	
 		//セッションを破棄する
 		session_destroy();
 	
 		$message = "メールをお送りしました。24時間以内にメールに記載されたURLからご登録下さい。";
 	
	 } else {
		$errors['mail_error'] = "メールの送信に失敗しました。";
	}	

 
?>

<!DOCTYPE html>
<html>
<head>
<title>メール確認画面</title>
<meta charset="utf-8">
</head>
<body>
<h1>メール確認画面</h1>

<?php if (count($errors) === 0): ?>

<p><?=$message?></p>

<p>↓このURLが記載されたメールが届きます。</p>
<a href="<?=$url?>"><?=$url?></a>

<?php elseif(count($errors) > 0): ?>

<?php
foreach($errors as $value){
	echo "<p>".$value."</p>";
}
?>

<input type="button" value="戻る" onClick="history.back()">

<?php endif; ?>
 
</body>
</html>