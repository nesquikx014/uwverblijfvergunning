<?php
header('Content-Type: text/html; charset=utf-8');

$page = isset($_GET['page']) ? basename(trim($_GET['page']), '.php') : '';

$articles = [
    'EUprocedure' => [
        'title' => 'Chavez-Vilchez & EU-verblijfsrechten',
        'summary' => 'Wat betekent het arrest Chavez-Vilchez voor ouders van Nederlandse kinderen?',
        'file' => __DIR__ . '/info/EUprocedure.php',
    ],
    'gezinshereniging' => [
        'title' => 'Gezinshereniging in Nederland',
        'summary' => 'Checklist en aandachtspunten bij partner- en kindaanvragen.',
        'file' => __DIR__ . '/info/gezinshereniging.php',
    ],
    'arbeidsmigratie' => [
        'title' => 'Arbeid en ondernemersvisa',
        'summary' => 'Kennismigranten, start-ups en zelfstandigen in één overzicht.',
        'file' => __DIR__ . '/info/arbeidsmigratie.php',
    ],
    'nederlanderschap' => [
        'title' => 'Nederlanderschap & naturalisatie',
        'summary' => 'Voorwaarden, bewijsstukken en veelgestelde vragen.',
        'file' => __DIR__ . '/info/nederlanderschap.php',
    ],
    'bezwaar-beroep' => [
        'title' => 'Bezwaar en beroep tegen IND-beslissingen',
        'summary' => 'Aanpak en tijdlijn na een afwijzing of intrekking.',
        'file' => __DIR__ . '/info/bezwaar-beroep.php',
    ],
];

if ($page === '' || !isset($articles[$page])) {
    http_response_code(404);
    echo 'Pagina niet gevonden.';
    exit;
}

$article = $articles[$page];
$page_title = $article['title'] . ' | UwVerblijfsvergunning.nl';

include __DIR__ . '/header.php';
?>

<section class="section section--intro">
  <div class="container-narrow intro-wrapper">
    <h1><?= htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
    <p><?= htmlspecialchars($article['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
  </div>
</section>

<section class="section info-section">
  <div class="container-info">
    <aside class="info-menu" aria-label="Kennisbank onderwerpen">
      <h2>Meer lezen</h2>
      <ul>
        <?php foreach ($articles as $key => $item): ?>
          <?php $isCurrent = $key === $page; ?>
          <li<?= $isCurrent ? ' class="current"' : ''; ?>>
            <a href="info.php?page=<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?>">
              <?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
            <?php if ($isCurrent): ?>
              <p class="info-menu__summary"><?= htmlspecialchars($item['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </aside>
    <article class="info-content">
      <?php include $article['file']; ?>
      <div class="info-callout">
        <h2>Persoonlijk advies?</h2>
        <p>Plan een intake en wij denken met u mee over de beste route.</p>
        <a class="btn btn--primary" href="index.php#contact">Plan intake</a>
      </div>
    </article>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
