<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferencia - BancoFlacko</title>
</head>

<body>

    <form action="transferencia.php" method="post">

        Agência
        <select name="agencia" id="">
            <option value="">104</option>
            <option value="">260</option>
            <option value="">001</option>
            <option value="">341</option>
            <option value="">237</option>
            <option value="">033</option>
        </select>

        Banco: <input type="text" name="banco" required>
        Conta: <input type="text" name="conta" required>
        Digito: <input type="text" name="digito" required> <br>

        <input type="submit" value="enviar" name="formulario">
    </form>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['formulario'])){

            
            $array = $_POST['formulario'];
            
            
            $array = [
                "agencia" => $_POST['agencia'],
                "banco" => $_POST["banco"],
                "conta" => $_POST["conta"],
                "digito" => $_POST["digito"]
                
            ];

            echo "<form action='transferencia.php' method='post'>";
            echo "Valor: <input type='text' name='valor'>";
            echo "<input type='submit' value='enviar'>";
            echo "</form>";
            
        }
        
        if (isset($_POST["valor"])){
            $valor = $_POST["valor"];
            echo $valor;

        }
    }


    ?>






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