<?php
    for ( $num = 0 ; $num <= 99 ; $num++ ) {
        if ( $num % 3 == 0 && $num % 5 == 0 ) {
            echo "FizzBuzz<br>";
        } elseif ( $num % 3 == 0 ) {
            echo "Fizz<br>";
        } elseif ( $num % 5 == 0 ) {
            echo "Buzz<br>";
        } else {
            echo $num . "<br>";
        }
    }
?>