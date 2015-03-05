<?php
	require_once("conexao.php");
	/*session_start();
	
	if(isset($_SESSION["login"]) && isset($_SESSION["senha"])) {        
		if(isset($_COOKIE["logado"]))  {
			echo "Usuario ".$_SESSION["login"]." conectado com sucesso!";
			setcookie("logado", 'ok', time()+60);			
		} else {
			session_destroy();
			header("Location: login.php");
		}	
	} else {*/	
		//Verifica se usuário digitado está cadastrado
	$sql = "SELECT count(login) as qtd from usuario where login = '".$_POST['login']."' and senha = '".$_POST['senha']."'";
    
	$result = mysqli_query($conexao, $sql, $field=0);
	
    if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$achou = $row["qtd"];
		}	
        
		if($achou) {				
			echo "Usuario ".$_POST["login"]." conectado com sucesso!";
			setcookie("logado", 'ok', time()+60);
			$_SESSION["login"] = $_POST['login'];	
			$_SESSION["senha"] = $_POST['senha'];	

			//Se for admin vai para admin.php
			//Senão vai para index.php
            if ($_POST["acesso"] == "1") {
            	echo '<br />Admin';
                /*header("Location: admin.php");   */
            }else{
            	echo '<br />Usuario';
                /*header("Location: index.php");   */
            }
		} else {   
            /*echo "Usuario e/ou senha invalido(s)";*/
			session_destroy();
			header("Location: login.php?msg=Usuario ou Senha Inválido!");                        
		}
	}	

	mysqli_close($conexao);
	/*}*/
?>