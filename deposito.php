<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposito - BancoFlacko</title>
</head>

<body>
    <form action="deposito.php" method="post">

        Valor de Depósito: <input type="text" name="deposito" placeholder="R$">
        <input type="submit" value="Depositar">
        <br>
        O valor máximo permitido para depósitos é de R$ 5.000,00.
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") // vericando as informações do formulario
    {
        $valorDeposito = $_POST['deposito'];
        if ($valorDeposito < 1 || $valorDeposito > 5000) {
            echo 'Valor invalido para depósitar!!'; //verificando se o valor para saque é suficiente
        } else {


            if (!isset($_SESSION['saldo'])) { // se saldo não estiver definido entao ele vai executar o bloco abaixo
                $_SESSION['saldo'] = 0;      // saldo por padrão vai receber 0 
            }

            $_SESSION['saldo'] += $valorDeposito; // incrementando o valor de depósito para o saldo 
    

            echo "Depósito de R$$valorDeposito,00 concluido com sucessso!! ";  // imprimindo valor de depositos, após todas as verificações
        }

    }
    ?>
    <button>
        <a href="./index.php">voltar</a>
    </button>

</body>

</html>