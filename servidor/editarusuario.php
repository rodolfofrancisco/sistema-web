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

$id = $_POST['id'];
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
	if (($value == '') && ($key != 'senha') && ($key != 'confsenha')){
		$msg .= "Voce deve preenche o campo {$key} <br />";
		$erro = true;
	}
}
if (!isset($_POST['sexo'])){
	$erro = true;
	$msg .= "Voce deve preencher o sexo <br />";
}

//Valida somente se digitar a senha
if ($senha != ''){
	if ($senha != $confsenha){
		$erro = true;
		$msg .= "Suas senhas não conferem <br />";
	}
}


$email = $_POST['email'];
$regex = '^'. '[_a-z0-9-]+'. '(\.[_a-z0-9-]+)*'. '@'. '[a-z0-9-]+'. '(\.[a-z0-9-]{2,})+'. '$';

if (!eregi($regex, $email)) {
	$erro = true;
	$msg .= "Digite um e-mail válido!<br />";

}
if (!$erro){
	$sql = "UPDATE usuario SET acesso = '" . $privilegio ."', login = '" . $login ."', nome = '" . $nome ."', email ='" . $email ."', codigogrupo =  '" . $grupo ."', datanasc = '" . $datanasc ."', sexo = '" . $sexo ."', telefone = '" . $telefone . "'"; 
	
	if ($senha != ''){
		$sql .= ", senha = '" . md5($senha) . "'";
	}
	$sql .= " WHERE id = " . $id ;

	$result = mysqli_query($conexao, $sql, $field=0);

	$msg .= "Usuario editado com sucesso<br />";
}

mysqli_close($conexao);

header("Location: ../editarusuario.php?status={$erro}&msg={$msg}&id={$id}");

?>      
