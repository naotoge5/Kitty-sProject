<?php
// HPMailer のクラスをグローバル名前空間（global namespace）にインポート
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
// PHPMailer のソースファイルの読み込み
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

//mbstring の日本語設定
mb_language("japanese");
mb_internal_encoding("UTF-8");

// インスタンスを生成（引数に true を指定して例外 Exception を有効に）
$mail = new PHPMailer(true);

//日本語用設定
$mail->CharSet = "iso-2022-jp";
$mail->Encoding = "7bit";


include('../../assets/functions.php');
$pdo = getPDO();//pdo取得

if(empty($_POST)) {
	header("Location: login.php");
	exit();
}else{
	//POSTされたデータを変数に入れる
    $tomail = isset($_POST['mail']) ? $_POST['mail'] : null;
    
		/*
		ここで本登録用のcompaniesテーブルにすでに登録されているmailかどうかをチェックする。
		$errors['member_check'] = "このメールアドレスはすでに利用されております。";
		loginに飛ばす
        */ 
}

$urltoken = hash('sha256',uniqid(rand(),1));
$url = "http://localhost/Kitty-sProject/company/authentication/signup.php"."?urltoken=".$urltoken;

//ここでデータベースに登録する

try {
	//変数に格納
	//例外処理を投げる（スロー）ようにする
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "INSERT INTO pre_companies(urltoken,mail,date) VALUES (:urltoken,:mail,now() )";
	$stmt=$pdo->prepare($sql);
	
	//プレースホルダへ実際の値を設定する
	$stmt->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
	$stmt->bindValue(':mail', $tomail, PDO::PARAM_STR);
	$stmt->execute();
		
	//データベース接続切断
	$pdo = null;	
	
}catch (PDOException $e){
	print('Error:'.$e->getMessage());
	die();
}


try {
	//ここら辺に問題があるはず
	//サーバの設定
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;  // デバグの出力を有効に（テスト環境での検証用）
	$mail->isSMTP();   // SMTP を使用
	$mail->Host       = 'smtp.kcg.ac.jp';  // ★★★ Gmail SMTP サーバーを指定
	$mail->SMTPAuth   = true;   // SMTP authentication を有効に
	$mail->Username   = 'st031959@m03.kyoto-kcg.ac.jp';  // ★★★ Gmail ユーザ名
	$mail->Password   = '6Q6dY6R3';  // ★★★ Gmail パスワード
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ★★★ 暗号化（TLS)を有効に 
	$mail->Port = 587;  //★★★ ポートは 587 

	//受信者設定
	//差出人アドレス, 差出人名 
	$mail->setFrom('st031959@m03.kyoto-kcg.ac.jp', mb_encode_mimeheader('kitty-s project')); 
	// 受信者アドレス, 受信者名（受信者名はオプション）
	$mail->addAddress($tomail); 

	 //コンテンツ設定
	 $mail->isHTML(true);   // HTML形式を指定
	 //メール表題（タイトル）
	 $mail->Subject = mb_encode_mimeheader('【落とし物検索サービス】会員登録用URLのお知らせ'); 
	 //本文（HTML用）
	 //$mail->Body  = mb_convert_encoding('HTML メッセージ <b>BOLD</b>',"JIS","UTF-8");  
	 //テキスト表示の本文
	 $mail->AltBody = mb_convert_encoding("24時間以内に下記のURLからご登録下さい。{$url} ","JIS","UTF-8"); 
		
	 $mail->send();  //送信
	//送信判定
	echo "送信が成功したよ！";
}catch (Exception $e) {
		echo "送信が失敗したよ、、";
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

<p>↓このURLが記載されたメールが届きます。</p>
<a href="<?=$url?>"><?=$url?></a>

<input type="button" value="戻る" onClick="history.back()">
 
</body>
</html>
