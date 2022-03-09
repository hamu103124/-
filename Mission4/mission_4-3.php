 <?php
    echo "実行開始<br>"; 
    echo "<hr>";
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //DBにあるテーブル名を確認

    //変数に関数を代入
    $sql ='SHOW TABLES';

    //DBに対して（）の中身を作用させたものを変数に代入
    $result = $pdo -> query($sql);

    //foreachで配列をそれぞれ分解してループ
    foreach ($result as $row){

        //rowの中身が見たい！
        var_dump($row);
        echo '<br>';

        //rowの0番目を出力
        echo $row[0];
        echo '<br>';
    }
    echo "<hr>";
    
    echo "実行終了";
    ?>