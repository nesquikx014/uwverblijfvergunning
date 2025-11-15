<?php
header('Content-Type: text/html; charset=utf-8');

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

$categories = [];
foreach ($categoryOrder as $categoryName) {
    $categories[$categoryName] = [];
}
foreach ($articles as $key => $meta) {
    $categories[$meta['category']][] = $key;
}

$searchInputId = 'info-search';
$initialQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$articleBodies = [];
$getArticleBody = static function (string $path) use (&$articleBodies, $normalizeText): string {
    if (isset($articleBodies[$path])) {
        return $articleBodies[$path];
    }
    if (!is_readable($path)) {
        return $articleBodies[$path] = '';
    }
    $content = file_get_contents($path);
    if ($content === false) {
        return $articleBodies[$path] = '';
    }
    $text = strip_tags($content);
    $text = preg_replace('/\s+/', ' ', $text);
    return $articleBodies[$path] = trim($text);
};

$body_class = 'has-header-offset';

include __DIR__ . '/header.php';
?>

<section class="info-header">
  <div class="info-header__inner">
    <p class="info-header__eyebrow">Kennisbank</p>
    <h1>Vind snel de juiste informatie</h1>
    <p class="info-header__summary">Gebruik de zoekbalk en categorieën om het juiste onderwerp te vinden. Klik daarna op "Bekijken" om het volledige artikel te lezen.</p>
  </div>
</section>

<section class="info-overview">
  <div class="info-controls">
    <label class="info-controls__field info-controls__field--search" for="<?= htmlspecialchars($searchInputId, ENT_QUOTES, 'UTF-8'); ?>">
      <span>Zoek</span>
      <div class="info-search-box">
        <input
          type="search"
          id="<?= htmlspecialchars($searchInputId, ENT_QUOTES, 'UTF-8'); ?>"
          placeholder="Typ een trefwoord (bijv. MVV, partner, studie)"
          autocomplete="off"
          spellcheck="false"
          data-info-search
          value="<?= htmlspecialchars($initialQuery, ENT_QUOTES, 'UTF-8'); ?>"
        />
      </div>
    </label>
    <label class="info-controls__field">
      <span>Categorie</span>
      <select data-info-select>
        <option value="all">Alle categorieën</option>
        <?php foreach ($categoryOrder as $categoryName): ?>
          <option value="<?= htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8'); ?>">
            <?= htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8'); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <div class="info-controls__count">
      <strong><?= count($articles); ?></strong>
      <span>onderwerpen</span>
    </div>
  </div>

  <div class="info-list" data-info-board>
    <?php foreach ($categories as $categoryName => $articleKeys): ?>
      <?php if (empty($articleKeys)) { continue; } ?>
      <section class="info-block" data-info-group data-category="<?= htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8'); ?>">
        <header class="info-block__header">
          <h2><?= htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8'); ?></h2>
          <span><?= count($articleKeys); ?> onderwerpen</span>
        </header>
        <ul class="info-entries">
          <?php foreach ($articleKeys as $articleKey): ?>
            <?php
              $meta = $articles[$articleKey];
              $keywords = $meta['keywords'] ?? [];
              $bodyText = $getArticleBody($meta['file']);
              $searchText = $normalizeText($meta['title'] . ' ' . $meta['summary'] . ' ' . implode(' ', $keywords) . ' ' . $bodyText);
            ?>
            <li class="info-entry">
              <a
                href="info.php?page=<?= htmlspecialchars($articleKey, ENT_QUOTES, 'UTF-8'); ?>"
                data-info-entry
                data-info-category="<?= htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8'); ?>"
                data-info-text="<?= htmlspecialchars($searchText, ENT_QUOTES, 'UTF-8'); ?>"
                data-info-body="<?= htmlspecialchars($bodyText, ENT_QUOTES, 'UTF-8'); ?>"
              >
                <span class="info-entry__title"><?= htmlspecialchars($meta['title'], ENT_QUOTES, 'UTF-8'); ?></span>
                <span class="info-entry__summary"><?= htmlspecialchars($meta['summary'], ENT_QUOTES, 'UTF-8'); ?></span>
                <span class="info-entry__badge">Bekijken</span>
              </a>
              <p class="info-entry__snippet" hidden></p>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endforeach; ?>
    <p class="info-empty" data-info-empty hidden role="status">Geen onderwerpen gevonden. Pas de filters aan.</p>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
