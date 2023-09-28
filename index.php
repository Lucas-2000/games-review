<?php
include_once("templates/header.php");
include_once("controllers/gameController.php");
include_once("config/connection.php");

$conn = new Connection();

$games = [];

$gameController = new GameController($conn);

$games = $gameController->findAll();
?>

<main class="container">
  <h1>Veja os jogos cadastrados</h1>
  <hr>
  <div class="row">
    <form action="GET" class="mt-3 mb-3">
      <div class="input-group">
        <input type="text" class="form-control" name="search-games" id="search-games" placeholder="Pesquise um jogo">
        <div class="input-group-append">
          <input class="btn btn-primary" type="submit" value="Pesquisar">
        </div>
      </div>
    </form>
  </div>
  <?php
  if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['msg'] . "</div>";
  }
  unset($_SESSION['msg']);
  ?>
  <div class="row">
    <?php foreach ($games as $game): ?>
      <div class="col-md-4 mb-4">
        <div class="card d-flex flex-column h-100">
          <img src="<?php echo $game->getImage() ?>" class="card-img-top game-image" alt="<?php echo $game->getName() ?>">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">
              <?php echo $game->getName() ?>
            </h5>
            <p class="card-text" style="max-height: 100px; overflow: hidden;">
              <?php echo $game->getDescription() ?>
            </p>
            <div class="mt-auto">
              <a href="<?= $BASE_URL ?>/games?<?php echo $game->getSlug() ?>" class="btn btn-primary">Veja mais</a>
            </div>
          </div>
        </div>
      </div>

    <?php endforeach; ?>
  </div>
</main>


<?php
include_once("templates/footer.php");
?>