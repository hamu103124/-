<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>mission_3-1(じゅん)</title>
</head>
<body>
    <form action = "" method = "post">
        <input type = "text" name = "name" placeholder = "名前">
        <input type = "text" name = "str" placeholder = "コメント">
        <input type = "submit" name = "submit">
    </form>
    
    <?php
            $filename = "mission_3-1.txt";//ファイルの名前を定義する
            if (file_exists($filename)) {//ファイルがあるか確認する
                $lines = file($filename, FILE_IGNORE_NEW_LINES);//ファイル内にある文字列を行ごとに配列変数に代入
                $last_line = explode("<>", $lines[count($lines)-1]);//最後の行を＜＞ごとに分けて配列変数に代入
                $num = $last_line[0] + 1;//最初の配列に数字が入っているので、それに＋1して変数に代入
            } else {//ファイルがない場合
                $num = 1;//変数を1と定義する
            }
            $date = date("Y/m/d H:i:s");//現在の日時を定義
            
            
            if (!empty($_POST["name"]) && !empty($_POST["str"])) {//ポストに文字列が入っているか確認する
                $name = $_POST["name"];//nameに入った文字列を変数に代入
                $str = $_POST["str"];//strに入った文字列を変数に代入
                $result = $num . "<>" . $name . "<>" . $str . "<>" . $date;//ファイルに書き込む変数を定義
                $fp = fopen($filename, "a");//モードでファイルを開く
                fwrite($fp, $result.PHP_EOL);//ファイルに書き込む
                fclose($fp);//ファイルを閉じる
                echo "「投稿を受け付けました」<br>";//「投稿を受け付けました」を出力する
            }
    ?>
</body>
</html>