<?php
require_once("templates/header.php");
?>

<main class="container mt-4">
  <form class="mx-auto col-md-6" action="<?= $BASE_URL ?>/process/userProcess.php" method="POST">
    <h1>Faça seu login</h1>
    <hr>
    <?php
    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
      echo "<div class='alert alert-success'>" . $_SESSION['msg'] . "</div>";
    }
    unset($_SESSION['msg']);
    ?>
    <?php
    if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
      foreach ($_SESSION['errors'] as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
      }

      unset($_SESSION['errors']);
    }
    ?>
    <div class="mb-3">
      <input type="hidden" name="type" value="login">
      <label for="username" class="form-label">Username</label>
      <input type="username" class="form-control" id="username" name="username" placeholder="Digite o seu username" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Senha</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Digite a sua senha" required>
    </div>
    <p>
      Não possui conta?
      <a href="<?= $BASE_URL ?>/register.php">Clique aqui para registrar</a>
    </p>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</main>

<?php
require_once("templates/footer.php");
?>