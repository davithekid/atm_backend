# conhecimentos com o projeto

## isset  e !isset()
## 1. `isset()`
- **Descrição**: A função `isset()` verifica se uma variável está definida e não é `null`.
- **Uso Comum**: Frequentemente utilizada para checar se variáveis de sessão ou dados de formulários estão disponíveis antes de serem usadas, evitando erros.

  ```php
  if (isset($_SESSION['saldo'])) {
      // A variável 'saldo' está definida e não é null
  }
  
-!isset ( usa um operador lógico para que se caso a variavel n estiver definida, ele executa o bloco abaixo)



 - if ($_SERVER["REQUEST_METHOD"] == "POST") // está verificando as informações do formulário
   . eu posso fundir os dois em uma linha, podendo verificar as inforrmações enviadas pelo usuário e se o valor foi null ou não.