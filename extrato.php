<?php
session_start();

function dataHora()
{
    // data atual
    $dataAtual = new DateTime();
    $timezone = new DateTimeZone('America/Sao_Paulo');

    $dataAtual->setTimezone($timezone);
    echo $dataAtual->format('d/m ');

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extrato - BancoFlacko</title>
</head>

<body>

    <header>
        <?php


        if (isset($_SESSION['saldo'])) {
            echo "Saldo da conta: R$" . $_SESSION['saldo'] . ",00  <br><br>";
        } else {
            echo "Saldo da conta: R$0,00 <br><br>";
        }

        ?>
    </header>

    <main>

        <?php
        $arquivo = "meu_arquivo.txt";
        $handle = fopen($arquivo, "r");

        echo "Data | Histórico | Valor R$ <br>";
        while (($line = fgets($handle)) !== false) {
            list($operacao) = explode('|', $line);
            echo dataHora() . $operacao . "<br>";

        }

        fclose($handle);
        ?>


    </main>

    <footer>
        <br>
        <button><a href="./index.php">Inicio</a></button>
        <?php
        // data atual
        $dataAtual = new DateTime();
        $timezone = new DateTimeZone('America/Sao_Paulo');

        $dataAtual->setTimezone($timezone);
        echo $dataAtual->format('d/F /Y à\s h:i');
        ?>
    </footer>

</body>

</html>