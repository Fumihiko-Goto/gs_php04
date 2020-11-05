<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規ユーザー登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="list.php">ユーザー管理画面</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="list2.php">ログイン認証なし一覧表示</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="detail2.php">ログイン認証なし詳細画面</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->
<!-- Main[Start] -->
<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>新規ユーザー登録</legend>
     <label>名前：<input type="text" name="name" required></label><br>
     <label>ID：<input type="text" name="lid" required></label><br>
     <label>Password：<input type="password" name="lpw" pattern="(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{6,}" title="半角英大文字・半角英小文字・半角数字いれずれも必ず含む6文字以上" required /></label><br>
     <input type="hidden" name="kanli_flg" value="0" required>  <!-- hiddenは「チェックされなかった場合、valueを0としてpostさせる」-->
     <label>管理者：<input type="checkbox" name="kanli_flg" value="1"></label><br>     <!-- チェックされた場合、valueは1としてpostされる-->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->
</body>
</html>