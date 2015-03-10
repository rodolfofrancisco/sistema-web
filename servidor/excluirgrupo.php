<?php
require_once("conexao.php");
session_start();

//Se não tiver logado redireciona para login
if (isset($_SESSION["Usuario"]) && isset($_COOKIE['logado'])) {
    setcookie("logado", 'ok', time()+60, "/");			
	
    //Se não for admin redireciona para index
    if ($_SESSION['Usuario']['acesso'] != 1) {
        header("Location: index.php");
    }	
} else {
    session_destroy();
    header("Location: login.php");
}

$id = $_GET['id'];
$erro = false;
$msg = '';
foreach ($_POST as $key => $value) {
    if ($value == '') {
        $msg .= " Você deve preencher o campo {$key} <br>";
        $erro = true;
    }
}

if (!$erro) {
    $sql = "DELETE FROM grupo WHERE codigo = '".$id."'";
    $result = mysqli_query($conexao, $sql, $field=0);
    if ($result) {
        $msg .= "Registro excluído com sucesso<br>";
    } else {
        $msg .= "Não é possível excluir este grupo, verificar se algum usuário relacionado a este grupo.<br>";
    }
        
}

mysqli_close($conexao);

header("Location: ../admin.php?status={$erro}&msg={$msg}");
