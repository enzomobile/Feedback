<?php
    //Chama o banco, verifica o método de requisição, muda a nota para inteiro e insere os dados no banco.
    require_once 'conexao.php';
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_SESSION['nome'];
        $email = $_SESSION['email'];
        if (empty($nome) || empty($email)) {
            echo "<script>
                alert('Nome ou email não definidos.');
                window.history.back();
            </script>";
            exit();
        }
        $nota = $_POST['nota'];
        $comentario = $_POST['comentario'];

        $avaliacao = (int)$nota; //String para inteiro.

        $query = "INSERT INTO tb_feedback (nome, email, nota, comentario) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        if ($stmt) {
            $comentario = trim($comentario) === '' ? null : $comentario;
            $stmt->bind_param("ssis", $nome, $email, $avaliacao, $comentario);
            if ($stmt->execute()) {
                echo "<script>
                    alert('Comentário enviado!');
                    window.history.back();
                </script>";
            } else {
                echo "<script>
                    alert('Erro ao enviar comentário.');
                    window.history.back();
                </script>";
            }
        }
    }
?>