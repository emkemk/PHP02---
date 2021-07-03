<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
// $id   = $_POST["id"];
$name  = $_POST["name"];
$url    = $_POST["url"];
$comments = $_POST["comments"];
$id = $POST["id"];

//2. DB接続します
require_once('funcs.php');
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db_02task; charset=utf8; host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//３．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
$stmt = $pdo->prepare(
    "UPDATE gs_bm_table SET name=:name, url=:url, comments=:comments, indate=sysdate() WHERE id=:id"
  );
  
  // 4. バインド変数を用意
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':comments', $comments, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':id',$id,PDO::PARM_INT);

  // 5. 実行
  $status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    //以下を関数化
    sql_error($stmt);
}else{
    //５．index.phpへリダイレクト
    //以下を関数化
    redirect('Location: index.php');
  }

?>