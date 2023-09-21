<?php
require_once("templates/header.php");

session_start();
?>

<main class="container mt-4">
  <form class="mx-auto col-md-6">
    <h1>Faça seu login</h1>
    <hr>
    <?php
    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
      echo "<div class='alert alert-success'>" . $_SESSION['msg'] . "</div>";
    }
    unset($_SESSION['msg']);
    ?>
    <div class="mb-3">
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