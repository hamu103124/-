<?php
    echo "実行開始<br>"; 
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //テーブル作成

    //もしtbtest_000がなければ、そのテーブルを作成する。その下にカラムを登録できる（複数登録できる？）、””の中に関数を入れることができる？
    $sql = "CREATE TABLE IF NOT EXISTS tbtest_000"
    ." ("

    //カラム①id：INTは整数にするカラム、AUTO_INCREMENTは整数型でカラムに数字が代入されなかった場合1ずつ増やすというカラム、PRIMARY KEYは重複とNULLが許されなくなるカラム
    . "id INT AUTO_INCREMENT PRIMARY KEY,"

    //カラム②name：char(32)は固定長文字列で32文字格納される。残った文字数はスペースで埋められる。SELECTでデータを取得する場合、空白はデータとして取得されない。ちなみに可変長文字列はvarchar()。
    . "name char(32),"

    //カラム③comment:文字列データを扱うデータ型。可変で最大長が65535文字まで格納できる。ちなみに画像データを格納する場合はBLOB型。
    . "comment TEXT"
    .");";

    //query()の()の中身をDBに一回送信（矢印は逆と考えたほうがいい？）、送信というよりは一回DBに対して（）の中身を作用させるって感じ？
    $stmt = $pdo->query($sql);
    
    echo "実行終了";
