<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}


//DB接続関数：db_conn()
function db_conn()
{
try {
    $db_name = "gs_db_2";    //データベース名
    $db_id   = "root";      //アカウント名
    $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
    $db_host = "localhost"; //DBホスト
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
    return $pdo;
} catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
}
}


//SQLエラー関数：sql_error($stmt)
function sql_error($stmt)
{
$error = $stmt->errorInfo();
exit("SQLError:".$error[2]);
}


//リダイレクト関数: redirect($file_name)
function redirect($file_name)
{
header("Location:" . $file_name);
exit();
}

// ログインチェク処理
function sessionCheck()
{
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()){ //isset()は中に入っているか調べる関数
        //不正なログイン状況の人
        exit('LOGIN Error');  //ログインさせない関数
    } else { 
        //ログインしても良い人のための処理
        //SESSION ID を新しく発行してあげる
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}