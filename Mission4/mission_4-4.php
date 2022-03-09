 <?php
    echo "実行開始<br>"; 
    echo "<hr>";
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //作成されたテーブルの詳細を確認する

    //変数に関数を代入する
    $sql ='SHOW CREATE TABLE tbtest';

    //DBに（）の中身を作用させて変数に代入する
    $result = $pdo -> query($sql);

    //foreachでDB上にある情報を分解ループ
    foreach ($result as $row){

        //rowの中身がみたい！
        var_dump($row);
        echo '<br>';

        //rowの1番目を出力
        echo $row[1];
        echo '<br>';
    }
    echo "<hr>";
    
    echo "実行終了";
    ?>