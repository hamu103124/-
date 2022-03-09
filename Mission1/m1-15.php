<?php
    $date = date("Y年m月d日 H時i分s秒");
    echo $date;
    echo "<br>";
    $date = date("Y年m月d日 H時i分s秒", strtotime('+1 week'));
    echo $date;
?>