<?php
session_start();

function dataHora()
{
    $dataAtual = new DateTime();
    $timezone = new DateTimeZone('America/Sao_Paulo');

    $dataAtual->setTimezone($timezone);
    echo $dataAtual->format('d/F /Y à\s h:i');
}

if (isset($_SESSION['saldo'])) {
    echo 'Saldo atual da sua conta: R$ ' . number_format($_SESSION['saldo'], 2, ',', '.');


} else {
    echo "Saldo da conta: R$0,00 ";

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

        <br> Valor minímo de depósito: R$10,00. <br>
        O valor máximo permitido para depósitos é de R$ 5.000,00 por dia. <br>

        <input type="text" id="saque" name="enviar"> <br> <br>

        <!-- teclado numérico  -->
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") // vericando as informações do formulario
    {
        // validação de número inteiro
        $valorDeposito = filter_input(INPUT_POST, 'enviar', FILTER_VALIDATE_INT); // tipo, var, filtro
        if ($valorDeposito === false) {
            $valorDeposito = 0;
        }

        // definindo limite
        if (isset($_SESSION['saldo']) && ($_SESSION['saldo'] + $valorDeposito) > 5000) {
            echo "<p style= 'color: red; '> Limite máximo de depósito atingido. </p>";
        } else {

            // verificações
    
            if ($valorDeposito < 10 || $valorDeposito > 5000) {
                echo "<p style='color: red;'>Valor invalido para depósitar!! </p>"; //verificando se o valor para saque é suficiente
            } else {

                if (!isset($_SESSION['saldo'])) { // se saldo não estiver definido entao ele vai executar o bloco abaixo
                    $_SESSION['saldo'] = 0;      // saldo por padrão vai receber 0 
                }

                $_SESSION['saldo'] += $valorDeposito; // incrementando o valor de depósito para o saldo 
    
                // criando arquivo txt para armazenar dados de operação
                $arquivo = "meu_arquivo.txt";

                $handle = fopen($arquivo, "a");
                fwrite($handle, "Depósito ");
                fwrite($handle, "-" . number_format($valorDeposito, 2, ',', '.') . "\n");
                fclose($handle);

                echo "<p style='color: lime;'>  Depósito de R$" . number_format($valorDeposito, 2, ',', '.') . " realizado com sucesso!<br></p>";  // imprimindo valor de depositos, após todas as verificações
            }


        }


    }
    ?>

    <footer>
        <button><a href="./index.php">Inicio</a></button>

        <?php
        echo dataHora();
        ?>
    </footer>

</body>

</html>