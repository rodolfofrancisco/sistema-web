<?php
require_once("conexao.php");
session_start();

//Se não tiver logado redireciona para login
if (isset($_SESSION["Usuario"]) /*&& isset($_COOKIE['logado'])*/){
	setcookie("logado", 'ok', time()+60, "/");			
	
	//Se não for admin redireciona para index
	if ($_SESSION['Usuario']['acesso'] != 1){
		header("Location: index.php");
	}	
}else{
	session_destroy();
	header("Location: login.php");
}


$nome = $_POST['nome'];
$tipo = $_POST['tipo'];

$erro = false;
$msg = "";
foreach($_POST as $key => $value){
	if ($value == ''){
		$msg .= "Voce deve preenche o campo {$key} <br />";
		$erro = true;
	}
}

if (!$erro){
	$sql = "INSERT INTO grupo (nome, tipo) 
			VALUES('" . utf8_decode($nome) ."', '" . utf8_decode($tipo) ."')"; 

	$result = mysqli_query($conexao, $sql, $field=0);

	$msg .= "Grupo inserido com sucesso<br />";
}

mysqli_close($conexao);

header("Location: ../cadastrargrupo.php?status={$erro}&msg={$msg}");

?>      
