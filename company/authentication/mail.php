<?php
//メール設定 接続
include '../../assets/functions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer のソースファイルの読み込み
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['mail'])) {
    switch ($_GET['pattern']) {
        case 'signup':
            $company = read($_POST['mail'], "select mail from companies where mail = ?");
            if ($company) {
                alert('"' . $_POST['mail'] . '"はすでに利用されています', 'CAUTION');
            } else {
                $token = hash('sha256', uniqid(rand(), 1));
                $url = str_replace('/mail.php?pattern=signup', '/signup.php?token=' . $token, (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                if (connect([$token, $_POST['mail']], "insert into pre_companies values(null, ?, ?, now())") and send_mail($url, '登録は完了していません' . "\n【新規登録ページ】")) {
                    header('Location:login.php');
                    exit;
                }
            }
            header('Location:form.php?pattern=signup');
            exit;
        case 'forgot':
            $company = read($_POST['mail'], "select mail from companies where mail = ?");
            if ($company) {
                $token = hash('sha256', uniqid(rand(), 1));
                $url = str_replace('/mail.php?pattern=forgot', '/reset.php?token=' . $token, (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                if (connect([$token, $_POST['mail']], "insert into pre_companies values(null, ?, ?, now())") and send_mail($url, '【パスワード変更ページ】')) {
                    header('Location:login.php');
                    exit;
                }
            } else {
                alert('"' . $_POST['mail'] . '"は利用されていません', 'CAUTION');
            }
            header('Location:form.php?pattern=forgot');
            exit;
    }
} else {
    alert('不正なアクセスです', 'CAUTION');
}
header('Location:login.php');

function write_preCompany()
{
    global $token;
    global $mail;
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("insert into pre_companies values(null, :token, :mail, now())");
        $stmt->execute(array(":token" => $token, ":mail" => $mail));
        return 1;
    } catch (PDOException $e) {
        alert('データベース接続エラー', 'ERROR');
    } finally {
        unset($pdo);
    }
    return 0;
}

function check_mail()
{
    global $mail;
    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare('SELECT mail FROM companies WHERE mail = :mail limit 1');
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->execute();
        if (!$stmt->fetch()) return 1;
        alert('"' . $mail . '"はすでに利用されています', 'CAUTION');
    } catch (PDOException $e) {
        alert('データベース接続エラー', 'ERROR');
    } finally {
        unset($pdo);
    }
    return 0;
}

function send_mail($url, $body)
{
    try {
        $mailer = new PHPMailer(true); //インスタンスを生成（true指定で例外を有効化）
        /*
        なくても動く!?
        //文字エンコードを指定
        //mb_language('uni');
        //mb_internal_encoding('UTF-8');
        */
        $mailer->CharSet = 'utf-8';
        // SMTPサーバの設定
        $mailer->isSMTP();                          // SMTPの使用宣言
        $mailer->Host = 's205.xrea.com';   // SMTPサーバーを指定
        $mailer->SMTPAuth = true;                 // SMTP authenticationを有効化
        $mailer->Username = 'info@naotoge5.cf';   // SMTPサーバーのユーザ名
        $mailer->Password = 'Pv5L46rAdPGV';           // SMTPサーバーのパスワード
        $mailer->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
        $mailer->Port = 587; // TCPポートを指定（tlsの場合は465や587）

        // 送受信先設定（第二引数は省略可）
        $mailer->setFrom('info@naotoge5.cf', '落とし物管理システム'); // 送信者
        $mailer->addAddress($_POST['mail']);   // 宛先

        // 送信内容設定
        $mailer->Subject = 'URLのご案内';
        $mailer->Body = $body . "\n" . $url . "\n\n24時間以内に完了させてください。";

        // 送信
        $mailer->send();
        alert('確認のメールを送信しました', 'SUCCESS');
        return 1;
    } catch (Exception $e) {
        alert('メールの送信に失敗しました', 'CAUTION');
    } finally {
        unset($mailer);
    }
    return 0;
}
