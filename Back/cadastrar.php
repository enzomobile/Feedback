<?php
    require_once 'conexao.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (empty($nome) || empty($email) || empty($senha)) {
            echo "<script>
                alert('Nome, email ou senha não definidos.');
                window.location.replace('../Front/cadastro.php');
            </script>";
            exit();
        }

        $query = "SELECT * FROM tb_users WHERE email = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                alert('Email já cadastrado.');
                window.location.replace('../Front/cadastro.php');
            </script>";
            exit();
        }

        $query = "INSERT INTO tb_users (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sss", $nome, $email, password_hash($senha, PASSWORD_DEFAULT));
            if ($stmt->execute()) {
                $stmt->close();
                $mysqli->close();
                echo "<script>
                    alert('Cadastro realizado com sucesso!');
                    window.location.replace('../Front/login.php');
                </script>";
            } else {
                $stmt->close();
                $mysqli->close();
                echo "<script>
                    alert('Erro ao cadastrar usuário.');
                    window.location.replace('../Front/cadastro.php');
                </script>";
            }
        }
    }
?>