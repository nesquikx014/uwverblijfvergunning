<?php
$page_title = $page_title ?? 'nevajuristen';
$body_class = isset($body_class) ? trim($body_class) : '';  
$header_search_query = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?></title>
  <meta name="description" content="info@NevaNexisJuristen.nl helpt u met verblijfsvergunningen, naturalisatie en bezwaarprocedures in Nederland.">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-sA+e2r+Yb3g0kQY0H+v8mFv1w3v5Q5x5g8g1v1u5r0M=" crossorigin="" />
</head>
<body<?= $body_class !== '' ? ' class="' . htmlspecialchars($body_class, ENT_QUOTES, 'UTF-8') . '"' : ''; ?>>
<header class="site-header">
  <div class="header-inner">
    <div class="header-brand">
      <a class="logo" href="index.php">
        <!-- logo image links back to home; stray empty anchor removed -->
        <img src="fotos/logo.png" alt="Neva Nexis Juristen." class="logo-image">
      </a>
    </div>
    <!-- mobile menu toggle -->
    <button class="menu-toggle" aria-label="Menu" aria-expanded="false" aria-controls="main-nav">
      <svg viewBox="0 0 24 24" aria-hidden="true" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 6h18M3 12h18M3 18h18" />
      </svg>
    </button>
    <nav class="main-nav" id="main-nav" aria-label="Hoofdmenu">
      <a href="index.php">Home</a>
      <a href="kennisbank.php">Diensten</a>
      <a href="Over.Ons.php">Over ons</a>
      <a href="contact.php">Contact</a>

      <!-- Move search inside nav so we can place it directly under 'Over ons' on mobile -->
      <form class="header-search" action="kennisbank.php" method="get" role="search" aria-label="Zoek in kennisbank">
        <input type="search" name="q" placeholder="Zoek Diensten" aria-label="Zoekterm" value="<?= htmlspecialchars($header_search_query, ENT_QUOTES, 'UTF-8'); ?>" />
        <button type="submit" aria-label="Zoek">
          <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
            <path d="M15.5 14h-.79l-.28-.27A6 6 0 1 0 14 15.5l.27.28v.79L20 21.5 21.5 20zm-5.5 0a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9z"/>
          </svg>
        </button>
      </form>
    </nav>
  </div>
</header>
<main id="main-content">
