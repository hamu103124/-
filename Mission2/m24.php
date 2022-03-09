<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>m24</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str" placeholder="コメント">
        <input type="submit" name="submit">
    </form>
    
    <?php
        //ポストに文字列が入っているか確認する
            //入っていたら変数に、その文字列を代入
            //その変数に文字列が入っているか確認
                //ファイルの名前を定義する
                //fopen関数でファイルを開く（モードの設定に気をつける）
                //ファイルに書き込む
                //ファイルを閉じる
                //６行前で文字列を代入した変数を出力する
                
                //ファイルが存在するか確認
                    //最後の行の空白を除いた配列を変数に代入
                    //foreach関数を使ってループさせる
                        //配列それぞれ出力する
    ?>
</body>
</html>