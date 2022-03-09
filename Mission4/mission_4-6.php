 <?php
    echo "実行開始<br>"; 
    echo "<hr>";
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //レコードを抽出して表示する
    
    //SELECTで抽出、* FROMでDBにあるテーブルを選択する
    $sql = 'SELECT * FROM tbtest';

    //（）の中身をDBに対して実行
    $stmt = $pdo->query($sql);

    //fetchAll()は結果データを全件まとめて配列で取得できる。
    //抽出したデータを配列で変数に代入。
    $results = $stmt->fetchAll();
    var_dump($results);
    echo '<br>';

    //foreachでループして配列を取り出す
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    }

    //カラム名を使わなくても一応できる
    foreach ($results as $row){
        for ( $i = 0 ; $i < 3 ; $i++ ) {
            echo $row[$i] . ' ';
        }
        echo '<br>';
    }
    echo "<hr>";
    echo "実行終了";
    ?>