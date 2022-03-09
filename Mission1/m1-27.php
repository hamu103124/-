<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-27</title>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="num" placeholder="数字を入力してください">
        <input type="submit" name="submit">
    </form>
    <?php
        if($_POST["num"] != NULL) {    
            $num = $_POST["num"];
            $filename = "mission_1-27.txt";
            $fp = fopen($filename, "a");
            /*ここに「書き込む文字列を変数に代入する」が
            入るってヒントではなっているけど、わからん*/
            fwrite($fp, $num.PHP_EOL);
            fclose($fp);
            echo "書き込み成功！<br>";
        }
            
            if(file_exists($filename)) {
                $numbers = file($filename, FILE_IGNORE_NEW_LINES);
                foreach($numbers as $number){
                    if ( $number % 3 == 0 && $number % 5 == 0 ) {
                        echo "FizzBuzz<br>";
                    } elseif ( $number % 3 == 0 ) {
                        echo "Fizz<br>";
                    } elseif ( $number % 5 == 0 ) {
                        echo "Buzz<br>";
                    } else {
                        echo $number . "<br>";
                    }
                }
            }
    ?>
</body>
</html>