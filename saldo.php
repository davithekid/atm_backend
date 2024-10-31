<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALDO</title>
</head>

<body>

<?php
if (isset($_SESSION["saldo"])) { // verificando se saldo ja foi definida ou é um valor null
    echo 'Seu saldo atual é: R$' .  $_SESSION["saldo"]; // imprimi o novo valor de saldo (incrementação do depósito)
} else {
    echo "Seu saldo atual é: R$ 0,00"; // saldo por padrão (antes de depósitar)
}
    ?>
    <br>
<button>
    <a href="./index.php">voltar</a>
</button>
</body>

</html>