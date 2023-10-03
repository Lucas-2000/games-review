<?php
require_once("templates/header.php");
include_once("controllers/gameController.php");
include_once("config/connection.php");

if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
  header('Location: index.php');
  exit;
}

$conn = new Connection();

$games = [];

$gameController = new GameController($conn);

$games = $gameController->findAll();

?>
<main class="container">
  <h1>Meus jogos</h1>
  <hr>
  <?php
  if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['msg'] . "</div>";
  }
  unset($_SESSION['msg']);
  ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Opções</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($games as $game): ?>
        <tr>
          <th scope="row">
            <?php echo $game->getId(); ?>
          </th>
          <td>
            <?php echo $game->getName(); ?>
          </td>
          <td>
            <a class="btn btn-warning" href="<?= $BASE_URL ?>/edit_game.php?slug=<?php echo $game->getSlug() ?>">Editar</a>
            <a class="btn btn-danger" href="<?= $BASE_URL ?>/delete_game.php?slug=<?php echo $game->getSlug() ?>">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>
<?php
require_once("templates/footer.php");
?>