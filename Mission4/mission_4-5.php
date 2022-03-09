 <?php
   echo "実行開始<br>";
   echo "<hr>";
   $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
   $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

   //レコード登録

   //query、prepare、executeの3つはPDOでDBを操作する際に使うメソッド(https://blog.senseshare.jp/query-prepare.html)
   //querryは簡易版(変動する値がない場合)、prepareとexecuteは詳細版（変動する値がある場合）であわせて使う。今回は詳細版
   //INSERT INTO A BでAにBの値を代入する
   //SQLの文に直接変数を埋め込むのはシステムの脆弱性に繋がるので、:nameや:commentというようにプレースホルダ（ここは変数と置き換える箇所）にする
   $sql = $pdo->prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");

   //詳細版を使うとき、prepare→bindValue or bindParam→executeを行う
   //bindValueとbindParamの違い（https://qiita.com/_dozen_/items/f6239cf1bdab6f8b0026）
   //bindValueは値を直接入れても、変数を入れてもOK
   //bindParamの場合、変数を入れないとエラーが起きる
   //':name'や':comment'はポインタ表示
   //PDO::PARAM_STRは文字列だよってこと。
   $sql->bindParam(':name', $name, PDO::PARAM_STR);
   $sql->bindParam(':comment', $comment, PDO::PARAM_STR);

   //変数に文字列を代入
   $name = 'マイティ・ソー';
   $comment = '「I knew it.」'; //好きな名前、好きな言葉は自分で決めること

   //executeが無いと実行されない。つまり、prepare で用意したSQLをここでデータベースにINSERTしてる。
   $sql->execute();

   echo "実行終了";
   ?>