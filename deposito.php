<?php
session_start();



if (isset($_SESSION['saldo'])) {
    echo '<h1>Saldo atual da sua conta: R$ ' . number_format($_SESSION['saldo'], 2, ',', '.') . '</h1>';
    
    // botão refresh 
    echo '<button onclick="window.location.reload()" style="padding: 5px 10px; font-size: 14px; display: flex; align-items: center; justify-content: center; border: 1px solid #ccc; background-color: #f0f0f0; border-radius: 5px; cursor: pointer;">
    
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" style="margin-left: 5px;">
    <path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160 352 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l111.5 0c0 0 0 0 0 0l.4 0c17.7 0 32-14.3 32-32l0-112c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1L16 432c0 17.7 14.3 32 32 32s32-14.3 32-32l0-35.1 17.6 17.5c0 0 0 0 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.8c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352l34.4 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L48.4 288c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/>
    </svg> 
    </button>';
    
    
    
} else {
    echo "<h2> Saldo da conta: R$0,00 </h2>";
    
    // botão refresh 
    echo '<button onclick="window.location.reload()" style="padding: 5px 10px; font-size: 14px; display: flex; align-items: center; justify-content: center; border: 1px solid #ccc; background-color: #f0f0f0; border-radius: 5px; cursor: pointer;">
    
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" style="margin-left: 5px;">
    <path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160 352 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l111.5 0c0 0 0 0 0 0l.4 0c17.7 0 32-14.3 32-32l0-112c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1L16 432c0 17.7 14.3 32 32 32s32-14.3 32-32l0-35.1 17.6 17.5c0 0 0 0 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.8c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352l34.4 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L48.4 288c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/>
    </svg> 
    </button>';
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
            
            //verificação para sacar valores múltiplos
            // if ($valorDeposito % 10 != 0) {
                //     $saldoArredondado = floor($valorDeposito / 10) * 10;  // arredonda para o múltiplo de 10 mais próximo (para o menor)
                //     $valorDeposito = $saldoArredondado;
                // }
                
                $_SESSION['saldo'] += $valorDeposito; // incrementando o valor de depósito para o saldo 
                $_SESSION['deposito'] = $valorDeposito;
                
                echo "<p style='color: lime;'>  Depósito de R$" . number_format($valorDeposito, 2, ',', '.') . " realizado com sucesso!<br></p>";  // imprimindo valor de depositos, após todas as verificações
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