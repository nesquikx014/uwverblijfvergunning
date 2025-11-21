<?php
$page_title = $page_title ?? 'UwVerblijfsvergunning.nl';
$body_class = isset($body_class) ? trim($body_class) : '';
$header_search_query = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?></title>
  <meta name="description" content="UwVerblijfsvergunning.nl helpt u met verblijfsvergunningen, naturalisatie en bezwaarprocedures in Nederland.">
  <link rel="stylesheet" href="css/style.css">
</head>
<body<?= $body_class !== '' ? ' class="' . htmlspecialchars($body_class, ENT_QUOTES, 'UTF-8') . '"' : ''; ?>>
<header class="site-header">
  <div class="header-inner">
    <div class="header-brand">
      <a class="logo" href="index.php">UwVerblijfsvergunning.nl</a>
      <span class="logo-tagline">Alles over uw verblijf in Nederland</span>
    </div>
    <nav class="main-nav" aria-label="Hoofdmenu">
      <a href="index.php">Home</a>
      <a href="kennisbank.php">Diensten</a>
      <a href="index.php#over">Over ons</a>
      <a href="index.php#contact">Contact</a>
      
    </nav>
    <form class="header-search" action="kennisbank.php" method="get" role="search" aria-label="Zoek in kennisbank">
      <input type="search" name="q" placeholder="Zoek Diensten" aria-label="Zoekterm" value="<?= htmlspecialchars($header_search_query, ENT_QUOTES, 'UTF-8'); ?>" />
      <button type="submit" aria-label="Zoek">
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <path d="M15.5 14h-.79l-.28-.27A6 6 0 1 0 14 15.5l.27.28v.79L20 21.5 21.5 20zm-5.5 0a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9z"/>
        </svg>
      </button>
    </form>
  </div>
</header>
<main id="main-content">
