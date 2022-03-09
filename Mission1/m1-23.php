<?php
    $colleague = array( "Ken", "Alice", "Judy", "BOSS", "Bob" );
    foreach ( $colleague as $items ) {
        if ( $items == "BOSS") {
            echo "Good morning $items!<br>";
        } else {
        echo "Hi! $items<br>";
        }
    } 
?>