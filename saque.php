<?php
// sessions
session_start();



echo " Notas disponíveis: R$10,00, R$20,00, R$50,00, R$100. <br>";

echo "<br> Limite Diário: R$2000,00. <br>";

if (isset($_SESSION['saldo'])) {
    echo "<br>Saldo da conta: R$" . $_SESSION['saldo'] . ",00  <br><br>";

     // botão refresh 
     echo '<button onclick="window.location.reload()" style="padding: 5px 10px; font-size: 14px; display: flex; align-items: center; justify-content: center; border: 1px solid #ccc; background-color: #f0f0f0; border-radius: 5px; cursor: pointer;">
            
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" style="margin-left: 5px;">
         <path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160 352 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l111.5 0c0 0 0 0 0 0l.4 0c17.7 0 32-14.3 32-32l0-112c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1L16 432c0 17.7 14.3 32 32 32s32-14.3 32-32l0-35.1 17.6 17.5c0 0 0 0 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.8c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352l34.4 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L48.4 288c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/>
     </svg> 
   </button>';

} else {
    echo "Saldo da conta: R$0,00 <br><br>";

     // botão refresh 
     echo '<button onclick="window.location.reload()" style="padding: 5px 10px; font-size: 14px; display: flex; align-items: center; justify-content: center; border: 1px solid #ccc; background-color: #f0f0f0; border-radius: 5px; cursor: pointer;">
            
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="16" height="16" style="margin-left: 5px;">
         <path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160 352 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l111.5 0c0 0 0 0 0 0l.4 0c17.7 0 32-14.3 32-32l0-112c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 35.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1L16 432c0 17.7 14.3 32 32 32s32-14.3 32-32l0-35.1 17.6 17.5c0 0 0 0 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.8c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352l34.4 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L48.4 288c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/>
     </svg> 
   </button>';

}

if (!isset($_SESSION['limite'])) {
    $_SESSION['limite'] = 0; // limite inicial
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


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
    
    
    $saque = filter_input(INPUT_POST,'enviar', FILTER_VALIDATE_INT);
    if($saque === false){
        $saque = 0;
    }
    

    // verificação saldo
    if (!isset($_SESSION['saldo']) || $_SESSION['saldo'] <= 0) {
        echo "<p style= 'color: red;'> Sem saldo disponível para saque.</p>";
    }
    elseif ($saque < 10) {
        echo "<p style= 'color: red; '>   Valor de saque inválido. </p>";
    } elseif ($saque > $_SESSION['saldo']) {
        echo "<p style= 'color: red; '>    Valor superior ao saldo disponível. </p>";


        // verificação limite
    } elseif ($_SESSION['limite'] + $saque > 2000) {
        echo "<p style='color: #F07D25;' >   Limite máximo de R$2000,00 atingido! <br> </p>";
    } else {

        //verificação para sacar valores múltiplos
        if ($saque % 10 != 0) {
            $saldoArredondado = floor($saque / 10) * 10;  // arredonda para o múltiplo de 10 mais próximo (para o menor)
            $saque = $saldoArredondado;
        }

        // processa cálculo saque

        $_SESSION['saldo'] -= $saque; // saldo - saque
        echo "<p style ='color: lime; '>    Saque de R$$saque efetuado com sucesso!! <br>  </p>"; // imprimindo valor do saque
        echo "<br>Saldo Atual: R$" . $_SESSION['saldo'] . ',00<br>'; // imprimindo saldo atual
        $_SESSION['limite'] += $saque; // acumulando o limite
        echo "<br>Limite total após saque: R$" . $_SESSION['limite'] . ",00<br><br>"; // imprimindo mensagem do limite

        $_SESSION['saque'] = $saque;
    }

    



    // processo de notas

    //100
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


    // if ($tot100 == true && $saque >9 ) {
    //     echo " Quantidade de cédulas de R$100,00: $tot100 <br>";
    // }
    // if ($tot50 == true && $saque > 9) {
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