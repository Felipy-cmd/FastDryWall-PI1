<?php
session_start();
if (!isset($_SESSION['id'])) { header('Location: index.html'); exit; }
if ($_SESSION['posicao'] !== 'gerente') { die('Acesso negado.'); }
require 'conexao.php';

$res = $conn->query("SELECT id, nome, email, posicao FROM usuarios ORDER BY id DESC");
?>
<!doctype html>
<html lang="pt-BR">
<meta charset="utf-8">
<title>Usuários</title>
<link rel="stylesheet" href="style3.css">

<h2>Usuários</h2>
<p><a href="cadastro_usuario.php">+ Novo usuário</a> | <a href="dashboard.php">← Voltar</a></p>

<table border="1" cellpadding="6" cellspacing="0">
  <tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Posição</th></tr>
  <?php while($u=$res->fetch_assoc()): ?>
  <tr>
    <td><?= $u['id'] ?></td>
    <td><?= htmlspecialchars($u['nome']) ?></td>
    <td><?= htmlspecialchars($u['email']) ?></td>
    <td><?= htmlspecialchars($u['posicao']) ?></td>
  </tr>
  <?php endwhile; ?>
</table>