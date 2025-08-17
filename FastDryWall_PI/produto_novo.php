<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: index.html"); exit; }
if ($_SESSION['posicao'] !== 'gerente') { die("Acesso negado (somente gerente)."); }
require "conexao.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome   = $conn->real_escape_string($_POST['nome'] ?? '');
  $un     = $conn->real_escape_string($_POST['unidade'] ?? '');
  $preco  = $conn->real_escape_string($_POST['preco'] ?? '');

  if ($nome && $un && $preco !== '') {
    $sql = "INSERT INTO produtos (nome,unidade,preco) VALUES ('$nome','$un','$preco')";
    $conn->query($sql);
    echo "<script>alert('Produto cadastrado!'); window.location.href='produto_lista.php';</script>";
    exit;
  } else {
    echo "<script>alert('Preencha todos os campos');</script>";
  }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
   <meta charset="utf-8">
   <title>Novo Produto</title>
   <link rel="stylesheet" href="style3.css">
   <link rel="icon" type="image/png" href="img/logo_constru+ (1).png">
</head>

 <body>
  <h2>Novo Produto</h2>

<form class="section" method="POST">
         <p>
            <img src="img/fasdrywall_logo.png" id="logofast">
        </p>
  <label>Nome<br>
    <input name="nome" placeholder="Nome do Produto" required>
  </label><br>

  <label>Unidade (ex.: un, m2, caixa)<br>
    <input name="unidade" placeholder="Padrão" required>
  </label><br>

  <label>Preço<br>
    <input type="number" step="0.01" name="preco" placeholder="Preço do Produto" required>
  </label><br>

  <button type="submit">Salvar</button>
  <a href="produto_lista.php">Voltar para lista</a>
</form>

 </body>
</html>
