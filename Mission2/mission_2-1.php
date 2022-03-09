<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-1</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    <?php
            if (isset($_POST["str"])) {//ポストに文字列が入っているか確認する
            $str = $_POST["str"];//入っていたら変数に、その文字列を代入
            echo "「" . $str . "を受け付けました」";//その変数を出力
            }
    ?>
</body>
</html>