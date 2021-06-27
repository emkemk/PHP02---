<?php
//1. POSTデータ取得
$name = $_POST['name'];
$url = $_POST['url'];
$comments = $_POST['comments'];

//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=02_task;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO gs_bm_table( id, name, url , comments, indate )
  VALUES( NULL, :name, :url, :comments, sysdate() )"
);
// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comments', $comments, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

//5 実行
$status = $stmt->execute();

//6 data登録処理数
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErroMassage:".$error[2]);
}else{

//7．index.phpへリダイレクト
  header('Location: index.php');//ヘッダーロケーション（リダイレクト）
 
} 
?>
