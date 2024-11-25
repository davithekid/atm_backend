<?php
session_start();

if (!isset($_SESSION['limiteEmprestimo'])) {
    $_SESSION['limiteEmprestimo'] = 1500;
    echo "Limite de emprestimo da conta:" . $_SESSION['limiteEmprestimo'];

}

if (isset($_SESSION['limiteEmprestimo'])) {
    echo "<br>Limite de Empréstimo da conta: R$" . $_SESSION['limiteEmprestimo'] . ",00  <br><br>";
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimo - BancoFlacko</title>


    <script>
        // Função para validar se o usuário selecionou um dos períodos de parcelamento
        function validarBotao() {
            if (!document.querySelector('input[id="dias"]:checked')) {
                alert("Por favor, escolha um dos períodos (30 dias, 60 dias ou 90 dias).");
                return false; // Impede o envio do formulário
            }
            return true; // Permite o envio do formulário se um botão for escolhido
        }
    </script>
</head>

<body>

    <!-- Formulário para pegar o valor de empréstimo -->
    <form action="emprestimo.php" method="post" onsubmit="return validarBotao()">
        Valor Mínimo: 10R$ <br>
        Pagamento em até 90 dias! <br>
        Valor do empréstimo: <input type="text" name="emprestimo" required> <br>

        <!-- Seleção do período -->
        <br>Data da primeira parcela:
        <br><input type="radio" id="dias" name="30dias" value="30">
        <label for="30dias">30 dias</label>
        <br><input type="radio" id="dias" name="60dias" value="60">
        <label for="60dias">60 dias</label>
        <br><input type="radio" id="dias" name="90dias" value="90">
        <label for="90dias">90 dias</label>
        <br><br>

        <input type="submit" value="Enviar">
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $emprestimo = $_POST['emprestimo']; // recebendo valor de emprestimo
    
        // cálciulo de parcelas/juros/valor final
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

        // se parcela for maior que 1.000 é possivel parcelar até 12x 12% de taxa
        // se parcela for maior que 500 é possivel para até 6x 6% de taxa
        // se parcela for maior que 30 é possivel parcelar até 3x , 2% de taxa
        // se for menor, voce nao pode parcelar, apenas devera pagar na data selecionada
    
        // calculo alíquota
        $aliquota = ($emprestimo * 3) / 100;

        
        // calculo iof 90 diaas
        $iofDiario = $emprestimo * 0.000082;

        $iof90dias = $iofDiario * 90;

        $iofTotal = $aliquota + $iof90dias;
        echo "aaaaaaa" . $iofTotal;


        //  verificações
        if ($_SESSION['limiteEmprestimo'] < $emprestimo) {
            echo "<p style= 'color: red; '> Seu limite de empréstimo foi esgotado. </p>";
        } else {



            if ($emprestimo > 1500 || $emprestimo < 10) {
                echo "Valor inválido.";
            }
            if ($_SESSION['limiteEmprestimo'] < 10) {
                // buscar função para esconder form
            } else {






                if (isset($emprestimo)) {
                    echo "<br> Valor: $emprestimo <br>"; // mostrando o valor na tela
                }





                // botões de parcelas com base no valor solicitado
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






                    // casos de input de cada botão (selecionando parcela 12)
                    if (isset($_POST['botao12'])) {

                        echo "Resultado de Simulação <br>";
                        echo "parcelas <br> $parcela12 x $valorDeParcela12 ";
                        echo "<br> Valor entregue";
                        echo " <br> $emprestimo";
                        echo "<br> Valor de juros";
                        echo "<br> $juros12 <br>";
                        echo "Valor final: $valorFinal12 <br> ";
                        echo "Valor Iof: $iofTotal";
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
                        echo "<br> Valor de juros";
                        echo "<br> $juros6 <br>";
                        echo "Valor final: $valorFinal6";

                        // form
                        echo '<form action="emprestimo.php" method="post">';
                        echo "<button type='submit' name='botaosim'>Sim</button>";
                        echo "<button type='submit' name='nao'>Não</button>";
                        echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                        echo '</form>';

                    }
                }
                if (isset($_POST['botao3'])) {

                    echo "Resultado de Simulação <br>";
                    echo "parcelas <br> $parcela3 x $valorDeParcela3 "; // dados parcela
                    echo "<br> Valor entregue";
                    echo " <br> $emprestimo"; // input de emprestimo
                    echo "<br> Valor de juros";
                    echo "<br> $juros3 <br>"; // taxa de juros
                    echo "Valor final: $valorFinal3"; // valor final (junção)
    
                    // form
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
                    echo "<br> Valor de juros";
                    echo "<br> $juros1 <br>";
                    echo "Valor final: $valorFinal1";

                    // form
                    echo '<form action="emprestimo.php" method="post">';
                    echo "<button type='submit' name='botaosim'>Sim</button>";
                    echo "<button type='submit' name='nao'>Não</button>";
                    echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                    echo '</form>';

                }

                // botão de confirmção
                if (isset($_POST['botaosim'])) {

                    $_SESSION['limiteEmprestimo'] -= $emprestimo;
                    echo "Empréstimo efetuado com sucesso! <br>";
                    echo "Limite de empréstimo atual:" . $_SESSION['limiteEmprestimo'];
                }

            }
        }
    }
    ?>


    <footer>
        <button onclick="window.history.back()">Voltar</button>
        <button><a href="./index.php">Inicio</a></button>


        <?php
        // data atual
        $dataAtual = new DateTime();
        echo $dataAtual->format('d/M/Y à\s h:i');
        // função para calcular dias
        //     $dataAtual = new DateTime();
        //     $dataAtual ->modify('+90days');
        //    echo  $dataAtual ->format ('d/M/Y à\s h:i');
        
        ?>


    </footer>

</body>

</html>