<?php
session_start();

if (isset($_SESSION['saldo'])){
    echo "Valor disponivel para saque: " . $_SESSION['saldo'];
}
else{
    echo "Valor disponivel para saque: R$0,00";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="saque.php" method="post">
   Quanto deseja sacar? <input type="text" name="saque">
    <input type="submit" value="sacar">
    </form>
    <?php
    $qtd100 = 0; $qtd50 = 0; $qtd20 = 0; $qtd10 = 0; $qtd5 = 0; $qtd2 =0;
    $resto;


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $saque = $_POST['saque'];
        if($saque > $_SESSION['saldo']){
            echo "impossivel efetuar o saque desejado";
        }else {
          
            $valor = $saque;
            echo "Saque de R$" .  $valor . ",00 efetuado com sucesso!! <br>";
            $_SESSION['saldo'] -= $saque;
            
            if($saque >= 100){
                $qtd100 = $saque / 100; // atribuindo a quantidade de cédulas
                $cedulas = ( int )   $qtd100; // transformando em um tipo inteiro
                $saque = $saque % 100; // armazenando o resto
                $_SESSION['saldo'] =- $saque; // saldo - saque
                echo "Você irá receber $cedulas cédula(s) de R$100,00 <br>";     
            }

            if($saque >= 50){
                $qtd50 = $saque / 50;
                $cedulas = ( int ) $qtd50;
                $saque = $saque %50;
                $_SESSION['saldo'] =- $saque;
                echo "Você irá receber $cedulas cédula(s) de R$50,00 <br>";         
            }
            if($saque >= 20){
                $qtd20 = $saque / 20;
                $cedulas = ( int ) $qtd20;
                $saque = $saque % 20;
                $_SESSION['saldo'] =- $saque;
                echo "Você irá receber $cedulas cédula(s) de R$20,00 <br>";         
            }
            if($saque >= 10){
                $qtd10 = $saque / 10;
                $cedulas = ( int ) $qtd10;
                $saque = $saque % 10;
                $_SESSION['saldo'] =- $saque;
                echo "Você irá receber $cedulas cédula(s) de R$10,00 <br>";         
            }
            if($saque >= 5){
                $qtd5 = $saque / 5;
                $cedulas = ( int ) $qtd5;
                $saque = $saque % 5;
                $_SESSION['saldo'] =- $saque;
                echo "Você irá receber $cedulas cédula(s) de R$5,00 <br>";         
            }
            if($saque >= 2){
                $qtd2 = $saque / 2;
                $cedulas = ( int ) $qtd2;
                $saque = $saque % 2;
                $resto = $saque % 2;
                $_SESSION['saldo'] =- $saque;
                echo "Você irá receber $cedulas cédula(s) de R$2,00 <br>";  
            
            }
            
        } 

    }

    ?>
    <button>
        <a href="./index.php">voltar</a>
    </button>
</body>
</html>