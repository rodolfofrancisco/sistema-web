<?php
$conexao = mysqli_connect('localhost', 'root', '', 'SistemaWeb');

if (!$conexao) {
    header("Location: ../index.php?msg=Erro: ".mysqli_error());
} else {
    $sql = "SELECT * FROM recurso WHERE id = '".$_GET['id']."'";
    $result = mysqli_query($conexao, $sql, $field=0);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $sql = "DELETE FROM recurso WHERE id = '".$row['id']."'";
            if (mysqli_query($conexao, $sql)) {
                unlink($row['caminho']);
                header("Location: ../index.php?msg=Arquivo deletado com sucesso!");
            } else {
                header("Location: ../index.php?msg=Erro: ".$sql." ".mysqli_error($conexao));
            }
        }
    }
            
    mysqli_close($conexao);
}