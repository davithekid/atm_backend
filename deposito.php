<?php
session_start();

if (isset($_SESSION['saldo'])) {
    echo '<h1>Saldo atual da sua conta: R$ ' . number_format($_SESSION['saldo'], 2, ',', '.') . '</h1>';
} else {
    echo "<h2> Saldo da conta: R$0,00 </h2>";
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
    <title>Deposito - BancoFlacko</title>
    <script src="funcoes.js"></script>
</head>

<body>
    <form action="deposito.php" method="post">

        Valor minímo de depósito: R$10,00. <br>
        O valor máximo permitido para depósitos é de R$ 5.000,00 por dia. <br>

        <input type="text" id="saque" name="enviar"> <br> <br>

        <!-- botões -->

        <!-- usando função para add números (onclick=" ") -->
        <button type="button" onclick="adicionarNumero('1')">1</button>
        <button type="button" onclick="adicionarNumero('2')">2</button>
        <button type="button" onclick="adicionarNumero('3')">3</button><br>

        <button type="button" onclick="adicionarNumero('4')">4</button>
        <button type="button" onclick="adicionarNumero('5')">5</button>
        <button type="button" onclick="adicionarNumero('6')">6</button><br>

        <button type="button" onclick="adicionarNumero('7')">7</button>
        <button type="button" onclick="adicionarNumero('8')">8</button>
        <button type="button" onclick="adicionarNumero('9')">9</button><br>

        <button type="submit">Enviar</button>
        <button type="button" onclick="adicionarNumero('0')">0</button>
        <button type="button" onclick="limparCampo()">Limpar</button><br>

    </form>

    <?php

    // validação de número inteiro
    $valorDeposito = filter_input(INPUT_POST, 'enviar', FILTER_VALIDATE_INT); // tipo, var, filtro
    if ($valorDeposito === false) {
        $valorDeposito = 0;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") // vericando as informações do formulario
    {
        if (isset($_SESSION['saldo']) && $_SESSION['saldo'] >= 5000) {
            echo "Limite máximo de depósito atingido.";
        } else {





            if ($valorDeposito < 10 || $valorDeposito > 5000) {
                echo 'Valor invalido para depósitar!!'; //verificando se o valor para saque é suficiente
            } else {


                if (!isset($_SESSION['saldo'])) { // se saldo não estiver definido entao ele vai executar o bloco abaixo
                    $_SESSION['saldo'] = 0;      // saldo por padrão vai receber 0 
                }

                $_SESSION['saldo'] += $valorDeposito; // incrementando o valor de depósito para o saldo 
    



                echo "Depósito de R$" . number_format($valorDeposito, 2, ',', '.') . " realizado com sucesso!<br>";  // imprimindo valor de depositos, após todas as verificações
            }
        }


    }
    ?>

    <footer>

        <button onclick="voltarPagina()">Voltar</button>
        <!-- função para voltar à página  anterior -->
        <script>
            function voltarPagina() {
                window.history.back();
            }
        </script>
        <button><a href="./index.php">Menu Principal</a></button>

    </footer>

</body>

</html>