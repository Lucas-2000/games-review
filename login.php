<?php
require_once("templates/header.php");
?>

<main class="container mt-4">
  <form class="mx-auto col-md-6">
    <h1>Faça seu login</h1>
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="username" class="form-control" id="username" name="username" placeholder="Digite o seu username">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Senha</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Digite a sua senha">
    </div>
    <p>
      Não possui conta?
      <a href="<?= $BASE_URL ?>/register.php">Clique aqui para registrar</a>
    </p>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</main>

<?php
require_once("templates/footer.php");
?>