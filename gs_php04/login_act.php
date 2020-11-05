<?php

//最初にSESSIONを開始！！ココ大事！！
session_start();  //SESSIONを使用する際に必要なメソッド

//POST値
$lid = $_POST ['lid'];
$lpw = $_POST ['lpw'];

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//2. データSQL作成 gs_user_tableテーブルからlidとlpwの情報を検索
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid = :lid AND lpw = :lpw"); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP。問題ないならスルーしていく
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
//if(password_verify($lpw, $val["lpw"])){ //* PasswordがHash化の場合はこっちのIFを使う
if( $val["id"] != "" ){ //空でなければ（情報が取得できれば）…
    //Login成功時
    $_SESSION["chk_ssid"]  = session_id();       //セッションidを発行
    $_SESSION["kanli_flg"] = $val['kanli_flg'];  //kanli_flg情報をsessionに格納
    $_SESSION["name"]      = $val['name'];       //name情報をsessionに格納
    header('Location: list.php');
}else{
    //Login失敗時(Logout経由)
    header('Location: login.php');
}

exit();
