<?php
session_start();

if (isset($_SESSION['saldo'])) {
    echo "Saldo da conta: R$" . $_SESSION['saldo'] . ",00";
} else {
    echo "Saldo da conta: R$0,00";
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
    </form>
    <?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $saque = $_POST['saque'];


        if ($saque > $_SESSION['saldo']) {
            echo "Valor maior que saldo";
        } else {


            switch ($saque) {
                case 5:
                    $saque = 5;
                    $_SESSION['saldo'] -= $saque;
                    echo $_SESSION['saldo'];
                    break;
                case 10:
                    $saque = 10;
                    $_SESSION['saldo'] -= $saque;
                    echo $_SESSION['saldo'];
                    break;
                case 20:
                    $saque = 20;
                    $_SESSION['saldo'] -= $saque;
                    echo $_SESSION['saldo'];
                    break;
                case 50;
                    $saque = 50;
                    $_SESSION['saldo'] -= $saque;
                    echo $_SESSION['saldo'];
                    break;
                case 100;
                    $saque = 100;
                    $_SESSION['saldo'] -= $saque;
                    echo "Saque de R$$saque,00 efetuado com sucesso!! <br>";
                    echo "Saldo Atual: R$" . $_SESSION['saldo'] . ",00";
                    break;
                case $saque:
                    break;

            }
        }

    }



    ?>
    <br>
    <button>
        <a href="./index.php">voltar</a>
    </button>
</body>

</html>