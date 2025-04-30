<?php

// Declaração da classe Usuario
class Usuario
{
    // Atributo privado para armazenar a conexão com o banco
    private $pdo;

    // Atributo público para armazenar mensagens de erro (caso ocorram)
    public $msgErro = "";

    // Método para conectar ao banco de dados
    public function conectar($nome, $host, $usuario, $senha)
    {
        // Declara as variáveis globais para poder usar fora da função
        global $pdo;
        global $msgErro;

        try {
            // Tenta fazer a conexão com o banco usando PDO
            $pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $usuario, $senha);
        } catch (PDOException $e) {
            // Se der erro, salva a mensagem de erro
            $msgErro = $e->getMessage();
        }
    }

    // Método para cadastrar um novo usuário
    public function cadastrar($usuario, $email, $senha)
    {
        global $pdo;

        // Verifica se já existe um usuário com o mesmo e-mail
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            // Se encontrou, retorna falso (não cadastra)
            return false;
        } else {
            // Se não encontrou, cadastra o novo usuário
            $sql = $pdo->prepare("INSERT INTO usuarios (usuario, email, senha) VALUES (:u, :e, :s)");
            $sql->bindValue(":u", $usuario);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha)); // A senha é criptografada com MD5 (não é o mais seguro)
            $sql->execute();
            return true; // Cadastro feito com sucesso
        }
    }

    // Método para login de usuário
    public function logar($email, $senha)
    {
        global $pdo;

        // Verifica se existe um usuário com esse e-mail e senha
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email); // Passa o valor do e-mail
        $sql->bindValue(":s", md5($senha)); // Passa o valor da senha criptografada
        $sql->execute();

        if ($sql->rowCount() > 0) {
            // Se encontrou, pega os dados do usuário
            $dado = $sql->fetch(PDO::FETCH_ASSOC);

            // Inicia a sessão e salva o ID do usuário
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];

            return true; // Login realizado com sucesso
        } else {
            return false; // E-mail ou senha incorretos
        }
    }
}
?>
