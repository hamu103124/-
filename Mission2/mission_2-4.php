<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-4(じゅん)</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    
    <u><h3>「2-4クリアおめでとう！by （メンバー名）」って祝ってほしいな〜</h3></u>
    
    <?php
        if ($_POST != NULL) {
            $str = $_POST["str"];
            if (strlen($str)) {
                $filename = "mission_2-4.txt";
                $fp = fopen($filename, "a");
                fwrite($fp, $str.PHP_EOL);
                fclose($fp);
                echo "「”" . $str . "”を受け付けました」<br>";
        
                if(file_exists($filename)) {
                    $items = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach($items as $item){
                        echo $item;
                        echo " ←ありがとう！これからも一緒に頑張ろう！<br><br>";
                    }
                }
            }
        }
    ?>
</body>
</html>