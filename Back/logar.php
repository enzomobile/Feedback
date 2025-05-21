<?php
    require_once 'conexao.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (empty($email) || empty($senha)) {
            echo "<script>
                alert('Email ou senha não definidos.');
                window.location.replace('../Front/index.php');
            </script>";
            exit();
        }

        $query = "SELECT * FROM tb_users WHERE email = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($senha, $user['senha'])) {
                session_start();
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['id'];
                $stmt->close();
                $mysqli->close();
                echo "<script>
                    alert('Login realizado com sucesso!');
                    window.location.replace('../Front/index.php');
                </script>";
            } else {
                $stmt->close();
                $mysqli->close();
                echo "<script>
                    alert('Senha incorreta.');
                    window.location.replace('../Front/login.php');
                </script>";
            }
        } else {
            $stmt->close();
            $mysqli->close();
            echo "<script>
                alert('Email não cadastrado.');
                window.location.replace('../Front/login.php');
            </script>";
        }
    }
?>