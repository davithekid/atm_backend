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

$saque = 0; // Definindo uma variável inicial para o saque
$mostrarFormulario = true; // Controle para mostrar o formulário de saque

// Verificando se a requisição foi POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe o valor digitado no campo de entrada
    if (isset($_POST['enviar'])) {
        $saque = filter_input(INPUT_POST, 'enviar', FILTER_VALIDATE_INT);
        if ($saque === false || $saque < 10) {
            echo "<p style='color: red;'>Valor de saque inválido. O valor mínimo de saque é R$10,00.</p>";
        } elseif ($saque % 10 != 0) {
            // Caso o valor não seja múltiplo de 10, pede para arredondar
            $saqueArredondado = floor($saque / 10) * 10;
            echo "Infelizmente não temos notas para imprimir esse valor, deseja arredondar para um valor mais baixo? O valor arredondado seria: R$$saqueArredondado,00";
            echo '<form action="saque.php" method="post">';
            echo "<button type='submit' name='sim'>Sim</button>";
            echo "<button type='submit' name='nao'>Não</button>";
            echo "<input type='hidden' name='saque' value='$saque'/>"; // Passando o valor do saque
            echo '</form>';

            // Alterando o controle para não mostrar o formulário de saque
            $mostrarFormulario = false;
        } else {
            // Verificando se o valor é válido para saque
            if ($saque <= $_SESSION['saldo'] && $_SESSION['limite'] + $saque <= 2000) {
                $_SESSION['saldo'] -= $saque;
                $_SESSION['limite'] += $saque;
                echo "<p style='color: lime;'>Saque de R$$saque efetuado com sucesso!</p>";
                echo "<p>Saldo Atual: R$" . $_SESSION['saldo'] . ",00</p>";
                echo "<p>Limite total após saque: R$" . $_SESSION['limite'] . ",00</p>";
            } else {
                echo "<p style='color: red;'>Valor superior ao saldo disponível ou limite diário atingido.</p>";
            }
        }
    }
    

    // se o usuário selecionar o botão sim
    if (isset($_POST['sim'])) {
        // Captura o valor do saque que foi passado através de um input hidden
        $saque = $_POST['saque'];
        $saqueArredondado = floor($saque / 10) * 10; // Arredonda para o múltiplo de 10 mais próximo

        if ($saqueArredondado <= $_SESSION['saldo'] && $_SESSION['limite'] + $saqueArredondado <= 2000) {
            $_SESSION['saldo'] -= $saqueArredondado; // Subtrai o valor arredondado do saldo
            $_SESSION['limite'] += $saqueArredondado; // Atualiza o limite
            echo "<p style='color: lime;'>Saque de R$$saqueArredondado efetuado com sucesso!</p>";
            echo "<p>Saldo Atual: R$" . $_SESSION['saldo'] . ",00</p>";
            echo "<p>Limite total após saque: R$" . $_SESSION['limite'] . ",00</p>";
        } else {
            echo "<p style='color: red;'>Não foi possível realizar o saque, saldo ou limite insuficientes.</p>";
        }
    }

    // se o usuário selecionar botão não
    if (isset($_POST['nao'])) {
        echo "Operação cancelada. Nenhum valor foi arredondado.";
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
        <input type="text" id="saque" name="enviar" value=""  id="inputSaque"> <br> <br>

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
