<?php
    session_start();
    if (!isset($_SESSION['Usuario']) || !isset($_COOKIE["logado"])) {
        header("Location: login.php");
    }

    setcookie("logado", 'ok', time()+60, "/");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
        <link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap-3.3.2/js/jquery-1.11.2.min.js"></script>
        <script src="bootstrap-3.3.2/js/bootstrap.min.js"></script>
        <style>
            .bs-file {
                margin-right: 0;
                margin-left: 0;
                background-color: #fff;
                border-color: #ddd;
                border-width: 1px;
                border-radius: 4px 4px 0 0;
                box-shadow: none;
                position: relative;
                padding: 45px 15px 15px;
                border-style: solid;
                clear: both;
                top: 25px;
            }
            .bs-file:after {
                position: absolute;
                top: 15px;
                left: 15px;
                font-size: 12px;
                font-weight: 700;
                color: #959595;
                text-transform: uppercase;
                letter-spacing: 1px;
                content: "COmpartilhamento de Aequivos";
            }
            .bs-table {
                margin-top: 65px;
                clear: both;
            }
            .bs-alert {
                top: 20px;
            }
            .content {
                margin: 0 auto;
                width: 960px;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <h1>Compartilhamento de Arquivos</h1>
            <?php 
            $usuario = array();
            if (isset($_SESSION['Usuario'])) {
                $usuario = $_SESSION['Usuario'];
            }
            ?>
            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert alert-info alert-dismissible bs-alert col-md-6" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $_GET['msg']; ?>
                </div>
            <?php endif; ?>
            <div class="bs-file row col-md-6" data-example-id="basic-forms">
                <form action="servidor/upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputFile">Arquivo</label>
                        <input type="file" id="inputFile" name="inputFile">
                    </div>
                    <input type="submit" class="btn btn-default" name="submit" value="Enviar">
                </form>
            </div>
            <div class="row col-md-12 bs-table">
                <table class="table table table-striped table table-bordered">
                    <thead>
                        <tr>
                            <th class="col-md-10">Arquivo</th>
                            <th class="col-md-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conexao = mysqli_connect('localhost', 'root', '', 'SistemaWeb');
                        if ($conexao) {
                                $sql = "SELECT * FROM recurso WHERE codigogrupo = '".$usuario['codigogrupo']."' ORDER BY id ASC";
                                $result = mysqli_query($conexao, $sql, $field=0);
                                if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $array = explode('/', $row['caminho']);
                                            $fileName = array_pop($array);
                                                echo 
                                                "<tr>
                                                        <td>".$fileName."</td>
                                                        <td>";
                                                if ($usuario['id'] == $row['idusuario']) {
                                                    echo 
                                                            "<a href=\"servidor/file.php?id=".$row['id']."\" class=\"btn btn-danger btn-xs\" title=\"deletar\" onclick=\"return confirm('Você deseja realmente deletar este item?')\" style=\"margin-right: 5px;\">
                                                                <span class=\"glyphicon glyphicon-remove\"></span>
                                                            </a>";
                                                }
                                                echo
                                                            "<a href=\"servidor/download.php?file=".$row['caminho']."\" class=\"btn btn-success btn-xs\" title=\"download\">
                                                                <span class=\"glyphicon glyphicon-download-alt\"></span>
                                                            </a>
                                                        </td>
                                                </tr>";
                                        }
                                } else {
                                    echo 
                                    "<tr>
                                        <td colspan=\"2\">Nenhum registro encontrado.</td>
                                    </tr>";
                                }
                                mysqli_close($conexao);
                        } else {
                            echo 
                                "<tr>
                                    <td colspan=\"2\">Nenhum registro encontrado.</td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>