<?php                       //ログインしてなくても見れるページ。index.phpの【未登録ユーザー用1】に対応
include("funcs.php");
$pdo = db_conn();           //接続用メソッドを呼び出し


//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();


//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{

  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){


// ４.フラグの文字化
$k_flg = "";
$kanli_flg = $result['kanli_flg'];

if($kanli_flg == 1){
    $k_flg = ':管理者';
  } else {
    $k_flg = ':一般';
  }

$l_flg = "";
$life_flg = $result['life_flg'];

if($life_flg == 1){
    $l_flg = ':退職';
  } else {
    $l_flg = ':在籍';
  }

    $view .= '<tr>';
    $view .= '<td>'. $result['id'] .'</td>';
    $view .= '<td>'. $result['name'] .'</td>';
    $view .= '<td>'. $result['lid'] .'</td>';
    $view .= '<td>'. $result['lpw'] .'</td>';
    $view .= '<td>'. $result['kanli_flg']. $k_flg. '</td>';
    $view .= '<td>'. $result['life_flg']. $l_flg.'</td>';
    $view .= '</tr>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="js/jquery-2.1.3.min.js"></script>
<title>ユーザー一覧</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
  <h2>登録ユーザー</h2>
</header>

<div class="body">
<div style="height:460px; overflow:auto; border:none solid;">
    <table border="1">
        <tr style="background-color:gainsboro">
            <th>ID</th>
            <th>ユーザー名</th>
            <th>ユーザーID</th>
            <th>パスワード</th>
            <th>一般=0/管理者=1</th>
            <th>在籍=0/退職=1</th>
            <th>更新</th>
            <th>削除</th>
        </tr>

      <div>
      <div class="container jumbotron"><?= $view ?></div>
      </div>
    </table>
    <br>
    <a href="index.php" class="back_text">新規ユーザー登録画面へ</a>

  </div>
</div>

</body>
</html>