 <?php
    echo "実行開始<br>"; 
    echo "<hr>";
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //テーブル自体の削除
    
    //DROP　TABLE　テーブル名でテーブルを削除できる
    $sql = 'DROP TABLE tbtest_000';

    //変数がないため簡易版クエリ
    $stmt = $pdo->query($sql);
    
    echo "実行終了";
    ?>