<?php
session_start();
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
        Limite de empréstimo: R$1,500,00 <br>
        <!-- <br> Limite utilizado: 0,00 (indefinido)
            <br> Limite Dispomivel: 1.500.00
            <br> Vencimento da 1^parcela: escolher entre 01/12/2024 e 17/03/2025 <br> <br> -->


        Valor do empréstimo: <input type="text" name="emprestimo"  > 
        <input type="submit" value="enviar"> <br>
        <!-- Quantidade Parcelas: <input type="text" name="parcelas" >  -->
        <input type="submit" value="enviar"> <br>

        <?php
    if(isset($_POST['emprestimo'])){

    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $emprestimo = $_POST['emprestimo'];
        
        //parcelas de 36 meses
        // $juros = 0.07;
        // $parcela36 = 36;
        // $valorDeParcela46 = ($emprestimo * (1 + $juros)) / $parcela36;
    
        // adicionar prazo de pagamento
    

        // parcelas de 24 meses
        $juros = 0.06; // valor de juros
        $parcela24 = 24; // quantidade de meses (parcelas)
        $valorDeParcela24 = ($emprestimo * (1 + $juros)) / $parcela24; // cálculo para capturar o valor de empréstimo que o usuário digitar
    
        //parcelas de 12 meses
        $juros = 0.05;
        $parcela12 = 12;
        $valorDeParcela12 = ($emprestimo * (1 + $juros)) / $parcela12;

        // parcelas de 6 meses
        $juros = 0.04;
        $parcela6 = 6;
        $valorDeParcela6 = ($emprestimo * (1 + $juros)) / $parcela6;

        // parcelas de 3 meses
        $juros = 0.03;
        $parcela3 = 3;
        $valorDeParcela3 = ($emprestimo * (1 + $juros)) / $parcela3;

        // parcelas de 1 mes 
        $juros = 0.02;
        $parcela1 = 1;
        $valorDeParcela1 = ($emprestimo * (1 + $juros)) / $parcela1;

        // // parcelas do cliente 
        // $juros = 0.02;
        // $parcela = $_POST['parcelas'] ;
        // $valorDeParcela1 = ($emprestimo * (1 + $juros)) / $parcelas;




        // se parcela for maior que 3000, é possivel parcelar até 24x, 5% de taxa
        // se parcela for maior que 1.500 é possivel parcelar até 12x 4% de taxa
        // se parcela for maior que 500 é possivel para até 6x 3% de taxa
        // se parcela for maior que 30 é possivel parcelar até 3x , 2% de taxa
        // se for menor, voce nao pode parcelar, apenas devera pagar na data selecionada
    
        // if ($parcelas >36){
    
        if ($emprestimo > 1500) {
            echo "Valor inválido.";
        } else {


                
            if ($emprestimo >= 1000) {
                echo '<br><button>12 Parcelas <br> R$ ' . number_format($valorDeParcela12, 2, ',', '.') . '</button>';
                echo '<br><button>6 Parcelas <br> R$ ' . number_format($valorDeParcela6, 2, ',', '.') . '</button>';
                echo '<br><button>3 Parcelas <br>R$ ' . number_format($valorDeParcela3, 2, ',', '.') . '</button>';
                echo '<br><button>1 Parcelas <br> R$ ' . number_format($valorDeParcela1, 2, ',', '.') . '</button> <br>';
            } else if ($emprestimo >= 500) {
                echo '<br><button>12 Parcelas <br>R$ ' . number_format($valorDeParcela12, 2, ',', '.') . '</button>';
                echo '<br><button>6 Parcelas <br>R$ ' . number_format($valorDeParcela6, 2, ',', '.') . '</button>';
                echo '<br><button>3 Parcelas <br>R$ ' . number_format($valorDeParcela3, 2, ',', '.') . '</button>';
                echo '<br><button>1 Parcelas <br> R$ ' . number_format($valorDeParcela1, 2, ',', '.') . '</button> <br>';
            } else if ($emprestimo >= 10) {
                echo '<br><button>3 Parcelas <br> R$ ' . number_format($valorDeParcela3, 2, ',', '.') . '</button>';
                echo '<br><button>1 Parcelas <br> R$ ' . number_format($valorDeParcela1, 2, ',', '.') . '</button> <br>';
            } else {
                echo 'Valor Invalido de Solicitação de Emprestimo';
            }
            if (isset($_POST['emprestimo'])) {
                // Mostrar o formulário se o botão 'emprestimo' foi clicado
                echo "<form action='emprestimo.php' method='post'>
            Quantidade de parcelas: <input type='text' name='parcelas' placeholder='Digite o número de parcelas'>
            Min: 2 e max 15
                <input type='submit' value='Enviar'>
                </form>";
                
                
                // Verificar se 'parcelas' foi enviado
                if (isset($_POST['parcelas'])) {
                    $parcelas = $_POST['parcelas'];
                    echo "Número de parcelas: " . htmlspecialchars($parcelas);
                }
            }
        }
    }
?>

    























    

</body>

</html>