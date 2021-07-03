<?php
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs.php');
$pdo = db_conn();

//1.  DB接続します
// try {
//     //Password:MAMP='root',XAMPP=''
//     $pdo = new PDO('mysql:dbname=02_task; charset=utf8; host=localhost','root','root');
//   } catch (PDOException $e) {
//     exit('DBConnectError:'.$e->getMessage());
//   }

//2.対象のIDを取得
$id = $_GET["id"];

// echo $id;

//3．データ取得SQLを作成（SELECT文）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt ->bindvalue(':id',$id,PDO::PARAM_INT);
//実行
$status = $stmt->execute();

//4．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}


?>

<!-- 以下はindex.phpのHTMLをまるっと持ってくる -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
            <legend>書籍ブックマーク</legend>
            <label>書籍名：<input type="text" name="name" value="<?=$result['name']?>"></label><br>
            <label>書籍URL：<input type="text" name="url" value="<?=$result['url']?>"></label><br>
            <label>コメント：<textArea name="comments" rows="2" cols="60"></textArea></label><br>
            <br>
                <label><textarea name="content" rows="4" cols="40"><?=$result['content']?></textarea></label><br>
                <input type="hidden" name="id" value="<?=$result['id']?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>
