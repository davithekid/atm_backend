<?php
session_start();

if (isset($_SESSION['limiteEmprestimo'])) {
    echo "<br>Limite de Empréstimo da conta: R$" . $_SESSION['limiteEmprestimo'] . ",00  <br><br>";
} elseif (isset($_POST['botaosim'])) {
    $_SESSION['limite'];
} else {
    echo "Limite de Empréstimo da conta: R$0,00 <br><br>";
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimo - BancoFlacko</title>
</head>

<body>
    <form action="emprestimo.php" method="post">

        Valor do empréstimo: <input type="text" name="emprestimo">
        <input type="submit" value="enviar"> <br>

    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $emprestimo = $_POST['emprestimo'];

        //parcelas de 12 meses
        $juros12 = 0.12;
        $parcela12 = 12;
        $valorDeParcela12 = ($emprestimo * (1 + $juros12)) / $parcela12;
        $valorFinal12 = $emprestimo * (1 + $juros12);


        // parcelas de 6 meses
        $juros6 = 0.06;
        $parcela6 = 6;
        $valorDeParcela6 = ($emprestimo * (1 + $juros6)) / $parcela6;
        $valorFinal6 = $emprestimo * (1 + $juros6);

        // parcelas de 3 meses
        $juros3 = 0.03;
        $parcela3 = 3;
        $valorDeParcela3 = ($emprestimo * (1 + $juros3)) / $parcela3;
        $valorFinal3 = $emprestimo * (1 + $juros3);


        // parcelas de 1 mes 
        $juros1 = 0.02;
        $parcela1 = 1;
        $valorDeParcela1 = ($emprestimo * (1 + $juros1)) / $parcela1;
        $valorFinal1 = $emprestimo * (1 + $juros1);

        // se parcela for maior que 1.000 é possivel parcelar até 12x 5% de taxa
        // se parcela for maior que 500 é possivel para até 6x 3% de taxa
        // se parcela for maior que 30 é possivel parcelar até 3x , 2% de taxa
        // se for menor, voce nao pode parcelar, apenas devera pagar na data selecionada
    
        if ($emprestimo > 1500) {
            echo "Valor inválido.";
        } else {
            if (isset($emprestimo)) {
                echo "<br> Valor: $emprestimo <br>";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($emprestimo >= 1000) {
                    echo '<form action="emprestimo.php" method="post">';
                    echo '<br><button type="submit" name="botao12">12 Parcelas <br> R$ ' . number_format($valorDeParcela12, 2, ',', '.') . '</button>';
                    echo '<br><button type="submit" name="botao6">6 Parcelas <br> R$ ' . number_format($valorDeParcela6, 2, ',', '.') . '</button>';
                    echo '<br><button type="submit" name="botao3">3 Parcelas <br>R$ ' . number_format($valorDeParcela3, 2, ',', '.') . '</button>';
                    echo '<br><button type="submit" name="botao1">1 Parcelas <br> R$ ' . number_format($valorDeParcela1, 2, ',', '.') . '</button> <br>';
                    echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                    echo '</form>';
                } else if ($emprestimo >= 500) {
                    echo '<form action="emprestimo.php" method="post">';
                    echo '<br><button type="submit" name="botao6">6 Parcelas <br>R$ ' . number_format($valorDeParcela6, 2, ',', '.') . '</button>';
                    echo '<br><button type="submit" name="botao3">3 Parcelas <br>R$ ' . number_format($valorDeParcela3, 2, ',', '.') . '</button>';
                    echo '<br><button type="submit" name="botao1">1 Parcelas <br> R$ ' . number_format($valorDeParcela1, 2, ',', '.') . '</button> <br>';
                    echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                    echo '</form>';
                } else if ($emprestimo >= 10) {
                    echo '<form action="emprestimo.php" method="post">';
                    echo '<br><button type="submit" name="botao3">3 Parcelas <br> R$ ' . number_format($valorDeParcela3, 2, ',', '.') . '</button>';
                    echo '<br><button type="submit" name="botao1">1 Parcelas <br> R$ ' . number_format($valorDeParcela1, 2, ',', '.') . '</button> <br>';
                    echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                    echo '</form>';

                }
                if (isset($_POST['botao12'])) {

                    echo "Resultado de Simulação <br>";
                    echo "parcelas <br> $parcela12 x $valorDeParcela12 ";
                    echo "<br> Valor entregue";
                    echo " <br> $emprestimo";
                    echo "<br> Valor de taxa";
                    echo "<br> $juros12 <br>";
                    echo "Valor final: $valorFinal12 <br> ";
                    echo "Confirma transação? ";

                    //formulário para confirmação de operação 
                    echo '<form action="emprestimo.php" method="post">';
                    echo "<button type='submit' name='botaosim'>Sim</button>";
                    echo "<button type='submit' name='nao'>Não</button>";
                    echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                    echo '</form>';

                }
                if (isset($_POST['botao6'])) {

                    echo "Resultado de Simulação <br>";
                    echo "parcelas <br> $parcela6 x $valorDeParcela6 ";
                    echo "<br> Valor entregue";
                    echo " <br> $emprestimo";
                    echo "<br> Valor de taxa";
                    echo "<br> $juros6 <br>";
                    echo "Valor final: $valorFinal6";
                    echo '<form action="emprestimo.php" method="post">';
                    echo "<button type='submit' name='botaosim'>Sim</button>";
                    echo "<button type='submit' name='nao'>Não</button>";
                    echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                    echo '</form>';

                }
            }
            if (isset($_POST['botao3'])) {

                echo "Resultado de Simulação <br>";
                echo "parcelas <br> $parcela3 x $valorDeParcela3 ";
                echo "<br> Valor entregue";
                echo " <br> $emprestimo";
                echo "<br> Valor de taxa";
                echo "<br> $juros3 <br>";
                echo "Valor final: $valorFinal3";
                echo '<form action="emprestimo.php" method="post">';
                echo "<button type='submit' name='botaosim'>Sim</button>";
                echo "<button type='submit' name='nao'>Não</button>";
                echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                echo '</form>';

            }
            if (isset($_POST['botao1'])) {

                echo "Resultado de Simulação <br>";
                echo "parcelas <br> $parcela1 x $valorDeParcela1 ";
                echo "<br> Valor entregue";
                echo " <br> $emprestimo";
                echo "<br> Valor de taxa";
                echo "<br> $juros1 <br>";
                echo "Valor final: $valorFinal1";
                echo '<form action="emprestimo.php" method="post">';
                echo "<button type='submit' name='botaosim'>Sim</button>";
                echo "<button type='submit' name='nao'>Não</button>";
                echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                echo '</form>';

            }
            if (isset($_POST['botaosim'])) {

                $emprestimo = $_POST['emprestimo'];
                $_SESSION['limiteEmprestimo'] -= $emprestimo;
                echo "Empréstimo efetuado com sucesso! <br>";
                echo "Limite de empréstimo atual:".  $_SESSION['limiteEmprestimo'];
            }
        }
    }
    ?>


    <footer>
        <button onclick="window.history.back()">Voltar</button>
        <button><a href="./index.php">Menu Principal</a></button>
    </footer>

</body>

</html>