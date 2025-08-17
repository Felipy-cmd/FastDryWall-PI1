<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Constru+</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="icon" type="image/png" href="img/logo_constru+ (1).png">
    <style>
        .logo-canto {
  position: fixed;   
  top: 10px;         
  left: 10px;        
  width: 80px;      
  height: auto;      
}
    </style>
</head>
<body>
    <img class="logo-canto" src="img/logo_constru+.png" alt="ola">
    <h1>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h1>
    <p>Você está logado como: <strong><?php echo $_SESSION['posicao']; ?></strong></p>

    <?php if ($_SESSION['posicao'] === 'gerente'): ?>
    <h2>Menu do Gerente</h2>
    <ul class="gerente">
       <li><a href="obras_lista.php">📑 Controle de Obras</a></li>
       <li><a href="orcamentos.php">💰 Orçamentos</a></li>
       <li><a href="estoque_lista.php">📦 Estoque</a></li>
       <li><a href="produto_lista.php">🧱 Produtos</a></li>
       <li><a href="cadastro_usuario.php">👤 Cadastro de Funcionários</a></li>
</ul>

<?php else: ?>
    <h2>Menu do Funcionário</h2>
    <ul class="funcionario">
        <li><a href="ver_obras.php">📑 Ver Obras</a></li>
        <li><a href="registrar_servico.php">🛠 Registrar Serviços</a></li>
    </ul>
<?php endif; ?>

<a href="logout.php" class="sair">Sair</a>
</body>
</html>