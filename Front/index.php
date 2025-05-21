<?php
  session_start();
  if (!isset($_SESSION['nome']) || !isset($_SESSION['email'])) {
      echo "<script>
        alert('Você não está logado.');
        window.location.replace('../Front/login.php');
      </script>";
      exit();
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Bem vindo(a), <?= $_SESSION['nome']?></title>
</head>
<body>
  <div class="feedback-form">
    <h2>Envie seu Feedback</h2>

    <form id="form" action="../Back/enviar_feedback.php" method="POST">
      <label for="nota">Avaliação:</label>
      <select id="nota" name="nota" required>
        <option value="">Selecione</option>
        <option value="1">⭐</option>
        <option value="2">⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
      </select>

      <label for="comentario">Comentário:</label>
      <textarea id="comentario" name="comentario" rows="4"></textarea>

      <button type="submit">Enviar</button>
    </form> 
  </div>
</body>
</html>