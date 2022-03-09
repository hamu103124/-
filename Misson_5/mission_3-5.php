<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>mission_3-5(じゅん)</title>
</head>
<body>
    <h2>動作確認のご協力よろしくお願いいたします！</h2>
    <h3>パスワードを入れて投稿・編集・削除の順番でやっていただきたいです。</h3>
    <p>※パスワードを入れないで投稿すると編集・削除ができなくなります。また、パスワードを入れないで編集・削除しても何も起こりません。</p>
    <p>※編集する場合、編集したい行の番号とパスワードを入力して送信すると、勝手に名前とコメントが投稿フォームに表示されて編集モードになります。
    あとはコメントを変えてパスワードを入力して投稿してください。</p>
    <p>※削除する場合も同様で、削除したい行の番号とパスワードを入力して送信してください。</p>
    
    
    <?php
            //変数の初期化
            $filename = "mission_3-5.txt";
            if (file_exists($filename)) {
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                $last_line = explode("<>", $lines[count($lines)-1]);
                $num = $last_line[0] + 1;
            } else {
                $num = 1;
            }
            $date = date("Y/m/d H:i:s");
            $new_name = NULL;
            $new_str = NULL;
            $num2 = NULL;
            
            //投稿フォームに入力があった場合
            if (!empty($_POST["name"]) && !empty($_POST["str"])) {
                $name = $_POST["name"];
                $str = $_POST["str"];
                $key1 = $_POST["key1"];
                $result = $num . "<>" . $name . "<>" . $str . "<>" . $date . "<>" . $key1 . "<>";
                
                //編集モード
                if (!empty($_POST["num3"])) {
                    $num3 = $_POST["num3"];
                    $new_result = $num3 . "<>" . $name . "<>" . $str . "<>" . $date . "<>" . $key1 . "<>";
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    $fp = fopen($filename, "r+");
                    ftruncate($fp,0);
                    fclose($fp);
                    echo "「編集を受け付けました」<br>";
                    for($i = 0 ; $i < count($lines) ; $i++){
                        $items = explode("<>", $lines[$i]);
                        if ($items[0] == $num3) {
                            $fp = fopen($filename, "a");
                            fwrite($fp, $new_result.PHP_EOL);
                            fclose($fp);
                        } else {
                            $fp = fopen($filename, "a");
                            fwrite($fp, $lines[$i].PHP_EOL);
                            fclose($fp);
                        }
                    }
                    
                //投稿モード
                } else {
                    $fp = fopen($filename, "a");
                    fwrite($fp, $result.PHP_EOL);
                    fclose($fp);
                    echo "「投稿を受け付けました」<br>";
                }
            
        //削除フォームに入力があった場合
        } elseif(!empty($_POST["number"]) && !empty($_POST["key2"])) {
                $number = $_POST["number"];
                $key2 = $_POST["key2"];
                if (file_exists($filename)) {
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    $fp = fopen($filename, "r+");
                    ftruncate($fp,0);
                    fclose($fp);
                    
                    $delete = explode("<>", $lines[$number-1]);
                    if ($delete[4] == $key2) {
                        echo "「削除されました」<br>";
                        
                        for($i = 0 ; $i < count($lines) ; $i++){
                            $items = explode("<>", $lines[$i]);
                            if ($items[0] != $number) {
                                $fp = fopen($filename, "a");
                                fwrite($fp, $lines[$i].PHP_EOL);
                                fclose($fp);
                            }
                        }
                    } else {
                        echo "パスワードが違います<br>";
                    }
                }
            
            //編集フォームに入力が合った場合 
            } else {
                if (!empty($_POST["num2"]) && !empty($_POST["key3"])) {
                    $num2 = $_POST["num2"];
                    $key3 = $_POST["key3"];
                    if(file_exists($filename)) {
                        $lines = file($filename, FILE_IGNORE_NEW_LINES);
                        
                        $edit = explode("<>", $lines[$num2-1]);
                        if ($edit[4] == $key3) {
                            for($i = 0 ; $i < count($lines) ; $i++){
                                $items = explode("<>", $lines[$i]);
                                if ($items[0] == $num2 && $items[4] == $key3) {
                                    $new_name = $items[1];
                                    $new_str = $items[2];
                                    echo "編集番号を受信しました<br>";
                                }
                            }
                        } else {
                            echo "パスワードが違います<br>";
                        }
                    }
                } 
            }
    ?>
    
    <form action = "" method = "post">
        <input type = "text" name = "name" placeholder = "名前" value = "<?php echo $new_name ; ?>"><br>
        <input type = "text" name = "str" placeholder = "コメント" value = "<?php echo $new_str ; ?>"><br>
        <input type = "hidden" name = "num3" placeholder = "編集用番号" value = "<?php echo $num2 ; ?>">
        <input type = "text" name = "key1" placeholder = "パスワード">
        <input type = "submit" name = "submit"><br><br>
    </form>
    <form action = "" method = "post">
        <input type = "number" name = "number" placeholder = "数字を入力してください"><br>
        <input type = "text" name = "key2" placeholder = "パスワード">
        <input type = "submit" name = "delete" value = "削除"><br><br>
    </form>
    <form action = "" method = "post">
        <input type = "number" name = "num2" placeholder = "数字を入力してください"><br>
        <input type = "text" name = "key3" placeholder = "パスワード">
        <input type = "submit" name = "edit" value = "編集"><br><br>
    </form>
    
    <?php
        //テキストファイルの中身を書き出す
        if (file_exists($filename)) {
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            for($i = 0 ; $i < count($lines) ; $i++){
                $items = explode("<>", $lines[$i]);
                for($j = 0 ; $j < count($items)-2 ; $j++){
                    echo $items[$j] . " ";
                }
                if (strlen($items[count($items)-2])) {
                    echo "パスワードあり";
                } else {
                    echo "パスワードなし";
                }
                echo "<br>";
            }
        }
    ?>
    
</body>
</html>