<?php
$page_title = $page_title ?? 'UwVerblijfsvergunning.nl';
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
<body>
<header class="site-header">
  <div class="header-inner">
    <a class="logo" href="index.php">UwVerblijfsvergunning.nl
    </a>
    <a class="minilogo" href="index.php"> Alles over uw verblijf in Nederland
</a>
    <nav class="main-nav" aria-label="Hoofdmenu">
      <a href="index.php">Home</a>
      <a href="index.php#diensten">Diensten</a>
      <a href="index.php#over">Over ons</a>
      <a href="index.php#contact">Contact</a>
      <a href="info.php?page=EUprocedure">Kennisbank</a>
    </nav>
  </div>
</header>
<main id="main-content">
