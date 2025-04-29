<?php
require_once 'CLASSES/usuarios.php';
$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Projeto Login</title>
        <link rel="stylesheet" href="TelaLogin.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <header>
        <nav>
            <div class="logo-container">
                <a class="logo_img" href="index.html" ><img src="midia/chuva_branca2.png" width="72px"></a>
                <a class="logo" href="index.html" >Chuuva</a>
            </div>
            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-list">
                <li><a href="destaques.html">Destaques</a></li>
                <li><a href="jogosPC.html">Jogos Pc</a></li>
                <li><a href="jogosConsole.html">Jogos Console</a></li>
                <li><a href="jogosMobile.html">Jogos Mobile</a></li>
                <li><a href="index.php">Entrar</a></li>
            </ul>
        </nav>
    </header>
    <div id="corpo-form">
    <h1>Entrar</h1>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" maxlength="40">
        <input type="password" name="senha" placeholder="Senha" maxlength="32">
        <input type="submit" placeholder="Acessar">
        <a href="cadastrar.php">Ainda não tem uma conta? <strong>Cadastre-se</strong></a>
    </div>
    </form>



<?php

if(isset($_POST['email']))
{
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    //verificar se está preenchido
    if(!empty($email) && !empty($senha))
    {
        $u->conectar("projeto_login","localhost","root","");
        if($u->msgErro == "")
        {
        if($u->logar($email,$senha))
        {
            header("location: areaPrivada.php");
        }
        else
        {
            ?>
            <div class="msg-erro">
            <?php echo "Email e/ou senha estão incorretos!"; ?>
            </div>
            <?php
        }
        }
        else
        {
            ?>
            <div class="msg-erro>
            <?php echo "Erro: ".$u->msgErro; ?>
            </div>
            <?php

        }
    }else
    {
        ?>
        <div class="msg-erro>
        <?php echo "Preencha todos os campos!"; ?>
        </div>
        <?php
    }
}



?>



    </body>
</html>