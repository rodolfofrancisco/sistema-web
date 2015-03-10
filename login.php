<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <!-- Bootstrap -->
        <link href="bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap-3.3.2/js/bootstrap.min.js"></script>
        <!-- Css de login -->
        <link href="css/login.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <form action="servidor/login.php" method="POST">
                    <div class="col-md-offset-4 col-md-5">
                        <div class="form-login">
                            <h4>Login</h4>                                                            
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" name="login"  class="form-control " placeholder="Login" />
                            </div>
                            </br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="senha" class="form-control" placeholder="Senha" />
                            </div>
                            </br>
                            <div class="wrapper">
                                <span class="group-btn">     
                                    <?php
                                    echo isset($_GET['msg']) ? $_GET['msg'] : '';
                                    ?>
                                    <br /><br />
                                    <button type="submit" class="btn btn-primary btn-md">Acessar <i class="fa fa-sign-in"></i></button>
                                </span>
                            </div>
                            </form>
                        </div>
        </div>
    </body>
</html>
