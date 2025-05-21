<?php
    //Chama o banco, verifica o método de requisição, muda a nota para inteiro e insere os dados no banco.
    require_once 'conexao.php';
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['id'];

        if (empty($id)) {
            echo "<script>
                alert('Não está logado.');
                window.location.replace('../Front/index.php');
            </script>";
            exit();
        }
        $nota = isset($_POST['nota']) ? (int)$_POST['nota'] : null;

        if ($nota < 1 || $nota > 5) {
            echo "<script>
                alert('Nota inválida.');
                window.location.replace('../Front/index.php');
            </script>";
            exit();
        }

        $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : null;
        $comentario = trim($comentario) === '' ? null : $comentario;

        //Verifica se o usuário já enviou um comentário ou nota
        $select = "SELECT id FROM tb_feedback WHERE id_user = ?";
        $stmt = $mysqli->prepare($select);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            $mysqli->close();
            echo "<script>
                alert('Você já enviou um feedback.');
                window.location.replace('../Front/index.php');
            </script>";
            exit();
        }

        $query = "INSERT INTO tb_feedback (id_user, nota, comentario) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        if ($stmt) {
            $stmt->bind_param("iis", $id, $nota, $comentario);
            if ($stmt->execute()) {
                $stmt->close();
                $mysqli->close();
                echo "<script>
                    alert('Comentário enviado!');
                    window.location.replace('../Front/index.php');
                </script>";
            } else {
                $stmt->close();
                $mysqli->close();
                echo "<script>
                    alert('Erro ao enviar comentário.');
                    window.location.replace('../Front/index.php');
                </script>";
            }
        }
    }
?>