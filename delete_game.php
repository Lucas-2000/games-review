<?php
require_once("templates/header.php");
include_once("controllers/gameController.php");
include_once("config/connection.php");

if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
  header('Location: index.php');
  exit;
}

$url = $BASE_URL . "/my_games.php";

$conn = new Connection();

$slug = "";

if (isset($_GET['slug'])) {
  $slug = $_GET['slug'];
}

$game = [];

$gameController = new GameController($conn);

$game = $gameController->findBySlug($slug);

?>

<main class="container mt-4">
  <form action="<?= $BASE_URL ?>/process/gameProcess.php" method="POST">
    <?php
    include_once("templates/backButton.php");
    ?>
    <h1>Deletar o jogo:
      <?php echo $game['name'] ?>
    </h1>
    <hr>
    <?php
    if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
      foreach ($_SESSION['errors'] as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
      }

      unset($_SESSION['errors']);
    }
    ?>
    <p>Tem certeza que deseja deletar o jogo?</p>
    <div class="mb-3">
      <input type="hidden" name="type" value="delete-game">
      <input type="hidden" name="id" value="<?= $game['id'] ?>">
      <button type="submit" class="btn btn-danger">Deletar</button>
      <a href="<?php echo $url ?>" class="btn btn-primary">Voltar</a>
    </div>
  </form>
</main>
<?php
require_once("templates/footer.php");
?>