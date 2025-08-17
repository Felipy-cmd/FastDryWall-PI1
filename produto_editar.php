<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: index.html"); exit; }
if ($_SESSION['posicao'] !== 'gerente') { die("Acesso negado (somente gerente)."); }
require "conexao.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { die("Produto inválido."); }

/* Se enviou o formulário, atualiza */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome   = $conn->real_escape_string($_POST['nome'] ?? '');
  $un     = $conn->real_escape_string($_POST['unidade'] ?? '');
  $preco  = $conn->real_escape_string($_POST['preco'] ?? '');

  if ($nome && $un && $preco !== '') {
    $sql = "UPDATE produtos SET nome='$nome', unidade='$un', preco='$preco' WHERE id=$id";
    $conn->query($sql);
    echo "<script>alert('Produto atualizado!'); window.location.href='produto_lista.php';</script>";
    exit;
  } else {
    echo "<script>alert('Preencha todos os campos');</script>";
  }
}

/* Busca o produto para preencher o form */
$res = $conn->query("SELECT * FROM produtos WHERE id=$id");
$produto = $res->fetch_assoc();
if (!$produto) { die("Produto não encontrado."); }
?>
<!doctype html>
<html lang="pt-BR">
<meta charset="utf-8">
<title>Editar Produto</title>
<link rel="stylesheet" href="style3.css">

  <h2>Editar Produto</h2>

  <form class="section" method="POST">
        <p>
            <img src="img/fasdrywall_logo.png" id="logofast">
        </p>
  <label>Nome<br>
    <input name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
  </label><br>

  <label>Unidade<br>
    <input name="unidade" value="<?= htmlspecialchars($produto['unidade']) ?>" required>
  </label><br>

  <label>Preço<br>
    <input type="number" step="0.01" name="preco"
           value="<?= htmlspecialchars($produto['preco']) ?>" required>
  </label><br><br>

  <button type="submit">Salvar Alterações</button>
  <a href="produto_lista.php">Voltar</a>
</div>
</form>
