<?php
require_once 'usuarios.php';
$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="TelaLogin.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <header>
        <nav>
            <div class="logo-container">
                <a class="logo_img" href="index.html"><img src="img/chuva_branca2.png" width="72px"></a>
                <a class="logo" href="index.html">Chuuva</a>
            </div>
            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-list">
                <li><a href="sobre.html">Sobre</a></li>
                <li class="dropdown"><a href="#"> Produtos </a>
                    <div class="dropdown-menu">
                        <a href="jogosPC.html">Jogos Pc</a>
                        <a href="jogosConsole.html">Jogos Console</a>
                        <a href="jogosMobile.html">Jogos Mobile</a>
                    </div>
                </li>
                <li><a href="novidades.html">Novidades</a></li>
                <li><a href="contato.html">Contato</a></li>
                <li><a href="index.php">Entrar</a></li>
            </ul>
        </nav>
    </header>
    <div class="container-envelopado">
  <div class="container">
    <main>
    <div class="container">
    <h1>Entrar</h1>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" maxlength="40" required>
        <input type="password" name="senha" placeholder="Senha" maxlength="32" required>
        <button type="submit">Acessar</button>
        <a href="cadastrar.php">Ainda não tem uma conta? <strong>Cadastre-se</strong></a>
    </form>
    </div>
    </main>
  </div>
</div>




<?php

// Verifica se o formulário foi enviado (campo 'email' enviado via POST)

if(isset($_POST['email']))
{

    // Pega os dados do formulário e protege contra injeção simples com addslashes

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    // Verifica se ambos os campos foram preenchidos

    if(!empty($email) && !empty($senha))
    {

        // Tenta conectar ao banco de dados usando o método conectar

        $u->conectar("projeto_login","localhost","root","");

        // Verifica se a conexão foi feita sem erro

        if($u->msgErro == "")
        {

            // Tenta fazer login com o e-mail e senha informados

        if($u->logar($email,$senha))
        {

            // Se o login for bem-sucedido, redireciona para a área privada

            header("location: areaPrivada.php");
        }
        else
        {

            // Se o login falhar, mostra mensagem de erro

            ?>
            <div class="msg-erro">
            <?php echo "Email e/ou senha estão incorretos!"; ?>
            </div>
            <?php
        }
        }
        else
        {

            // Se ocorrer erro ao conectar ao banco, mostra a mensagem de erro

            ?>
            <div class="msg-erro">
            <?php echo "Erro: ".$u->msgErro; ?>
            </div>
            <?php

        }
    }else
    {

        // Se algum campo estiver vazio, mostra mensagem de aviso

        ?>
        <div class="msg-erro">
        <?php echo "Preencha todos os campos!"; ?>
        </div>
        <?php
    }
}



?>

    </body>
</html>