<?php
//selsect.phpから処理を持ってくる
//1.対象のIDを取得
$id = $_GET["id"];

// //2.DB接続します
// require_once('funcs.php');
// $pdo = db_conn();

// //3.削除SQLを作成
// $stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");
// $stmt ->bindvalue(':id',$id,PDO::PARAM_INT);
// //実行
// $status = $stmt->execute();

// //４．データ削除処理後
// if($status==false){
//     //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
//     //以下を関数化
//     sql_error($stmt);
// }else{
//     //５．index.phpへリダイレクト
//     //以下を関数化
//     redirect('index.php');
//   }
?>
