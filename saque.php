<?php
// sessions
session_start();

if (isset($_SESSION['saldo'])) {
    echo "Saldo da conta: R$" . $_SESSION['saldo'] . ",00";
} else {
    echo "Saldo da conta: R$0,00";
}

if (!isset($_SESSION['limite'])) {
    $_SESSION['limite'] = 0; // limite inicial
}

// Atribuindo valores aos botões
if (isset($_POST['dez'])) {
    $saque = 10;
} elseif (isset($_POST['vinte'])) {
    $saque = 20;
} elseif (isset($_POST['cinquenta'])) {
    $saque = 50;
} elseif (isset($_POST['cem'])) {
    $saque = 100;
} else {
    // essa linha de código basicamente atribui à variável $saque:
    $saque = isset($_POST['saque']) ? (int) $_POST['saque'] : 0;
    // caso não estiver nada atribuido, será armazenado o valor 0

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saque - BancoFlacko</title>
</head>

<body>
    <form action="saque.php" method="post">
        Escolha a quantidade que você deseja sacar dessa conta. <input type="text" name="saque">
        <input type="submit" value="sacar">
        <button type="submit" value="enviar" name="dez">10</button>
        <button type="submit" value="enviar" name="vinte">20</button>
        <button type="submit" value="enviar" name="cinquenta">50</button>
        <button type="submit" value="enviar" name="cem">100</button>

        <br><br>
        Notas disponíveis: R$10,00, R$20,00, R$50,00, R$100.<br>
        Limite Diário: R$2000,00.
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // verificações

            // verificação saldo
        if (!isset($_SESSION['saldo']) || $_SESSION['saldo'] <= 0) {
            echo "Sem saldo disponível para saque.";
        } elseif ($saque <= 0) {
            echo "Valor de saque inválido.";
        } elseif ($saque > $_SESSION['saldo']) {
            echo "Valor superior ao saldo disponível.";


            // verificação limite
        } elseif ($_SESSION['limite'] + $saque > 2000) {
            echo "Limite máximo de R$2000,00 atingido! <br>";
        } else {

            // verificação para sacar valores múltiplos
            if ($saque % 10 != 0) {
                $saldoArredondado = floor($saque / 10) * 10;  // arredonda para o múltiplo de 10 mais próximo (para o menor)
                $saque = $saldoArredondado;
            }
            
            // processo de saque

            // sistema de notas
            $qtd = $saque / $saque;
            echo "você vai receber o total de $qtd cédula de $saque <br>";
            ////////////////////////////////

            // processa cálculo saque
            $_SESSION['saldo'] -= $saque; // saldo - saque
            echo "Saque de R$$saque efetuado com sucesso!! <br>"; // imprimindo valor do saque
            echo "Saldo Atual: R$" . $_SESSION['saldo'] . ',00<br>'; // imprimindo saldo atual
            $_SESSION['limite'] += $saque; // acumulando o limite
            echo "Limite total após saque: R$" . $_SESSION['limite'] . ",00<br>"; // imprimindo mensagem do limite
            
            
        }
    }

    ?>
    <br>
    <button>
        <a href="./index.php">voltar</a>
    </button>
</body>

</html>
