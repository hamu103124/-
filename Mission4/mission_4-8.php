 <?php
    echo "実行開始<br>"; 
    echo "<hr>";
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //既に入力されてあるレコードを抽出して削除
    
    //削除する投稿番号
    $id = 2;

    //DELETE　FROM　テーブル名　WHERE　場所を指定
    $sql = 'DELETE FROM tbtest WHERE id=:id';

    //変数があるため詳細版
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    //レコードを抽出して表示する
    $sql = 'SELECT * FROM tbtest';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    }
    echo "<hr>";
    
    echo "実行終了";
    ?>