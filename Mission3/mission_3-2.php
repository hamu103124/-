<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>mission_3-2(じゅん)</title>
</head>
<body>
    <form action = "" method = "post">
        <input type = "text" name = "name" placeholder = "名前">
        <input type = "text" name = "str" placeholder = "コメント">
        <input type = "submit" name = "submit">
    </form>
    
    <?php
            $filename = "mission_3-2.txt";
            if (file_exists($filename)) {
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                $last_line = explode("<>", $lines[count($lines)-1]);
                $num = $last_line[0] + 1;
            } else {
                $num = 1;
            }
            $date = date("Y/m/d H:i:s");
            
            if (!empty($_POST["name"]) && !empty($_POST["str"])) {
                $name = $_POST["name"];
                $str = $_POST["str"];
                $result = $num . "<>" . $name . "<>" . $str . "<>" . $date;
                $fp = fopen($filename, "a");
                fwrite($fp, $result.PHP_EOL);
                fclose($fp);
                echo "「投稿を受け付けました」<br>";//ここまでmission_3-1と同じ
                
                if (file_exists($filename)) {//ファイルが存在するか確認
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);//最後の行の空白を除いた配列を変数に代入
                    for($i = 0 ; $i < count($lines) ; $i++){//一個上で作った配列の数だけforでループさせる
                        $items = explode("<>", $lines[$i]);//それぞれの文字列を＜＞ごとに分ける
                        foreach($items as $item){//分けた文字列を一つずつ出力するためにforeachでループさせる
                            echo $item . " ";//出力
                        }
                        echo "<br>";//ループとループの間に改行を出力
                    }
                }
            }
    ?>
</body>
</html>