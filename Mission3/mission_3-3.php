<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <title>mission_3-3</title>
</head>
<body>
    <form action = "" method = "post">
        <input type = "text" name = "name" placeholder = "名前">
        <input type = "text" name = "str" placeholder = "コメント">
        <input type = "submit" name = "submit">
    </form>
    <form action = "" method = "post">
        <input type = "number" name = "number" placeholder = "数字を入力してください">
        <input type = "submit" name = "delete" value = "削除">
    </form>
    
    <?php
            $filename = "mission_3-3.txt";
            if (file_exists($filename)) {
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                $last_line = explode("<>", $lines[count($lines)-1]);
                $num = $last_line[0] + 1;
            } else {
                $num = 1;
            }
            $date = date("Y/m/d H:i:s");
            
            if (isset($_POST["name"]) && isset($_POST["str"])) {
                $name = $_POST["name"];
                $str = $_POST["str"];
                $result = $num . "<>" . $name . "<>" . $str . "<>" . $date;
                $fp = fopen($filename, "a");
                fwrite($fp, $result.PHP_EOL);
                fclose($fp);
                echo "「投稿を受け付けました」<br>";
                
                if (file_exists($filename)) {//49行目から63行目ができたら62行目と63行目の間に38行目から47行目をコピペする
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    for($i = 0 ; $i < count($lines) ; $i++){
                        $items = explode("<>", $lines[$i]);
                        foreach($items as $item){
                            echo $item . " ";
                        }
                        echo "<br>";
                    }
                }//ここまではmission_3-2と同じ
                
            } elseif(isset($_POST["number"])) {//削除フォームに入力があった場合（elseifで条件分岐）
                    $number = $_POST["number"];//削除番号代入
                    echo "「削除されました」<br>";//「削除されました」と出力
                    if (file_exists($filename)) {//ここからは人によって違うから注意。なるちゃんのやり方が簡単そうなので採用。
                        $lines = file($filename, FILE_IGNORE_NEW_LINES);//最後の行の空白を除いた配列を変数に代入
                        $fp=fopen( $filename, "w+");//ファイルを更新（w+）モードで読み込み、書き込みできるかたちで開く
                        for($i = 0 ; $i < count($lines) ; $i++){//1行ずつ次の操作を行う（forをつかってループ）
                            $items = explode("<>", $lines[$i]);//それぞれの行の文字列を＜＞ごとに分ける
                            if($items[0] != $number){//【条件】要素群[0](＝1番目の要素の(投稿番号))が削除番号と同じでないとき
                                fwrite($fp, $lines[$i].PHP_EOL);//元の行のまま書く
                            }
                        }
                        fclose($fp);//ファイルを閉じる
                    }
                    if (file_exists($filename)) {//49行目から63行目ができたら62行目と63行目に38行目から47行目をコピペする
                    $lines = file($filename, FILE_IGNORE_NEW_LINES);
                    for($i = 0 ; $i < count($lines) ; $i++){
                        $items = explode("<>", $lines[$i]);
                        foreach($items as $item){
                            echo $item . " ";
                        }
                        echo "<br>";
                    }
                }
            }
    ?>
</body>
</html>