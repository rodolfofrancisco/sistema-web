<?php
require_once("conexao.php");
session_start();

//Verifica se usuário digitado está cadastrado
$sql = "SELECT * from usuario where login = '".$_POST['login']."' and senha = '".$_POST['senha']."'";

$result = mysqli_query($conexao, $sql, $field=0);

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$_SESSION ['Usuario'] = $row;
		$achou = true;
	}	

	if($achou) {				
		setcookie("logado", "ok", time()+60, "/");

		//Se for admin vai para admin.php
		//Senão vai para index.php
		if ($_SESSION['Usuario']['acesso'] == "1") {
			header("Location: ../admin.php");   
		}else{
			header("Location: ../index.php");   
		}
	} else {   
		session_destroy();
		header("Location: ../login.php?msg=Usuario ou Senha Inválidos!"); 
	}
}else{
	session_destroy();
	header("Location: ../login.php?msg=Usuario ou Senha Inválidos!");                        
}

mysqli_close($conexao);
/*}*/
?>