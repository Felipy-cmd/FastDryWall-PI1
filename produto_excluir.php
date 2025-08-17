<?php
require "conexao.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $conn->query("DELETE FROM produtos WHERE id=$id");
}

header("Location: produto_lista.php");
exit;
