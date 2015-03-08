<?php
require_once("conexao.php");
session_start();

//Se não tiver logado redireciona para login
if (isset($_SESSION["Usuario"]) && isset($_COOKIE['logado'])){
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
$email = $_POST['email'];
$datanasc = $_POST['datanasc'];
$telefone = $_POST['telefone'];
$sexo = $_POST['sexo'];
$privilegio = $_POST['privilegio'];
$grupo = $_POST['grupo'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$confsenha = $_POST['confsenha'];

$erro = false;
$msg = "";
foreach($_POST as $key => $value){
	if ($value == ''){
		$msg .= "Voce deve preenche o campo {$key} <br />";
		$erro = true;
	}
}
if (!isset($_POST['sexo'])){
	$erro = true;
	$msg .= "Voce deve preencher o sexo <br />";
}

if ($senha != $confsenha){
	$erro = true;
	$msg .= "Suas senhas não conferem <br />";
}

$email = $_POST['email'];
$regex = '^'. '[_a-z0-9-]+'. '(\.[_a-z0-9-]+)*'. '@'. '[a-z0-9-]+'. '(\.[a-z0-9-]{2,})+'. '$';

if (!eregi($regex, $email)) {
	$erro = true;
	$msg .= "Digite um e-mail válido!<br />";

}

if (!$erro){
	$sql = "INSERT INTO usuario (acesso, login, senha, nome, email, codigogrupo, datanasc, sexo, telefone) 
			VALUES('" . $privilegio ."', '" . $login ."', '" . $senha ."', '" . $nome ."', '" . $email ."', '" . $grupo ."', '" . $datanasc ."', '" . $sexo ."', '" . $telefone ."')"; 

	$result = mysqli_query($conexao, $sql, $field=0);

	$msg .= "Usuario inserido com sucesso<br />";
}

mysqli_close($conexao);

header("Location: ../cadastrarusuario.php?status={$erro}&msg={$msg}");

?>      
