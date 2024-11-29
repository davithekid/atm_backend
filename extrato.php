<?php
$arquivo = "meu_arquivo.txt";
$handle = fopen($arquivo, "r");


while(($line = fgets($handle)) !== false){
    list($deposito) =   explode('|' , $line);
    echo $deposito;

}

fclose($handle);

?>