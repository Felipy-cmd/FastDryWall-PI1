<?php
session_start();
require "conexao.php";

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($email && $senha) {
    // compara se a senha em texto OU a senha MD5 batem
    $sql = "SELECT * FROM usuarios WHERE email = ? AND (senha = ? OR senha = MD5(?))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $senha, $senha);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    if ($user) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['posicao'] = $user['posicao'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('E-mail ou senha inválida'); window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('Preencha todos os campos'); window.location.href='index.html';</script>";
}