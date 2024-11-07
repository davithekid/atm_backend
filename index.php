<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BancoFlacko</title>
</head>

<body>
    <header>
        <?php


        if (isset($_SESSION["saldo"])) { // verificando se saldo ja foi definida ou é um valor null
            echo '<h1>Saldo da conta: R$' . $_SESSION["saldo"] . ",00</h1>"; // imprimir o novo valor de saldo (incrementação do depósito)        
        } else {
            echo "<h1>Saldo da conta: R$ 0,00<h1>"; // saldo por padrão (antes de depósitar)
        }
        ?>
    </header>
    <main>
        <h2>Escolha um serviço</h2>

        <button>
            <a href="./saque.php">Saque</a>
        </button>
        <button>
            <a href="./deposito.php">Depósito</a>
        </button>
        <button>
            <a href="./extrato">Historico</a>
        </button>
    </main>

    <br>

</body>

</html>