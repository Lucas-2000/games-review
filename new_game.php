<?php
require_once("templates/header.php");


?>

<main class="container mt-4">
  <form class="mx-auto col-md-6" action="<?= $BASE_URL ?>/process/gameProcess.php" method="POST">
    <h1>Cadastrar um novo jogo</h1>
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
      <input type="hidden" name="type" value="create-game">
      <input type="hidden" name="user-id" value="<?= $userId ?>">
      <label for="image" class="form-label">Url do logo</label>
      <input type="text" class="form-control" id="image" name="image" placeholder="Digite o url do logo" required>
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Nome</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do jogo" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Descrição</label>
      <textarea rows="6" type="text" class="form-control" id="description" name="description" placeholder="Digite a descrição do jogo" required></textarea>
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Preço</label>
      <input type="number" class="form-control" id="price" name="price" placeholder="Digite o preço do jogo" required>
    </div>
    <div class="mb-3">
      <label for="platforms" class="form-label">Plataformas</label>
      <div>
        <input type="checkbox" class="form-check-input" id="ps1" name="platforms[]" value="ps1">
        <label class="form-check-label" for="ps1">PS1</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="ps2" name="platforms[]" value="ps2">
        <label class="form-check-label" for="ps2">PS2</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="ps3" name="platforms[]" value="ps3">
        <label class="form-check-label" for="ps3">PS3</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="ps4" name="platforms[]" value="ps4">
        <label class="form-check-label" for="ps4">PS4</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="ps5" name="platforms[]" value="ps5">
        <label class="form-check-label" for="ps5">PS5</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="xbox360" name="platforms[]" value="xbox360">
        <label class="form-check-label" for="xbox360">Xbox 360</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="xboxOne" name="platforms[]" value="xboxOne">
        <label class="form-check-label" for="xboxOne">Xbox One</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="xboxSeriesS" name="platforms[]" value="xboxSeriesS">
        <label class="form-check-label" for="xboxSeriesS">Xbox Series S</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="n64" name="platforms[]" value="n64">
        <label class="form-check-label" for="n64">Nintendo 64</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="gamecube" name="platforms[]" value="gamecube">
        <label class="form-check-label" for="gamecube">Nintendo GameCube</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="wii" name="platforms[]" value="wii">
        <label class="form-check-label" for="wii">Wii</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="wiiu" name="platforms[]" value="wiiu">
        <label class="form-check-label" for="wiiu">Wii U</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="switch" name="platforms[]" value="switch">
        <label class="form-check-label" for="switch">Nintendo Switch</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="gameboy" name="platforms[]" value="gameboy">
        <label class="form-check-label" for="gameboy">Game Boy</label>
      </div>
      <div>
        <input type="checkbox" class="form-check-input" id="ds" name="platforms[]" value="ds">
        <label class="form-check-label" for="ds">Nintendo DS</label>
      </div>
    </div>
    <div class="mb-3">
      <label for="release-date" class="form-label">Data de lançamento</label>
      <input type="date" class="form-control" id="release-date" name="release-date" required />
    </div>
    <div class="mb-3">
      <label for="game-producer" class="form-label">Produtor</label>
      <input type="text" class="form-control" id="game-producer" name="game-producer" placeholder="Digite o produtor do jogo" required>
    </div>
    <div class="mb-3">
      <label for="classification" class="form-label">Classificação Etária</label>
      <div class="btn-group" role="group" aria-label="Classificação Etária">
        <input type="radio" class="btn-check" name="classification" id="classification18" value="+18">
        <label class="btn btn-outline-primary" for="classification18">+18</label>

        <input type="radio" class="btn-check" name="classification" id="classification16" value="+16">
        <label class="btn btn-outline-primary" for="classification16">+16</label>

        <input type="radio" class="btn-check" name="classification" id="classification14" value="+14">
        <label class="btn btn-outline-primary" for="classification14">+14</label>

        <input type="radio" class="btn-check" name="classification" id="classification12" value="+12">
        <label class="btn btn-outline-primary" for="classification12">+12</label>

        <input type="radio" class="btn-check" name="classification" id="classification10" value="+10">
        <label class="btn btn-outline-primary" for="classification10">+10</label>

        <input type="radio" class="btn-check" name="classification" id="classificationL" value="L">
        <label class="btn btn-outline-primary" for="classificationL">L</label>
      </div>
    </div>
    <div class="mb-3">
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
  </form>
</main>

<?php
require_once("templates/footer.php");
?>