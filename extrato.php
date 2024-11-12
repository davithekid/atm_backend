<?php
session_start();

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
    if (isset($_SESSION["saldo"])) { // verificando se saldo ja foi definida ou é um valor null
        echo '<h1>Saldo atual da sua conta: R$ ' . number_format($_SESSION['saldo'], 2, ',', '.') . '</h1>';
        // imprimir o novo valor de saldo (incrementação do depósito)        
    } else {
        echo "<h1>Saldo atual da sua conta: R$ 0,00<h1>"; // saldo por padrão (antes de depósitar)
    }
    ?>
</header>

<button><a href="./saque.php">Saque</a></button>
<button><a href="./deposito.php">Depósito</a></button>

<footer>

        <button onclick="voltarPagina()">Voltar</button>
        <!-- função para voltar à página  anterior -->
        <script>
            function voltarPagina(){
                window.history.back();
            }
            </script>
    <button><a href="./index.php">Menu Principal</a></button>
</footer>



</body>
</html>