<?php
include '../../assets/functions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer のソースファイルの読み込み
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = $_POST['mail'];
$message = check_mail($mail) ? null : 'このメールアドレスはすでに利用されている可能性があります。';
if (is_null($message)) {
    $token = hash('sha256', uniqid(rand(), 1));
    $url = str_replace('/mail.php', '/signup.php?token=' . $token, (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("insert into pre_companies values(null, :token, :mail, now())");
        $stmt->execute(array(":token" => $token, ":mail" => $mail));
        //データベース接続切断
        $pdo = null;
        $message = send_mail($mail, $url) ? null : 'メールの送信に失敗しました。';
    } catch (PDOException $e) {
        //die($e->getMessage());
        $message = 'メールの送信に失敗しました。' . $e->getMessage();
    }
    if (is_null($message)) $message = 'メールアドレスに新規登録のURLを送信しました';

}

function check_mail($mail)
{
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare('SELECT mail FROM companies WHERE mail = :mail limit 1');
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetch() ? false : true;
        }
        return false;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function send_mail($mail, $url)
{
    //文字エンコードを指定
    mb_language('uni');
    mb_internal_encoding('UTF-8');

    //インスタンスを生成（true指定で例外を有効化）
    $mailer = new PHPMailer(true);

    //文字エンコードを指定
    $mailer->CharSet = 'utf-8';

    try {
        // デバッグ設定
        // $mail->SMTPDebug = 2; // デバッグ出力を有効化（レベルを指定）
        // $mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str<br>";};

        // SMTPサーバの設定
        $mailer->isSMTP();                          // SMTPの使用宣言
        $mailer->Host = 'smtp.kcg.ac.jp';   // SMTPサーバーを指定
        $mailer->SMTPAuth = true;                 // SMTP authenticationを有効化
        $mailer->Username = 'st071959';   // SMTPサーバーのユーザ名
        $mailer->Password = '10ikoanNita05Kcg';           // SMTPサーバーのパスワード
        $mailer->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
        $mailer->Port = 587; // TCPポートを指定（tlsの場合は465や587）

        // 送受信先設定（第二引数は省略可）
        $mailer->setFrom('st071959@m03.kyoto-kcg.ac.jp', '落とし物管理システム'); // 送信者
        $mailer->addAddress($mail);   // 宛先

        // 送信内容設定
        $mailer->Subject = '仮登録が完了しました。';
        $mailer->Body = "登録は完了していません。\n\n【登録ページ】\nURL\n" . $url . "\n\n24時間以内に登録を完了させてください。";

        // 送信
        $mailer->send();
        return true;
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
        return false;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>メール確認画面</title>
    <meta charset="utf-8">
</head>
<body>
<h1><?= $message ?></h1>
<input type="button" value="戻る" onClick="history.back()">
</body>
</html>
