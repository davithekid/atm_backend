<?php
session_start();

if (!isset($_SESSION['limite'])) {
    $_SESSION['limite'] = 0; // limite inicial de saque
}

echo "Notas disponíveis: R$10,00, R$20,00, R$50,00, R$100. <br>";
echo "<br> Limite Diário: R$2000,00. <br>";

if (isset($_SESSION['saldo'])) {
    echo "<br>Saldo da conta: R$" . $_SESSION['saldo'] . ",00  <br><br>";
} else {
    echo "Saldo da conta: R$0,00 <br><br>";
}

$saque = 0;
$mostrarFormulario = true; // mostrar formulário 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION["saldo"])) {
        echo "<p style='color: red;'>Saldo Insuficiente.</p>";
    } else {

        // validação
        if (isset($_POST['enviar'])) {
            $saque = filter_input(INPUT_POST, 'enviar', FILTER_VALIDATE_INT);

            if ($saque === false || $saque < 10  ) {
                echo "<p style='color: red;'>Valor de saque inválido.</p>";


         
            } elseif ($saque % 10 != 0) {
                // caso o valor não seja multiplo, ele arredonda
                $saqueArredondado = floor($saque / 10) * 10;
                echo "Infelizmente não temos notas para imprimir esse valor, deseja arredondar para um valor mais baixo? O valor arredondado seria: R$$saqueArredondado,00";
                echo '<form action="saque.php" method="post">';
                echo "<button type='submit' name='sim'>Sim</button>";
                echo "<button type='submit' name='nao'>Não</button>";
                echo "<input type='hidden' name='saque' value='$saque'/>";
                echo '</form>';

                // controle para mostrar formulário
                $mostrarFormulario = false;
            } else {

                //vericação

                if ($saque <= $_SESSION['saldo'] && $_SESSION['limite'] + $saque <= 2000) {
                    $_SESSION['saldo'] -= $saque;
                    $_SESSION['limite'] += $saque;
                    echo "<p style='color: lime;'>Saque de R$$saque efetuado com sucesso!</p>";
                    echo "<p>Saldo Atual: R$" . $_SESSION['saldo'] . ",00</p>";
                    echo "<p>Limite total após saque: R$" . $_SESSION['limite'] . ",00</p>";
                    $saqueBotao = $saque;
                    $saldoAtual = $_SESSION['saldo'];

                    // criando arquivo txt para armazenar operação
                    $arquivo = "meu_arquivo.txt";

                    $handle = fopen($arquivo, "a");
                    fwrite($handle, "Saque ");
                    fwrite($handle, "-" . number_format($saque, 2, ',', '.') . "\n");
                    fclose($handle);

                } else {
                    echo "<p style='color: red;'>Valor superior ao saldo disponível ou limite diário atingido.</p>";
                }
            }
        }


        // se o usuário selecionar o botão sim
        if (isset($_POST['sim'])) {
            $saque = $_POST['saque'];


            $saqueArredondado = floor($saque / 10) * 10; // arredonda para o múltiplo de 10 mais próximo

            if ($saqueArredondado <= $_SESSION['saldo'] && $_SESSION['limite'] + $saqueArredondado <= 2000) {
                $_SESSION['saldo'] -= $saqueArredondado;
                $_SESSION['limite'] += $saqueArredondado;
                echo "<p style='color: lime;'>Saque de R$$saqueArredondado efetuado com sucesso!</p>";
                echo "<p>Saldo Atual: R$" . $_SESSION['saldo'] . ",00</p>";
                echo "<p>Limite total após saque: R$" . $_SESSION['limite'] . ",00</p>";
                $saldoAtual = $_SESSION['saldo'];

                // criando arquivo txt para armazenar operação

                $arquivo = "meu_arquivo.txt";

                $handle = fopen($arquivo, "a");
                fwrite($handle, "Saque ");
                fwrite($handle, "-" . number_format($saque, 2, ',', '.') . "\n");
                fclose($handle);

            } else {
                echo "<p style='color: red;'>Não foi possível realizar o saque, saldo ou limite insuficientes.</p>";
            }

        }


        // se o usuário selecionar botão não
        if (isset($_POST['nao'])) {
            echo "Operação cancelada. Nenhum valor foi arredondado.";
        }

    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saque - BancoFlacko</title>
    <script src="funcoes.js"></script>
    <style>
        #inputSaque,
        #teclado {
            display: block;
        }
    </style>
</head>

<body>


    <!-- if para a condição do botão sim ou não do saque de não múltiplo -->
    <?php if ($mostrarFormulario): ?>
        <form action="saque.php" method="post" id="formSaque">
            <input type="text" id="saque" name="enviar" value="" id="inputSaque"> <br> <br>

            <div class="botoes" id="teclado">
                <button type="button" onclick="adicionarNumero('1')">1</button>
                <button type="button" onclick="adicionarNumero('2')">2</button>
                <button type="button" onclick="adicionarNumero('3')">3</button><br>
                <button type="button" onclick="adicionarNumero('4')">4</button>
                <button type="button" onclick="adicionarNumero('5')">5</button>
                <button type="button" onclick="adicionarNumero('6')">6</button><br>
                <button type="button" onclick="adicionarNumero('7')">7</button>
                <button type="button" onclick="adicionarNumero('8')">8</button>
                <button type="button" onclick="adicionarNumero('9')">9</button><br>
                <button type="button" onclick="adicionarNumero('0')">0</button>
                <button type="button" onclick="limparCampo()">Limpar</button><br>
            </div>

            <button type="submit">Enviar</button>
        </form>
    <?php endif; ?>

    <footer>
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