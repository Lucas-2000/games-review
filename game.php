<?php
require_once("templates/header.php");
include_once("controllers/gameController.php");
include_once("config/connection.php");

$url = $BASE_URL . "/index.php";

$conn = new Connection();

$slug = "";

if (isset($_GET['slug'])) {
  $slug = $_GET['slug'];
}

$game = [];

$gameController = new GameController($conn);

$game = $gameController->findBySlug($slug);
?>

<main class="container">
  <?php
  include_once("templates/backButton.php");
  ?>
  <h1>Reviews do jogo:
    <?php echo $game['name'] ?>
  </h1>
  <hr>
  <div>
    <div class="row">
      <div class="col-md-4">
        <img src="<?php echo $game['image'] ?>" alt="<?php echo $game['name'] ?>" class="img-fluid">
      </div>
      <div class="col-md-8">
        <h3>Alguns reviews:</h3>
        <h3>Avaliação média reviews:</h3>
      </div>
    </div>
  </div>
  <hr>
  <form class="mt-3" action="<?= $BASE_URL ?>/process/reviewProcess.php" method="POST">
    <div class="mb-3">
      <h2>Faça um novo review</h2>
    </div>
    <div class="mb-3">
      <input type="hidden" name="type" value="create-review">
      <input type="hidden" name="user-id" value="<?= $userId ?>">
      <input type="hidden" name="game-id" value="<?= $game['id'] ?>">
    </div>
    <div class="mb-3">
      <label for="review" class="form-label">Review</label>
      <textarea rows="6" type="text" class="form-control" id="review" name="review" placeholder="Digite a avaliação jogo" required></textarea>
    </div>
    <div class="mb-3">
      <label for="grade" class="form-label">Nome</label>
      <input type="number" class="form-control" id="grade" name="grade" placeholder="Digite a nota do jogo" required>
    </div>
    <div class="mb-3">
      <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
  </form>
</main>

<?php
require_once("templates/footer.php");
?>