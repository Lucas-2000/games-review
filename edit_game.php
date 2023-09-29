<?php
require_once("templates/header.php");
include_once("controllers/gameController.php");
include_once("config/connection.php");

$url = $BASE_URL . "/my_games.php";

$conn = new Connection();

$slug = "";

if (isset($_GET['slug'])) {
  $slug = $_GET['slug'];
}

$game = [];

$gameController = new GameController($conn);

$game = $gameController->findBySlug($slug);

$platforms = explode(', ', $game['platforms']);
?>

<main class="container mt-4">
  <form class="mx-auto col-md-6" action="<?= $BASE_URL ?>/process/gameProcess.php" method="POST">
    <?php
    include_once("templates/backButton.php");
    ?>
    <h1>Editando:
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
    <div class="mb-3">
      <input type="hidden" name="type" value="edit-game">
      <input type="hidden" name="id" value="<?= $game['id'] ?>">
      <input type="hidden" name="user-id" value="<?= $userId ?>">
      <label for="image" class="form-label">Url do logo</label>
      <input type="text" class="form-control" value="<?= $game['image'] ?>" id="image" name="image" placeholder="Digite o url do logo" required>
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Nome</label>
      <input type="text" class="form-control" value="<?= $game['name'] ?>" id="name" name="name" placeholder="Digite o nome do jogo" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Descrição</label>
      <textarea rows="6" type="text" class="form-control" id="description" name="description" placeholder="Digite a descrição do jogo" required><?= $game['description'] ?></textarea>
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Preço</label>
      <input type="number" class="form-control" value="<?= $game['price'] ?>" id="price" name="price" placeholder="Digite o preço do jogo" required>
    </div>
    <div class="mb-3">
      <label for="platforms" class="form-label">Plataformas</label>
      <?php
      $platformOptions = array('ps1', 'ps2', 'ps3', 'ps4', 'ps5', 'xbox360', 'xboxOne', 'xboxSeriesS', 'n64', 'gamecube', 'wii', 'wiiu', 'switch', 'gameboy', 'ds');

      $platformsWithoutSpaces = array_map('trim', $platforms);

      foreach ($platformOptions as $platformOption) {
        $isChecked = in_array($platformOption, $platformsWithoutSpaces);
        ?>
        <div>
          <input type="checkbox" class="form-check-input" id="<?= $platformOption ?>" name="platforms[]" value="<?= $platformOption ?>" <?= $isChecked ? 'checked' : '' ?>>
          <label class="form-check-label" for="<?= $platformOption ?>">
            <?= ucfirst($platformOption) ?>
          </label>
        </div>
        <?php
      }
      ?>
    </div>
    <div class="mb-3">
      <label for="release-date" class="form-label">Data de lançamento</label>
      <input type="date" class="form-control" value="<?= $game['release_date'] ?>" id="release-date" name="release-date" required />
    </div>
    <div class="mb-3">
      <label for="game-producer" class="form-label">Produtor</label>
      <input type="text" class="form-control" value="<?= $game['game_producer'] ?>" id="game-producer" name="game-producer" placeholder="Digite o produtor do jogo" required>
    </div>
    <div class="mb-3">
      <label for="classification" class="form-label">Classificação Etária</label>
      <div class="btn-group" role="group" aria-label="Classificação Etária">
        <?php
        $classificationFromDatabase = $game['classification'];

        $classificationOptions = array('+18', '+16', '+14', '+12', '+10', 'L');

        foreach ($classificationOptions as $classificationOption) {
          $isChecked = ($classificationFromDatabase == $classificationOption);
          ?>
          <input type="radio" class="btn-check" name="classification" id="classification<?= $classificationOption ?>" value="<?= $classificationOption ?>" <?= $isChecked ? 'checked' : '' ?>>
          <label class="btn btn-outline-primary" for="classification<?= $classificationOption ?>">
            <?= $classificationOption ?>
          </label>
          <?php
        }
        ?>
      </div>
    </div>

    <div class="mb-3">
      <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
  </form>
</main>

<?php
require_once("templates/footer.php");
?>