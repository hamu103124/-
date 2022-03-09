<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>mission_3-4(じゅん)</title>
</head>
<body>
    
    <?php
            //変数の初期化
            $filename = "mission_3-4.txt";
            if (file_exists($filename)) {
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                $last_line = explode("<>", $lines[count($lines)-1]);
                $num = $last_line[0] + 1;
            } else {
                $num = 1;
            }
            $date = date("Y/m/d H:i:s");
            
            //投稿フォームに入力があった場合
            if (!empty($_POST["name"]) && !empty($_POST["str"])) {
                $name = $_POST["name"];
                $str = $_POST["str"];
                $result = $num . "<>" . $name . "<>" . $str . "<>" . $date;
                
                //編集モード
                if (!empty($_POST["num3"])) {
                    $num3 = $_POST["num3"];
                    $new_result = $num3 . "<>" . $name . "<>" . $str . "<>" . $date;
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    $fp = fopen($filename, "r+");
                    ftruncate($fp,0);
                    fclose($fp);
                    echo "「編集を受け付けました」<br>";
                    for($i = 0 ; $i < count($lines) ; $i++){
                        $items = explode("<>", $lines[$i]);
                        $fp = fopen($filename, "a");
                        if ($items[0] == $num3) {
                            fwrite($fp, $new_result.PHP_EOL);
                        } else {
                            fwrite($fp, $lines[$i].PHP_EOL);
                        }
                        fclose($fp);
                    }
                    
                //投稿モード
                } else {
                    $fp = fopen($filename, "a");
                    fwrite($fp, $result.PHP_EOL);
                    fclose($fp);
                    echo "「投稿を受け付けました」<br>";
                }
            
        //削除フォームに入力があった場合
        } elseif(!empty($_POST["number"])) {
                $number = $_POST["number"];
                echo "「削除されました」<br>";
                if (file_exists($filename)) {
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    $fp = fopen($filename, "r+");
                    ftruncate($fp,0);
                    fclose($fp);
                    for($i = 0 ; $i < count($lines) ; $i++){
                        $items = explode("<>", $lines[$i]);
                        if ($items[0] != $number) {
                            $fp = fopen($filename, "a");
                            fwrite($fp, $lines[$i].PHP_EOL);
                            fclose($fp);
                        }
                    }
                }
            
            //編集フォームに入力が合った場合 
            } else {
                if (!empty($_POST["num2"])) {
                    $num2 = $_POST["num2"];
                    echo "編集番号を受信しました<br>";
                    if(file_exists($filename)) {
                        $lines = file($filename, FILE_IGNORE_NEW_LINES);
                        for($i = 0 ; $i < count($lines) ; $i++){
                            $items = explode("<>", $lines[$i]);
                            if ($items[0] == $num2) {
                                $new_name = $items[1];
                                $new_str = $items[2];
                            }
                        }
                    }
                }
            }
    ?>
    
    <form action = "" method = "post">
        <input type = "text" name = "name" placeholder = "名前" value = "<?php if(isset($new_name)){echo $new_name ;} ?>"><br>
        <input type = "text" name = "str" placeholder = "コメント" value = "<?php if(isset($new_str)){echo $new_str ;}; ?>">
        <input type = "hidden" name = "num3" placeholder = "編集用番号" value = "<?php if(isset($num2)){echo $num2 ;} ?>">
        <input type = "submit" name = "submit"><br><br>
    </form>
    <form action = "" method = "post">
        <input type = "number" name = "number" placeholder = "数字を入力してください">
        <input type = "submit" name = "delete" value = "削除"><br><br>
    </form>
    <form action = "" method = "post">
        <input type = "number" name = "num2" placeholder = "数字を入力してください">
        <input type = "submit" name = "edit" value = "編集"><br><br>
    </form>
    
    <?php
        //テキストファイルの中身を書き出す
        if (file_exists($filename)) {
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            for($i = 0 ; $i < count($lines) ; $i++){
                $items = explode("<>", $lines[$i]);
                foreach($items as $item){
                    echo $item . " ";
                }
                echo "<br>";
            }
        }
    ?>
    
</body>
</html>