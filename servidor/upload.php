<?php
session_start();
$usuario = array();
$codgrupo = '';
$idusuario = '';

if (isset($_SESSION['Usuario'])) {
    $usuario = $_SESSION['Usuario'];
    $codigogrupo = $usuario['codigogrupo'];
    $idusuario = $usuario['id'];
}

$target_dir = '/wamp/www/sistema-web/uploads/';
$target_file = $target_dir . basename($_FILES['inputFile']['name']);

$uploadOk = 1; $msg = '';

if ($_FILES["inputFile"]["size"] > 3000000) {
    $msg = "O arquivo deve ser menor que 3 mb.";
    $uploadOk = 0;
}

if (file_exists($target_file)) {
    $msg = "Arquivo já existe!";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    header("Location: ../index.php?msg=".$msg);
} else {
    if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $target_file)) {
        $conexao = mysqli_connect('localhost', 'root', '', 'SistemaWeb');
        if (!$conexao) {
            die('Erro ao conectar com o Banco de Dados: '.mysql_error());
        } else {
            $query = "INSERT INTO recurso (caminho, codigogrupo, idusuario) VALUES ('$target_file', '$codigogrupo', '$idusuario')";
            if (mysqli_query($conexao, $query)) {
                    header("Location: ../index.php?msg=Arquivo compartilhado com sucesso!");
            } else {
                    header("Location: ../index.php?msg=Erro: ".$sql." ".mysqli_error($conexao));
            }
            mysqli_close($conexao);
        }
    } else {
        header("Location: ../index.php?msg=Ops! houve um erro ao enviar o arquivo.");
    }
}