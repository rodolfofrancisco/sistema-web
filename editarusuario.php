<?php
require_once("servidor/conexao.php");
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

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Edição de Usuários</title> 
        <!-- Bootstrap -->
	<link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/datepicker.css" rel="stylesheet">
        <!-- Css de admin -->
	<link href="css/admin.css" rel="stylesheet"> 
	
	
        <!-- Scripts js -->
        <script src="Scripts/jquery-1.11.2.js"></script>         
        <script src="bootstrap-3.3.2/js/bootstrap.min.js"></script> 
        <script src="Scripts/bootstrap-datepicker.js"></script> 
        <script src="Scripts/bootstrap-datepicker.pt-BR.js"></script> 
        <script src="Scripts/jquery.mask.js"></script> 	
</head>
<body>      
	<div class="container content">
		<div class="span10 offset1">
			<div class="row">
				<h3>Edição de Usuários</h3>
			</div>
			<div class="span10 offset1">
				<?php
				if (isset($_GET['id'])) {
					$sql = "SELECT * FROM usuario WHERE id = '".$_GET['id']."'";
	                $result = mysqli_query($conexao, $sql, $field=0);
	                if (mysqli_num_rows($result) > 0) {
	                    while($row = mysqli_fetch_assoc($result)) { ?>
							<form class="form-horizontal" action="servidor/editarusuario.php" method="post">    
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
												<input type="text" name="nome" value="<?php echo $row['nome']; ?>"/>  
												<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
											</div>
										</div>                 
										<div class="control-group">
											<label class="control-label" for="email">Email </label>
											<div class="controls">
												<input type="email" name="email" value="<?php echo $row['email']; ?>"/>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="datanasc">Data de Nascimento </label>
											<div class="controls">
												<input class="datepicker" type="text" name="datanasc" value="<?php echo $row['datanasc']; ?>"/>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="telefone">Telefone </label>
											<div class="controls">
												<input class="telefone" type="text" name="telefone" value="<?php echo $row['telefone']; ?>"/>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="sexo">Sexo </label>
											<div class="controls">               
												<input type="radio" name="sexo" value="M" <?php echo $row['sexo'] == 'M' ? 'checked' : ''; ?> />Masculino
												<input type="radio" name="sexo" value="F" <?php echo $row['sexo'] == 'F' ? 'checked' : ''; ?> />Feminino               
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="privilegio">Privilégio </label>
											<div class="controls">               
												<select name ="privilegio">
													<option value = "">Selecione</option>
													<option value = "1" <?php echo $row['acesso'] == '1' ? 'selected' : ''; ?> >Admin</option>
													<option value = "2" <?php echo $row['acesso'] == '2' ? 'selected' : ''; ?>>Usuario</option>
												</select>               
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="grupo">Grupo de Estudos </label>
											<div class="controls">
												<?php
												$sql = "SELECT * FROM grupo"; 

												$result = mysqli_query($conexao, $sql, $field=0);
												?>
												<select name='grupo'>
													<option value=''>Selecione</option>
													<?php

													if (mysqli_num_rows($result) > 0) {
														while($grupo = mysqli_fetch_assoc($result)) {
														?>
														<option value="<?php echo $grupo['codigo']; ?>" <?php echo $row['codigogrupo'] == $grupo['codigo'] ? 'selected' : ''; ?>> 
															<?php echo $grupo['nome']; ?>
														</option>
													<?php
														}
													}
													?>
												</select>
												<?php
												mysqli_close($conexao);
												?>   
											</div>
										</div>  
										<div class="control-group">
											<label class="control-label" for="login">Login </label>
											<div class="controls">
												<input type="text" name="login" value="<?php echo $row['login']; ?>"/>
											</div>
										</div>  
										<div class="control-group">
											<label class="control-label" for="senha">Senha </label>
											<div class="controls">
			                                   <input type="password" name="senha"/>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="confsenha"> Confirmação de Senha </label>
											<div class="controls">
			                                    <input type="password" name="confsenha"/>
											</div>
										</div>  
									</fieldset> 
								</div>
								<div class="form-actions">
									<input type="submit" value="Enviar" class= "btn btn-success"/>
									<a class = "btn btn-default" href="admin.php">Voltar</a>  
								</div>      
							</form>
						<?php       
	                    }
                    }
                }
                ?>
			</div>
		</div>
	</div>
</body>

<footer>
    
    <script>
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR",
            clearBtn: true,
            todayBtn: true,
            autoclose: true,
            todayHighlight: true,
            orientation: "auto"            
        });
        
        $('.telefone').mask("(99) 9999-9999");
    </script> 
    
</footer>

</html>