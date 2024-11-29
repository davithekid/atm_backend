<?php
session_start();

if (isset($_SESSION['saldo'])) {
    echo "<br>Saldo da conta: R$" . $_SESSION['saldo'] . ",00  <br>";
} else {
    echo "Saldo da conta: R$0,00 <br>";
}

if (!isset($_SESSION['limiteTransferencia'])) {
    $_SESSION['limiteTransferencia'] = 1500;
    echo "Limite de transferência diário da conta: R$" . $_SESSION['limiteTransferencia'] . ",00";
}

if (isset($_SESSION['limiteTransferencia'])) {
    echo "<br>Limite de transferência diário da conta: R$" . $_SESSION['limiteTransferencia'] . ",00<br><br>";
}

$arrayNomes = [
    'nome1' => 'Maria Clara Alves da Silva',
    'nome2' => 'João Pedro Souza Lima',
    'nome3' => 'Ana Beatriz Costa Silva',
    'nome4' => 'Carlos Eduardo Pereira',
    'nome5' => 'Gabriela Ferreira dos Santos',
    'nome6' => 'Lucas Henrique Gomes',
    'nome7' => 'Larissa Souza Rocha',
    'nome8' => 'Felipe Augusto Silva Costa',
    'nome9' => 'Mariana Oliveira Pinto',
    'nome10' => 'Rafael Almeida Rodrigues',
    'nome11' => 'Ana Carollini Rossi'

];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferência - BancoFlacko</title>
</head>

<body>

    <form action="transferencia.php" method="post">
        Banco
        <select name="banco" id="">
            <option value="104">104</option>
            <option value="260">260</option>
            <option value="001">001</option>
            <option value="341">341</option>
            <option value="237">237</option>
            <option value="033">033</option>
        </select>

        Conta: <input type="text" name="conta" id="conta" minlength="12" maxlength="12" required>
        Dígito: <input type="text" name="digito" id="digito" min="1" maxlength="1" required> <br>

        <input type="submit" value="enviar" name="formulario">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!isset($_SESSION["saldo"])) {
            echo "<p style='color: red;'>Saldo Insuficiente.</p>";
        } else {

            if (isset($_POST['formulario'])) {
                $_SESSION['array'] = [
                    "Banco" => $_POST["banco"],
                    "Conta" => $_POST["conta"],
                    "Digito" => $_POST["digito"]
                ];

                echo "<form action='transferencia.php' method='post'>";
                echo "Valor de transferência: <input type='text' name='transferencia'>";
                echo "<input type='submit' value='enviar'>";
                echo "</form>";

            } elseif (isset($_POST["transferencia"])) {
                $transferencia = $_POST["transferencia"];

                $transferencia = filter_input(INPUT_POST, 'transferencia', FILTER_VALIDATE_INT);
                if ($transferencia === false) {
                    echo "Valor de transferência inválido.";

                } else {



                    echo "Conta de Origem: ";
                    $rand_keys = array_rand($arrayNomes, 2);

                    echo $arrayNomes[$rand_keys[1]] . "\n";



                    foreach ($_SESSION['array'] as $key => $value) {
                        echo "<br>" . ($key) . ": " . $value . "<br>";
                    }
                    echo "<br> Valor de transferência: R$" . $transferencia . "<br>";

                    echo "Confirma transação? ";

                    //formulário para confirmação de operação 
                    echo '<form action="transferencia.php" method="post">';
                    echo "<button type='submit' name='botaosim'>Sim</button>";
                    echo "<button type='submit' name='nao'>Não</button>";
                    echo "<input type='hidden' name='confirmarTransferencia' value='$transferencia'/>";
                    echo '</form>';
                }


            } elseif (isset($_POST['botaosim'])) {
                $transferencia = $_POST['confirmarTransferencia'];


                if ($transferencia > $_SESSION['saldo']) {
                    echo "Saldo insuficiente";
                } else {

                    $_SESSION['limiteTransferencia'] -= $transferencia;
                    echo "<p style='color: lime;'>Transferência de R$$transferencia efetuada com sucesso!</p>";

                    $_SESSION['saldo'] -= $transferencia;

                    $arquivo = "meu_arquivo.txt";

                    $handle = fopen($arquivo, "a");
                    fwrite($handle, "Transferência ");
                    fwrite($handle, "-" . number_format($transferencia, 2, ',', '.') . "\n");
                    fclose($handle);
                }



            } elseif (isset($_POST['nao'])) {
                echo "Operação cancelada. Nenhum valor foi transferido.";
            }
        }
    }
    ?>

    <footer>
        <button><a href="./index.php">Início</a></button>

        <?php
        // data atual
        $dataAtual = new DateTime();
        $timezone = new DateTimeZone('America/Sao_Paulo');
        $dataAtual->setTimezone($timezone);
        echo $dataAtual->format('d/F/Y à\s h:i');
        ?>
    </footer>

    <script>


    </script>


</body>

</html>