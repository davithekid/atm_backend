<?php
session_start();

if (isset($_SESSION['saldo'])) {
    echo "Saldo da conta: R$" . $_SESSION['saldo'] . ",00";
} else {
    echo "Saldo da conta: R$0,00";
}

if (!isset($_SESSION['limite'])) {
    $_SESSION['limite'] = 0; // limite inicial
}



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saque</title>
</head>

<body>
    <form action="saque.php" method="post">
        Escolha a quantidade que você deseja sacar dessa conta. <input type="text" name="saque">
        <input type="submit" value="sacar">
        <br>notas disponiveis:
        R$10,00 , R$20,00 , R$50,00, R$100,<br>
        <br> Limite Diario: R$2000,00.
    </form>
    <?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $saque = $_POST['saque'];

        if (!isset($_SERVER['saldo']) <= 0) {
            echo "sem valor para saque";
        } elseif ($saque > $_SESSION['saldo']) {
            echo "Valor maior que saldo";
    
        } else {


            switch ($saque) {
                case 10:
                    // verificação de limite
                    if ($_SESSION['limite'] >= 2000) { // valor de limite

                        echo "Limite máximo de R$2000,00 atingido! <br>";
                        
                    } else {

                        $_SESSION['saldo'] -= 10; 
                        echo "Saque de R$10,00 efetuado com sucesso!! <br>";
                        echo "Saldo Atual: R$" . $_SESSION['saldo'] . ",00<br>";
                        $_SESSION['limite'] += 10; // acumulando o limite
                        echo "Limite total após saque: R$" . $_SESSION['limite'] . ",00<br>"; // mensagem limite

                    }
                    break;
                case 20:
                    if ($_SESSION['limite'] >= 2000) {

                        echo "Limite máximo de R$2000,00 atingido! <br>";

                    } else {
                        $_SESSION['saldo'] -= 20;
                        echo "Saque de R$20,00 efetuado com sucesso!! <br>";
                        echo "Saldo Atual: R$" . $_SESSION['saldo'] . ",00<br>";
                        $_SESSION['limite'] += 20; // acumulando o limite
                        echo "Limite total após saque: R$" . $_SESSION['limite'] . ",00<br>";
                    }
                    break;
                case 50;
                    if ($_SESSION['limite'] >= 2000) {

                        echo "Limite máximo de R$2000,00 atingido! <br>";

                    } else {
                        $_SESSION['saldo'] -= 50;
                        echo "Saque de R$$saque,00 efetuado com sucesso!! <br>";
                        echo "Saldo Atual: R$" . $_SESSION['saldo'] . ",00 <br>";
                        $_SESSION['limite'] += 50; // acumulando o limite
                        echo "Limite total após saque: R$" . $_SESSION['limite'] . ",00<br>";

                    }
                    break;
                case 100;
                    if ($_SESSION["limite"] >= 2000) {

                        echo "Limite máximo de R$2000,00 atingido! <br>";

                    } else {

                        $_SESSION['saldo'] -= 100;
                        echo "Saque de R$$saque,00 efetuado com sucesso!! <br>";
                        echo "Saldo Atual: R$" . $_SESSION['saldo'] . ",00 <br>";
                        $_SESSION['limite'] += 100; // acumulando o limite
                        echo "Limite total após saque: R$" . $_SESSION['limite'] . ",00<br>";
            
                    }
                    break;


            } // fechamento switch
    

        } // fechamento verificação saldo
    
    } // fechamneto request
    ?>
    <br>
    <button>
        <a href="./index.php">voltar</a>
    </button>
</body>

</html>

