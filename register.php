<?php
require_once("templates/header.php");
$url = $BASE_URL . "/login.php";
?>

<main class="container mt-4">
  <form class="mx-auto col-md-6" action="<?= $BASE_URL ?>/process/userProcess.php" method="POST">
    <?php
    include_once("templates/backButton.php");
    ?>
    <h1>Faça seu cadastro</h1>
    <hr>
    <?php
    if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
      foreach ($_SESSION['errors'] as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
      }

      unset($_SESSION['errors']);
    }
    ?>
    <input type="hidden" name="type" value="register">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="username" class="form-control" id="username" name="username" placeholder="Digite o seu username" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Digite o seu email" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Senha</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Digite a sua senha" required>
    </div>
    <div class="mb-3">
      <label for="rePassword" class="form-label">Redigite a senha</label>
      <input type="password" class="form-control" id="rePassword" name="rePassword" placeholder="Redigite a sua senha" required>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>
</main>

<?php
require_once("templates/footer.php");
?>