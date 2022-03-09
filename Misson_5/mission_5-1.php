<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>mission_5-1(じゅん)</title>
</head>

<body>

    <h2>動作確認のご協力よろしくお願いいたします！</h2>
    <h3>パスワードを入れて投稿・編集・削除の順番でやっていただきたいです。</h3>
    <p>※パスワードを入れないで投稿はできないです。また、パスワードを入れないで編集・削除しても何も起こりません。</p>
    <p>※編集する場合、編集したい行の番号とパスワードを入力して送信すると、勝手に名前とコメントが投稿フォームに表示されて編集モードになります。
    あとはコメントを変えて投稿してください。</p>
    <p>※削除する場合も同様で、削除したい行の番号とパスワードを入力して送信してください。</p>

    <?php
    echo "<hr>実行開始<hr>";

    //データベース接続
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //DBに接続できたか確認
    echo "データベース接続完了<hr>";

    //テーブル作成

    //もしtbtest_000がなければ、そのテーブルを作成する。
    $sql = "CREATE TABLE IF NOT EXISTS tbtest_000"
        . " ("

        //カラム①id：INTは整数にするカラム、AUTO_INCREMENTは整数型でカラムに数字が代入されなかった場合1ずつ増やすというカラム、PRIMARY KEYは重複とNULLが許されなくなるカラム
        . "id INT AUTO_INCREMENT PRIMARY KEY,"

        //カラム②name：char(32)で設定
        . "name char(32),"

        //カラム③comment:TEXTで設定
        . "comment TEXT,"

        //カラム④date:DATETIME型で設定
        . "date DATETIME,"

        //カラム⑤pass:char(32)で設定
        . "pass char(32)"
        . ");";

    //query()の()の中身をDBに一回送信
    $stmt = $pdo->query($sql);

    //テーブル作成できたか確認
    echo "テーブル作成済み<hr>";

    //投稿フォームに入力があった場合
    if (!empty($_POST["name"]) && !empty($_POST["str"]) && !empty($_POST["key1"])) {

        //編集用番号が入力されていた場合
        if (!empty($_POST["num3"])) {
            //変数に編集したい内容を代入
            $id = $_POST["num3"]; //変更する投稿番号
            $name = $_POST["name"];
            $comment = $_POST["str"];
            $pass = $_POST["key1"]; //変更したい名前、変更したいコメント、変更したいパスワードは自分で決めること

            //UPDATE　テーブル名　SET　編集したい内容　WHERE　場所の指定　でできる
            $sql = 'UPDATE tbtest_000 SET name=:name,comment=:comment, date=cast(now() as datetime),pass=:pass WHERE id=:id';

            //変数があるため、詳細版
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->execute();

            echo $id . '番編集済み<hr>';

            //通常の投稿モード
        } else {
            //変数があるため詳細版
            //cast(now() as datetime)は現在の日付と時刻を取得する関数
            $sql = $pdo->prepare("INSERT INTO tbtest_000 (name, comment, date, pass) VALUES (:name, :comment, cast(now() as datetime), :pass)");
            $sql->bindParam(':name', $name, PDO::PARAM_STR);
            $sql->bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql->bindParam(':pass', $pass, PDO::PARAM_STR);

            //入力フォームに入力した文字列を代入
            $name = $_POST["name"];
            $comment = $_POST["str"];
            $pass = $_POST["key1"];

            //送信
            $sql->execute();

            echo '投稿完了<hr>';
        }
        //削除フォームに入力があった場合
    } elseif (!empty($_POST["number"]) && !empty($_POST["key2"])) {
        //既に入力されてあるレコードを抽出して削除

        //削除したい番号を変数に代入
        $id = $_POST["number"];

        $del_pass = $_POST["key2"];

        //SELECTで抽出、* FROMでDBにあるテーブルを選択する
        $sql = 'SELECT * FROM tbtest_000';

        //（）の中身をDBに対して実行
        $stmt = $pdo->query($sql);

        //抽出したデータを配列で変数に代入。
        $results = $stmt->fetchAll();

        //foreachでループして配列を取り出す
        foreach ($results as $row) {
            if ($row['pass'] == $del_pass){
                //DELETE　FROM　テーブル名　WHERE　場所を指定
                $sql = 'DELETE FROM tbtest_000 WHERE id=:id';

                //変数があるため詳細版
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
        

        echo $id . '番削除済み<hr>';

    } else {
        //編集フォームに入力があった場合
        if (!empty($_POST["num2"]) && !empty($_POST["key3"])) {
            //レコードを抽出して入力フォームに入力する

            //抽出する場所を変数に代入しておく
            $num2 = $_POST["num2"];
            $ed_pass = $_POST["key3"];
            $id = $num2;

            //SELECTで抽出、* FROMでDBにあるテーブルを選択する
            $sql = 'SELECT * FROM tbtest_000 WHERE id=:id';

            //変数があるため詳細版クエリ
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            //抽出したデータを配列で変数に代入。
            $results = $stmt->fetchAll();

            //foreachでループして配列を取り出す
            foreach ($results as $row){
                if ($row['pass'] == $ed_pass) {
                    //$rowの中にはテーブルのカラム名が入る
                    //新しい変数に代入
                    $new_name = $row['name'];
                    $new_str = $row['comment'];
                    $new_key = $row['pass'];
                }
            }
            echo $id . '番編集モード<hr>';
        }
    }
    ?>

    <form action="" method="post">
        <input type="text" name="name" placeholder="名前" value="<?php if (isset($new_name)) {
            echo $new_name;
        } ?>">
        <input type="text" name="str" placeholder="コメント" value="<?php if (isset($new_str)) {
                echo $new_str;
            } ?>">
        <input type="hidden" name="num3" placeholder="編集用番号" value="<?php if (isset($num2)) {
                        echo $num2;
                        } ?>">
        <input type = "text" name = "key1" placeholder = "パスワード" value="<?php if (isset($new_key)) {
                        echo $new_key;
                        } ?>">
        <input type="submit" name="submit">
    </form>
    <form action="" method="post">
        <input type="number" name="number" placeholder="数字を入力してください">
        <input type = "text" name = "key2" placeholder = "パスワード">
        <input type="submit" name="delete" value="削除">
    </form>
    <form action="" method="post">
        <input type="number" name="num2" placeholder="数字を入力してください">
        <input type = "text" name = "key3" placeholder = "パスワード">
        <input type="submit" name="edit" value="編集">
    </form>

    <?php
    //レコードを抽出して表示する
    echo '<hr>表示開始<hr>';
    //SELECTで抽出、* FROMでDBにあるテーブルを選択する
    $sql = 'SELECT * FROM tbtest_000';

    //（）の中身をDBに対して実行
    $stmt = $pdo->query($sql);

    //抽出したデータを配列で変数に代入。
    $results = $stmt->fetchAll();

    //foreachでループして配列を取り出す
    foreach ($results as $row) {
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'] . ',';
        echo $row['name'] . ',';
        echo $row['comment'] . ',';
        echo $row['date'] . '<br>';
    }
    echo '<hr>表示終了<hr>';
    echo "実行終了<hr>";
    ?>

</body>

</html>