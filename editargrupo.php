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
    <title>Edição de Grupos</title>  
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
                        <h3>Edição de Grupos</h3>
                </div>
                <div class="span10 offset1">
                <?php
                if (isset($_GET['id'])) {
                    $conexao = mysqli_connect('localhost', 'root', '', 'SistemaWeb');
                    if ($conexao) {
                        $sql = "SELECT * FROM grupo WHERE codigo = '".$_GET['id']."'";
                        $result = mysqli_query($conexao, $sql, $field=0);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) { ?>
                                <form class="form-horizontal" action="servidor/editargrupo.php" method="post">    
                                    <div class="well">
                                        <?php
                                        $cor = '';
                                        if (isset($_GET['status'])) {
                                            if ($_GET['status'] == 1) {
                                                $cor = "red";
                                            } else {
                                                $cor = "green";
                                            }
                                        }
                                        ?>
                                        <div class="msgerro <?php echo $cor; ?>">
                                            <?php echo isset($_GET['msg']) ? $_GET['msg'] : ''; ?>
                                        </div>
                                        <fieldset>                 
                                            <div class="control-group">
                                                <label class="control-label" for="nome">Nome </label>   
                                                <div class="controls">
                                                    <input type="text" name="nome" value="<?php echo $row['nome']; ?>">  
                                                    <input type="hidden" name="id" value="<?php echo $row['codigo']; ?>">
                                                </div>
                                            </div>                 
                                            <div class="control-group">
                                                <label class="control-label" for="tipo">Tipo</label>
                                                <div class="controls">               
                                                    <select name ="tipo" value="<?php echo $row['tipo']; ?>">
                                                        <option value = "">Selecione</option>
                                                        <option value = "Ensino Fundamental" <?php echo (utf8_encode($row['tipo']) == 'Ensino Fundamental') ? 'selected' : ''; ?>>Ensino Fundamental</option>
                                                        <option value = "Ensino Médio" <?php echo (utf8_encode($row['tipo']) == 'Ensino Médio') ? 'selected' : ''; ?>>Ensino Médio</option>
                                                        <option value = "Graduação" <?php echo (utf8_encode($row['tipo']) == 'Graduação') ? 'selected' : ''; ?>>Graduação</option>
                                                        <option value = "Pós Graduação" <?php echo (utf8_encode($row['tipo']) == 'Pós Graduação') ? 'selected' : ''; ?>>Pós Graduação</option>
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
                <?php       }
                        }
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </body>
</html>