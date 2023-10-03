<?php
require_once("templates/header.php");
include_once("controllers/gameController.php");
include_once("controllers/reviewController.php");
include_once("config/connection.php");

$url = $BASE_URL . "/index.php";

$conn = new Connection();

$slug = "";

$game = "";

$game = [];

if (isset($_GET['slug'])) {
  $slug = $_GET['slug'];

  $gameController = new GameController($conn);

  $game = $gameController->findBySlug($slug);
  if (empty($game)) {
    header("Location: " . $BASE_URL . "/index.php");
    exit();
  }
}

$reviews = [];

$reviewController = new ReviewController($conn);
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 5;
$offset = ($currentPage - 1) * $perPage;

$reviews = $reviewController->findByGameId($game['id'], $offset, $perPage);

$averageRating = $reviewController->calculateAverageRating($game['id']);

$totalReviews = $reviewController->countReviews($game['id']);
if ($totalReviews > 0) {
  $totalPages = ceil($totalReviews / $perPage);
} else {
  $totalPages = 0;
}

if ($currentPage < 1 || $currentPage > $totalPages) {
  if (empty($reviews)) {
    echo null;
  } else {
    header("Location: " . $BASE_URL . "/game.php?slug=" . $game['slug']);
    exit();
  }
}


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
        <?php if (!empty($reviews)): ?>
          <ul>
            <?php foreach ($reviews as $review): ?>
              <li>
                <strong>Nota:
                  <?php echo $review['grade']; ?>
                </strong><br>
                <?php echo $review['review']; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p>Não há avaliações disponíveis para este jogo.</p>
        <?php endif; ?>
        <h3>Avaliação média dos reviews:
          <?php echo number_format($averageRating, 2); ?>
        </h3>
        <?php if ($totalPages > 0): ?>
          <div class="pagination">
            <?php if ($currentPage > 1): ?>
              <a href="<?php echo $BASE_URL ?>/game.php?slug=<?php echo $game['slug']; ?>&page=<?php echo $currentPage - 1; ?>" class="prev prev-next">Anterior</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
              <?php if ($i == $currentPage): ?>
                <span class="current-page">
                  <?php echo $i; ?>
                </span>
              <?php else: ?>
                <a href="<?php echo $BASE_URL ?>/game.php?slug=<?php echo $game['slug']; ?>&page=<?php echo $i; ?>">
                  <?php echo $i; ?>
                </a>
              <?php endif; ?>
            <?php endfor; ?>
            <?php if ($currentPage < $totalPages): ?>
              <a href="<?php echo $BASE_URL ?>/game.php?slug=<?php echo $game['slug']; ?>&page=<?php echo $currentPage + 1; ?>" class="next prev-next">Próxima</a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <hr>
  <?php
  if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
      echo "<div class='alert alert-danger'>$error</div>";
    }

    unset($_SESSION['errors']);
  }
  ?>
  <?php
  if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['msg'] . "</div>";
  }
  unset($_SESSION['msg']);
  ?>
  <?php
  if (isset($_SESSION['user_token'])):
    ?>
    <form class="mt-3" action="<?= $BASE_URL ?>/process/reviewProcess.php" method="POST">
      <div class="mb-3">
        <h2>Faça um novo review</h2>
      </div>
      <div class="mb-3">
        <input type="hidden" name="type" value="create-review">
        <input type="hidden" name="slug" value="<?= $_GET['slug'] ?>">
        <input type="hidden" name="user-id" value="<?= $userId ?>">
        <input type="hidden" name="game-id" value="<?= $game['id'] ?>">
      </div>
      <div class="mb-3">
        <label for="review" class="form-label">Review</label>
        <textarea rows="6" type="text" class="form-control" id="review" name="review" placeholder="Digite a avaliação jogo" required></textarea>
        <p>Quantidade de caracteres digitados:
          <span id="charCount">0</span>
        </p>
      </div>
      <div class="mb-3">
        <label for="grade" class="form-label">Nota</label>
        <input type="number" class="form-control" id="grade" name="grade" placeholder="Digite a nota do jogo" required>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
  <?php else: ?>
    <div class='alert alert-danger'>Você precisa estar logado para adicionar um review.</div>
    <?php
  endif;
  ?>
</main>
<?php
require_once("templates/footer.php");
?>