<?php
require_once("servidor/conexao.php");
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cadastro de Grupos</title>  
	<!-- Bootstrap -->
	<link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-3.3.2/js/bootstrap.min.js"></script> 
	<!-- Css de admin -->
	<link href="css/admin.css" rel="stylesheet"> 
</head>
<body>      
	<div class="container content">
		<div class="span10 offset1">
			<div class="row">
				<h3>Cadastro de Grupos</h3>
			</div>
			<div class="span10 offset1">
				<form class="form-horizontal" action="servidor/cadastrargrupo.php" method="post">    
					<div class="well">
						<?php
                                                    $cor = '';
							if (isset($_GET['status'])){
								if ($_GET['status'] == 1)
									$cor = "red";
								else{
									$cor = "green";
								}
							}
						?>
						<div class="msgerro <?php echo $cor; ?>">
						<?php
							echo isset($_GET['msg']) ? $_GET['msg'] : '';
						?>
						</div>
						<fieldset>                 
							<div class="control-group">
								<label class="control-label" for="nome">Nome </label>   
								<div class="controls">
									<input type="text" name="nome"/>  
								</div>
							</div>                 
							<div class="control-group">
								<label class="control-label" for="tipo">Tipo</label>
								<div class="controls">               
									<select name ="tipo">
										<option value = "">Selecione</option>
										<option value = "Ensino Fundamental">Ensino Fundamental</option>
                    <option value = "Ensino Médio">Ensino Médio</option>
                    <option value = "Graduação">Graduação</option>
										<option value = "Pós Graduação">Pós Graduação</option>
									</select>               
								</div>
							</div>					
						</fieldset> 
					</div>
					<div class="form-actions">
						<input type="submit" value="Enviar" class= "btn btn-success"/>
						<a class = "btn btn-default" href="admin.php">Voltar</a>  
					</div>      
				</form>
			</div>
		</div>
	</div>
</body>
</html>