<?php
session_start();

function dataDePagamento()
{
    // Cria o timestamp para o próximo mês
    $dia30Timestamp = mktime(0, 0, 0, date("m") + 1, date("d"), date("Y"));
    
    // Cria um objeto DateTime e ajusta para o timestamp calculado
    $dia30 = new DateTime();
    $dia30->setTimestamp($dia30Timestamp);

    // Retorna a data formatada
    return $dia30->format("d/F/Y à\s h:i");
}


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
    <script src="funcoes.js"></script>


    <script>
        // função para botões de selecionar data
        function validarBotao() {
            if (!document.querySelector('input[id="dias"]:checked')) {
                alert("Por favor, escolha um dos períodos (30 dias, 60 dias ou 90 dias).");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>

    <!-- Formulário para pegar o valor de empréstimo -->
    <form action="emprestimo.php" method="post" onsubmit="return validarBotao()">
        Valor Mínimo: 10R$ <br>
        Pagamento em até 90 dias! <br>
        Valor do empréstimo: <input type="text" name="emprestimo" id="saque" required> <br>



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

        <button type="button" onclick="adicionarNumero('0')">0</button>
        <button type="button" onclick="limparCampo()">Limpar</button><br>




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
        // $aliquota = ($emprestimo * 3) / 100;
    

        // // calculo iof 30 dias
    
        //     if(isset($_POST['30dias'])){
        //         $iofDiario = $emprestimo * 0.000082;
    
        //         $iof30dias = $iofDiario * 30;
    
        //         $iofTotal = $aliquota + $iof30dias;
        //         echo "ValorIof30: " . $iofTotal;
        //     } else if(isset($_POST["60dias"])){
        //         $iofDiario = $emprestimo * 0.000082;
    
        //         $iof60dias = $iofDiario * 60;
    
        //         $iofTotal = $aliquota + $iof60dias;
        //         echo "ValorIof60: " . $iofTotal;
        //     } else if(isset($_POST["90dias"])){
        //         $iofDiario = $emprestimo * 0.000082;
    
        //         $iof90dias = $iofDiario * 90;
    
        //         $iofTotal = $aliquota + $iof90dias;
        //         echo "ValorIof90: " . $iofTotal;
        //     }
    






        //  verificações
        if ($_SESSION['limiteEmprestimo'] < $emprestimo) {
            echo "<p style='color: red;'>Limite de empréstimo inválido.</p>";
        } else {

            // empréstimo não pode ser maior que 1500 e nem menor que 10
            if ($emprestimo > 1500 || $emprestimo < 10) {
                echo "<p style='color: red;'>Valor inválido.</p>";
            } else {



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

                        echo "Resultado de Simulação: <br>";
                        echo "$parcela12 parcelas de: R$" . number_format($valorDeParcela12, 2, ',', '.') . '<br>';
                        echo "Valor entregue R$:" . number_format($emprestimo, 2, ',', '.') . '<br>';

                        echo "Taxa: " . number_format($juros12, 2, ',', '.') . "%" . '<br>';
                        echo "Valor final R$:" . number_format($valorFinal12, 2, ',', '.') . '<br>';
                        // echo "Valor Iof: $iofTotal";
                        echo "Confirma transação? ";

                        //formulário para confirmação de operação 
                        echo '<form action="emprestimo.php" method="post">';
                        echo "<button type='submit' name='botaosim'>Sim</button>";
                        echo "<button type='submit' name='nao'>Não</button>";
                        echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                        echo '</form>';

                    }
                    if (isset($_POST['botao6'])) {

                        echo "Resultado de Simulação: <br>";

                        echo "$parcela6 parcelas de: R$" . number_format($valorDeParcela6, 2, ',', '.') . '<br>';
                        echo "Valor entregue R$:" . number_format($emprestimo, 2, ',', '.') . '<br>';

                        echo "Taxa: " . number_format($juros6, 2, ',', '.') . "%" . '<br>';
                        echo "Valor final R$:" . number_format($valorFinal6, 2, ',', '.') . '<br>';
                        // echo "Valor Iof: $iofTotal";
                        echo "Confirma transação? ";

                        //formulário para confirmação de operação 
                        echo '<form action="emprestimo.php" method="post">';
                        echo "<button type='submit' name='botaosim'>Sim</button>";
                        echo "<button type='submit' name='nao'>Não</button>";
                        echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                        echo '</form>';

                    }
                }
                if (isset($_POST['botao3'])) {

                    echo "Resultado de Simulação: <br>";
                    echo "$parcela3 parcelas de: R$" . number_format($valorDeParcela3, 2, ',', '.') . '<br>';
                    echo "Valor entregue R$:" . number_format($emprestimo, 2, ',', '.') . '<br>';

                    echo "Taxa: " . number_format($juros3, 2, ',', '.') . "%" . '<br>';
                    echo "Valor final R$:" . number_format($valorFinal3, 2, ',', '.') . '<br>';
                    // echo "Valor Iof: $iofTotal";
                    echo "Confirma transação? ";

                    //formulário para confirmação de operação 
                    echo '<form action="emprestimo.php" method="post">';
                    echo "<button type='submit' name='botaosim'>Sim</button>";
                    echo "<button type='submit' name='nao'>Não</button>";
                    echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                    echo '</form>';

                }
                if (isset($_POST['botao1'])) {

                    echo "Resultado de Simulação: <br>";
                    echo "$parcela1 parcelas de: R$" . number_format($valorDeParcela1, 2, ',', '.') . '<br>';
                    echo "Valor entregue R$:" . number_format($emprestimo, 2, ',', '.') . '<br>';

                    echo "Taxa: " . number_format($juros1, 2, ',', '.') . "%" . '<br>';
                    echo "Valor final R$:" . number_format($valorFinal1, 2, ',', '.') . '<br>';
                
                    // echo "Pagamento no dia: " . (dataDePagamento());
                    // echo "Valor Iof: $iofTotal";
                    echo "Confirma transação? ";

                    //formulário para confirmação de operação 
                    echo '<form action="emprestimo.php" method="post">';
                    echo "<button type='submit' name='botaosim'>Sim</button>";
                    echo "<button type='submit' name='nao'>Não</button>";
                    echo "<input type='hidden' name='emprestimo' value='$emprestimo'/>";
                    echo '</form>';

                }

                // botão de confirmção
                if (isset($_POST['botaosim'])) {

                    $_SESSION['limiteEmprestimo'] -= $emprestimo;
                    echo "<p style='color: lime;'>Empréstimo de R$$emprestimo efetuado com sucesso!</p>";
                    echo "Limite de empréstimo atual:" . $_SESSION['limiteEmprestimo'];

                    $_SESSION['saldo'] = +$emprestimo;

                }
            }

        }



    }





    ?>


    <footer>
     
        <button><a href="./index.php">Inicio</a></button>


        <?php
        // data atual
        setlocale(LC_TIME, 'pt_BR.UTF-8');
        $dataAtual = new DateTime();
        $timezone = new DateTimeZone('America/Sao_Paulo');

        $dataAtual->setTimezone($timezone);
        echo $dataAtual->format('d/F /Y à\s h:i');
        ?>

    </footer>

</body>

</html>