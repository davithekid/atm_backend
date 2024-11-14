<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>BancoFlacko</title>
</head>

<body>
    <main>

        <section>
            <h2>Escolha um serviço</h2>
            <button><a href="./saque.php">Saque</a></button>
            <button><a href="./deposito.php">Depósito</a></button>
            <button><a href="./emprestimo.php">Empréstimo</a></button>
            <button><a href="./extrato.php">Consultar saldo | Extrato</a></button>
        </section>
    </main>



</body>

</html>