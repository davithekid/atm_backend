<?php
// sessions
session_start();

echo " Notas disponíveis: R$10,00, R$20,00, R$50,00, R$100. <br>";

echo "<br> Limite Diário: R$2000,00. <br>";

if (isset($_SESSION['saldo'])) {
    echo "<br>Saldo da conta: R$" . $_SESSION['saldo'] . ",00  <br><br>";
} else {
    echo "Saldo da conta: R$0,00 <br><br>";
}

if (!isset($_SESSION['limite'])) {
    $_SESSION['limite'] = 0; // limite inicial
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $saque = 0;

    $saque = filter_input(INPUT_POST,'enviar', FILTER_VALIDATE_INT);
    if($saque === false){
        $saque = 0;
    }

    if (isset($_POST['um'])) {
        $saque = 1;
    } elseif (isset($_POST['dois'])) {
        $saque = 2;
    } elseif (isset($_POST['tres'])) {
        $saque = 3;
    } elseif (isset($_POST['quatro'])) {
        $saque = 4;
    } elseif (isset($_POST['cinco'])) {
        $saque = 5;
    } elseif (isset($_POST['seis'])) {
        $saque = 6;
    } elseif (isset($_POST['sete'])) {
        $saque = 7;
    } elseif (isset($_POST['oito'])) {
        $saque = 8;
    } elseif (isset($_POST['nove'])) {
        $saque = 9;
    } elseif (isset($_POST['zero'])) {
        $saque = 0;
    } else {
        // essa linha de código basicamente atribui à variável $saque:
        $saque = isset($_POST['enviar']) ?  $_POST['enviar'] : 0;
        // caso não estiver nada atribuido, será armazenado o valor 0

    }



       


    // verificação saldo
    if (!isset($_SESSION['saldo']) || $_SESSION['saldo'] <= 0) {
        echo "Sem saldo disponível para saque.";
    }
    elseif ($saque < 10) {
        echo "Valor de saque inválido.";
    } elseif ($saque > $_SESSION['saldo']) {
        echo "Valor superior ao saldo disponível.";


        // verificação limite
    } elseif ($_SESSION['limite'] + $saque > 2000) {
        echo "Limite máximo de R$2000,00 atingido! <br>";
    } else {

        // verificação para sacar valores múltiplos
        // if ($saque % 10 != 0) {
        //     $saldoArredondado = ($saque / 10) * 10;  // arredonda para o múltiplo de 10 mais próximo (para o menor)
        //     $saque = $saldoArredondado;
        // }

        // processa cálculo saque

        $_SESSION['saldo'] -= $saque; // saldo - saque
        echo "Saque de R$$saque efetuado com sucesso!! <br>"; // imprimindo valor do saque
        echo "<br>Saldo Atual: R$" . $_SESSION['saldo'] . ',00<br>'; // imprimindo saldo atual
        $_SESSION['limite'] += $saque; // acumulando o limite
        echo "<br>Limite total após saque: R$" . $_SESSION['limite'] . ",00<br><br>"; // imprimindo mensagem do limite
    }

    // processo de notas

    // // 100
    // $resto = $saque;
    // $tot100 = floor($resto / 100);
    // $resto %= 100;

    // //50
    // $tot50 = floor($resto / 50);
    // $resto %= 50;

    // //20
    // $tot20 = floor($resto / 20);
    // $resto %= 20;

    // //10
    // $tot10 = floor($resto / 10);
    // $resto %= 10;


    // if ($tot100 == true) {
    //     echo " Quantidade de cédulas de R$100,00: $tot100 <br>";
    // }
    // if ($tot50 == true) {
    //     echo "Quantidade de cédulas de R$50,00: $tot50  <br>";
    // }
    // if ($tot20 == true) {
    //     echo "Quantidade de cédulas de R$20,00: $tot20 <br>";
    // }
    // if ($tot10 == true) {
    //     echo "Quantidade de cédulas de R$10,00: $tot10 <br>";
    // }


}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="funcoes.js"></script>
    <title>Saque - BancoFlacko</title>
</head>

<body>

    <form action="saque.php" method="post">
        <!-- input submit -->
        <!-- Escolha a quantidade que você deseja sacar dessa conta. <input type="submtt" name="saque" id="saque" readonly>enviar <br> <br><br> -->
        <input type="text" id="saque" name="enviar"> <br> <br>
        </section>
        </main>

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

    <br>

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