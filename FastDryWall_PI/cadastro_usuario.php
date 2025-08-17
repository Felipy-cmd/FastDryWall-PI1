<?php
// --- topo: segurança mínima ---
session_start();
if (!isset($_SESSION['id'])) { header('Location: index.html'); exit; }
if ($_SESSION['posicao'] !== 'gerente') { die('Acesso negado (somente gerente).'); }

require 'conexao.php';

// --- se enviou o formulário, grava ---
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // pega campos (bem simples)
  $nome   = $conn->real_escape_string($_POST['nome']   ?? '');
  $email  = $conn->real_escape_string($_POST['email']  ?? '');
  $senha  = $conn->real_escape_string($_POST['senha']  ?? '');
  $pos    = $conn->real_escape_string($_POST['posicao']?? '');

  if ($nome && $email && $senha && ($pos === 'gerente' || $pos === 'funcionario')) {
    // OBS: estamos salvando senha SIMPLES para combinar com seu login atual.
    // Se quiser MD5 depois: troque '$senha' por MD5('$senha') aqui e ajuste o login.
    try {
      // gera hash seguro (bcrypt)
       $hash = password_hash($senha, PASSWORD_DEFAULT);
       $conn->query("INSERT INTO usuarios (nome,email,senha,posicao)
       
              VALUES ('$nome','$email','$hash','$pos')");
      echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='dashboard.php';</script>";
      exit;
    } catch (mysqli_sql_exception $e) {
      // erro de e-mail duplicado (chave UNIQUE)
      if ($e->getCode() == 1062) {
        $msg = 'Este e-mail já está cadastrado.';
      } else {
        $msg = 'Erro ao salvar: ' . $e->getMessage();
      }
    }
  } else {
    $msg = 'Preencha todos os campos corretamente.';
  }
}
?>
<!doctype html>
<html lang="pt-BR">
<meta charset="utf-8">
<title>Cadastrar Usuário</title>
<link rel="stylesheet" href="style3.css">
<link rel="icon" type="image/png" href="img/logo_constru+ (1).png">

<h2>Cadastrar Usuário</h2>

<?php if (!empty($msg)): ?>
  <p style="color:#b30000; font-weight:bold;"><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>

<form method="POST" class="section">
        <p>
            <img src="img/fasdrywall_logo.png" id="logofast">
        </p>
  <label>Nome<br>
    <input name="nome" required>
  </label><br>

  <label>E-mail<br>
    <input type="email" name="email" required>
  </label><br>

  <label>Senha<br>
    <input type="password" name="senha" required>
  </label><br>

  <label>Posição<br>
    <select name="posicao" required>
      <option value="gerente">Gerente</option>
      <option value="funcionario">Funcionário</option>
    </select>
  </label><br>

  <button type="submit">Salvar</button>
  <p><a href="usuario_lista.php">Usuário</a> | <a href="dashboard.php">← Voltar</a></p>
</form>