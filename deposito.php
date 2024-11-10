<?php
session_start();

if (isset($_SESSION['saldo'])) {
    echo "<h2> Saldo da conta: R$" . $_SESSION['saldo'] . ",00 </h2>";
} else {
    echo "<h2> Saldo da conta: R$0,00 </h2>";
} 

if (!isset($_SESSION['limite'])) {
    $_SESSION['limite'] = 0; // limite inicial
}


if(isset($_POST['um'])){
    $valorDeposito = 1;
}elseif(isset($_POST['dois'])){
    $valorDeposito = 2;
}elseif(isset($_POST['tres'])){
    $valorDeposito = 3;
}elseif(isset($_POST['quatro'])){
    $valorDeposito = 4;
}elseif(isset($_POST['cinco'])){
    $$valorDeposito = 5;
}elseif(isset($_POST['seis'])){
$valorDeposito = 6;
}elseif(isset($_POST['sete'])){
    $valorDeposito = 7;
}elseif(isset($_POST['oito'])){
$valorDeposito = 8;
}elseif(isset($_POST['nove'])){
    $valorDeposito = 9;
}elseif(isset($_POST['zero'])){
    $valorDeposito = 0;
}else {
    // essa linha de código basicamente atribui à variável $$valorDeposito:
    $valorDeposito = isset($_POST['enviar']) ? (int) $_POST['enviar'] : 0;
    // caso não estiver nada atribuido, será armazenado o valor 0

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
        <button type="button" onclick="adicionarNumero('1')" name="um">1</button> 
        <button type="button" onclick="adicionarNumero('2')" name="dois">2</button>
        <button type="button" onclick="adicionarNumero('3')" name="tres">3</button><br>

        <button type="button" onclick="adicionarNumero('4')" name="quatro">4</button>
        <button type="button" onclick="adicionarNumero('5')" name="cinco">5</button>
        <button type="button" onclick="adicionarNumero('6')" name="seis">6</button><br>

        <button type="button" onclick="adicionarNumero('7')" name="sete">7</button>
        <button type="button" onclick="adicionarNumero('8')" name="oito">8</button>
        <button type="button" onclick="adicionarNumero('9')" name="nove">9</button><br>

        <button type="submit">Enviar</button>
        <button type="button" onclick="adicionarNumero('0')" name="zero">0</button>
        <button type="button" onclick="limparCampo()">Limpar</button><br>

    </form>






    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") // vericando as informações do formulario
    {
        if (isset($_SESSION['saldo']) && $_SESSION['saldo'] >= 5000)  {
            echo "Limite máximo de depósito atingido.";
        }else{

        
        $valorDeposito = $_POST['enviar'];
        if ($valorDeposito < 1 || $valorDeposito > 5000) {
            echo 'Valor invalido para depósitar!!'; //verificando se o valor para saque é suficiente
        } else {


            if (!isset($_SESSION['saldo'])) { // se saldo não estiver definido entao ele vai executar o bloco abaixo
                $_SESSION['saldo'] = 0;      // saldo por padrão vai receber 0 
            }

            $_SESSION['saldo'] += $valorDeposito; // incrementando o valor de depósito para o saldo 

    

            echo "Depósito de R$$valorDeposito,00 concluido com sucessso!! ";  // imprimindo valor de depositos, após todas as verificações
        }
    }
    }
    ?>

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