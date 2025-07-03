<?php

$n = 7;

for ($i=0;$i<$n;$i++){
    for($j=0;$j<$n;$j++){
        if($j == $i||$i+$j==$n-1){
            echo "X ";
        }else{
            echo "O ";
        }
        
    }
    echo "\n";
}

?>