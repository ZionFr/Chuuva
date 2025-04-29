<?php

class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($usuario, $email, $senha)
    {
        global $pdo;
        
        // Verificar se já existe o email cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false; // Já está cadastrado
        } else {
            // Caso não, cadastrar
            $sql = $pdo->prepare("INSERT INTO usuarios (usuario, email, senha) VALUES (:u, :e, :s)");
            $sql->bindValue(":u", $usuario);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true; // Cadastrado com sucesso
        }
    }

    public function logar($email, $senha)
    {
        global $pdo;

        // Verificar se o email e senha estão cadastrados
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email); // <- Faltava ; aqui
        $sql->bindValue(":s", md5($senha)); // <- Faltava ; aqui
        $sql->execute();

        if ($sql->rowCount() > 0) {
            // Entrar no sistema (sessão)
            $dado = $sql->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; // Logado com sucesso
        } else {
            return false; // Não foi possível logar
        }
    }
}
?>
