<?php
    require_once 'usuarios.php';
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
    <main>
    <div class="container-envelopado">
  <div class="container">
    <div class="container">
    <h1>Cadastrar</h1>
    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuário" maxlength="30" required>
        <input type="email" name="email" placeholder="Email" maxlength="40" required>
        <input type="password" name="senha" placeholder="Senha" maxlength="32" required>
        <input type="password" name="confSenha" placeholder="confSenha" maxlength="32" required>
        <button type="submit">Cadastrar</button>
    </form>
    </div>
    </main>
  </div>
</div>


<?php

// Verifica se o formulário foi enviado (se o campo 'usuario' foi preenchido)

if(isset($_POST['usuario']))
{
    // Pega os dados do formulário e aplica addslashes para evitar injeção básica

    $usuario = addslashes($_POST['usuario']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confSenha']);

    // Verifica se todos os campos foram preenchidos

    if(!empty($usuario) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
    {
        // Tenta conectar ao banco de dados

        $u->conectar("projeto_login", "localhost", "root", "");

         // Verifica se não houve erro na conexão

        if($u->msgErro == "") //sem erros
        {

            // Verifica se as senhas coincidem

            if($senha == $confirmarSenha)
            {

                // Tenta cadastrar o usuário

                if($u->cadastrar($usuario, $email, $senha))
                {

                    // Cadastro realizado com sucesso

                    ?>
                    <div id="msg-sucesso">
                    <?php echo "Cadastrado com sucesso! Acesse para entrar!"; ?>
                    </div>
                    <?php
                }
                else
                {

                    // Email já está cadastrado

                    ?>
                    <div class="msg-erro">
                        <?php echo "Email já cadastrado!"; ?>
                    </div>
                    <?php
                }
            }
            else
            {

                // As senhas não coincidem

                ?>
                <div class="msg-erro">
                    <?php echo "Senha e confirmar senha não correspondem!"; ?>
                </div>
                <?php
            }

        }
        else
        {

            // Erro ao conectar com o banco de dados

            ?>
            <div class="msg-erro">
                <?php echo "Erro: ".$u->$msgErro; ?>
            </div>
            <?php
        }
    }else
    {

        // Algum campo não foi preenchido

        ?>
        <div class="msg-erro">
        <?php echo "Um ou mais campos não foram preenchidos!"; ?>
        </div>
        <?php
    }
}


?>












    </body>
</html>