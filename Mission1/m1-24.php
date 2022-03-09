<?php
    $str = "Hello World"; //変数strにHello Worldを代入する
    $filename ="mission_1-24.txt"; //変数filenameにファイル名を代入
    $fp = fopen($filename,"a"); //変数fpに関数fopenを代入
    /*fopenの()の中身は(ファイル名, モード)になる
    
    上記の場合、「mission_1-24.txt」というファイルを
    aモード（追記モード）で作成して開くよって意味
    
    モードは「w」,「a」,「r」がある。
    wはwritableで上書き保存に近い
    aはappendで実行するごとに文字が追加されていく
    rはreadableで出力ではなく読み込み用
    例えば
    「あるファイルの中身をrで読み込んで、
    それとは別のファイルにaかwで出力する」
    ということができる*/
    
    fwrite($fp, $str.PHP_EOL); //関数fwriteを実行
    /* fwrite(ファイル, 書き込む文字)となる
    指定したファイルに文字を出力する関数
    
    PHP_EOLは改行コード。今までは"<br>"を使ってた
    改行コードはOSによって違うが（\r\n, \r, \n）、
    PHP_EOLを使えばどのOSでも定数として使えるため便利*/
    
    fclose($fp); //関数fcloseを実行
    /*fclose(ファイル)となる
    指定したファイルを閉じる関数*/
    
    echo "書き込み成功！";
?>