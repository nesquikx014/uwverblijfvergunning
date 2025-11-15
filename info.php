<?php
header('Content-Type: text/html; charset=utf-8');

$page = isset($_GET['page']) ? basename(trim($_GET['page']), '.php') : '';

$infoData = require __DIR__ . '/info-data.php';
$articles = $infoData['articles'];
$categoryOrder = $infoData['categoryOrder'];

$normalizeText = static function (string $text): string {
    $text = preg_replace('/\s+/', ' ', trim($text));
    if (function_exists('mb_strtolower')) {
        return mb_strtolower($text, 'UTF-8');
    }
    return strtolower($text);
};

if ($page === '' || !isset($articles[$page]) || !is_readable($articles[$page]['file'])) {
    http_response_code(404);
    echo 'Pagina niet gevonden.';
    exit;
}

$currentArticle = $articles[$page];
$currentCategory = $currentArticle['category'];

$categories = [];
foreach ($categoryOrder as $categoryName) {
    $categories[$categoryName] = [];
}
foreach ($articles as $key => $meta) {
    $categories[$meta['category']][] = $key;
}

$body_class = 'has-header-offset';

include __DIR__ . '/header.php';
?>

<section class="info-article-head">
  <div class="info-article-head__inner">
    <p class="info-article-head__eyebrow">Artikel</p>
    <h1><?= htmlspecialchars($currentArticle['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <p><?= htmlspecialchars($currentArticle['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
    <div class="info-article-head__actions">
      <a class="btn btn--outline" href="kennisbank.php">Terug naar kennisbank</a>
    </div>
  </div>
</section>

<section class="info-article">
  <div class="info-article__inner">
    <p class="info-article__label"><?= htmlspecialchars($currentCategory, ENT_QUOTES, 'UTF-8'); ?> · <?= htmlspecialchars((string) count($categories[$currentCategory]), ENT_QUOTES, 'UTF-8'); ?> onderwerpen</p>
    <h2><?= htmlspecialchars($currentArticle['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
    <p class="info-article__summary"><?= htmlspecialchars($currentArticle['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
    <div class="info-article__body">
      <?php include $currentArticle['file']; ?>
    </div>
    <div class="info-callout">
      <h2>Persoonlijk advies?</h2>
      <p>Plan een intake en wij denken met u mee over de beste route.</p>
      <a class="btn btn--primary" href="index.php#contact">Plan intake</a>
    </div>
    <div class="info-article__nav">
      <a class="btn btn--outline" href="kennisbank.php">Terug naar kennisbank</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
