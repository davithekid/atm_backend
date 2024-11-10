# learnings do projeto #

## 1. `isset`

A função `isset()` verifica se uma variável está definida e não é `null`. Exemplo:

```php
if (isset($variavel)) {
  echo "Esta variável está definida, então vou imprimir.";
}
```

  Determina se uma variável está declarada e é diferente de null

`!isset`
Quando você quer verificar se uma variável **não** está definida ou é `null`, pode usar o operador lógico `!` com a função `isset`:

```php
if (!isset($variavel)) {
  echo "A variável não está definida, então vou executar o bloco abaixo.";
}
````

- if ($_SERVER["REQUEST_METHOD"] == "POST") // está verificando as informações do formulário









