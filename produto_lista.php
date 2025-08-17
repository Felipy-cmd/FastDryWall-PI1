<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: index.html"); exit; }
if ($_SESSION['posicao'] !== 'gerente') { die("Acesso negado (somente gerente)."); }
require "conexao.php";

$res = $conn->query("SELECT * FROM produtos ORDER BY id DESC");
?>
<!doctype html>
<html lang="pt-BR">
<meta charset="utf-8">
<title>Produtos</title>
<link rel="stylesheet" href="style3.css">

<h2>Produtos</h2>

<p>
  <a href="produto_novo.php">+ Novo produto</a>
  <br>
  <a href="dashboard.php">← Voltar ao painel</a>
</p>

<table border="1" cellpadding="6" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Unidade</th>
    <th>Preço</th>
    <th>Ações</th>
  </tr>
  <?php while($p = $res->fetch_assoc()): ?>
    <tr>
      <td class="actions"><?= $p['id'] ?></td>
      <td class="actions"><?= htmlspecialchars($p['nome']) ?></td>
      <td class="actions"><?= htmlspecialchars($p['unidade']) ?></td>
      <td class="actions">R$ <?= number_format((float)$p['preco'], 2, ',', '.') ?></td>
      <td class="actions">
        
        
  <a href="produto_editar.php?id=<?= $p['id'] ?>">Editar</a> |
  <a href="produto_excluir.php?id=<?= $p['id'] ?>"
     onclick="return confirm('Tem certeza que deseja excluir este produto?');">
     Excluir
  </a>


      </td>
    </tr>
  <?php endwhile; ?>
</table>
