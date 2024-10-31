<?php
session_start();

if (isset($_SESSION['saldo'])){
    echo "Valor disponivel para saque: " . $_SESSION['saldo'];
}else{
    echo "Valor disponivel para saque: R$0,00";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="saque.php" method="post">
   Quanto deseja sacar? <input type="text" name="saque">
    <input type="submit" value="sacar">
    </form>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $saque = $_POST['saque'];
        if($saque > $_SESSION['saldo']){
            echo "impossivel efetuar o saque desejado";
        }else{
            $_SESSION['saldo'] = $_SESSION['saldo'] - $saque;
            echo "Saque de " .  $saque . " efetuado com sucesso!!";
        }
    }

    ?>
    <button>
        <a href="./index.php">voltar</a>
    </button>
</body>
</html>