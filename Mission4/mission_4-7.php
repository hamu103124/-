 <?php
    echo "実行開始<br>"; 
    echo "<hr>";
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //既に入力されてあるレコードを編集
    
    //変数に編集したい内容を代入
    $id = 1; //変更する投稿番号
    $name = "トニー・スターク";
    $comment = "「I Am Iron Man.」"; //変更したい名前、変更したいコメントは自分で決めること

    //UPDATE　テーブル名　SET　編集したい内容　WHERE　場所の指定　でできる
    $sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';

    //変数があるため、詳細版
    //PDO::PARAM_INTは数字が入るよって感じ
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    //レコードを抽出して表示
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