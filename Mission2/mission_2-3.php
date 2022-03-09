<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-3</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
        if ($_POST != NULL) {
            $str = $_POST["str"];
            if (strlen($str)) {
                $filename = "mission_2-3.txt";
                $fp = fopen($filename, "a");
                fwrite($fp, $str.PHP_EOL);
                fclose($fp);
                echo "「" . $str . "を受け付けました」";
            }
        }
    ?>
</body>
</html>