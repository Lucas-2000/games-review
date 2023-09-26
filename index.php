<?php
include_once("templates/header.php");
include_once("controllers/gameController.php");
include_once("config/connection.php");

$conn = new Connection();

$games = [];

$gameController = new GameController($conn);

$games = $gameController->findAll();
?>

<main class="container mt-4">
  <h1>Veja os jogos cadastrados</h1>
  <hr>
  <div>
    <?php foreach ($games as $game): ?>
      <div class="card" style="width: 18rem;">
        <img src="<?php echo $game->getImage() ?>" class="card-img-top" alt="<?php echo $game->getName() ?>">
        <div class="card-body">
          <h5 class="card-title">
            <?php echo $game->getName() ?>
          </h5>
          <p class="card-text">
            <?php echo $game->getDescription() ?>
          </p>
          <a href="<?= $BASE_URL ?>/games?<?php echo $game->getSlug() ?>" class="btn btn-primary">Veja mais</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</main>

<?php
include_once("templates/footer.php");
?>