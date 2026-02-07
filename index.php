<?php
$page_title = 'nevajuristen.nl';

$contactFeedback = '';
if (isset($_GET['message'])) {
    if ($_GET['message'] === 'success') {
        $contactFeedback = 'Bedankt! We nemen binnen één werkdag contact met u op.';
    } elseif ($_GET['message'] === 'error') {
        $contactFeedback = 'Er ging iets mis bij het versturen. Mail ons rechtstreeks via info@uwverblijfsvergunning.nl.';
    }
}

include 'header.php';
?>

<section class="hero" id="hero">
  <div class="hero-overlay"></div>
  <div class="hero-inner">
    <h1>Hulp bij uw verblijfsvergunning in Nederland</h1>
    <p>Met meer dan 15 jaar ervaring in alle immigratiezaken begeleiden wij u van begin tot eind, tegen een vaste prijs.</p>
    <div class="hero-actions">
      <a class="btn btn--primary" href="contact.php">Plan een intake</a>
      <a class="btn btn--ghost" href="kennisbank.php">Lees onze diensten</a>
    </div>
  </div>
</section>

<section class="section" id="diensten">
  <div class="container">
    <h2>Wat wij voor u doen</h2>
    <p class="intro">Wat wij voor u betekenen een selectie van de begeleiding die wij dagelijks verzorgen.</p>
    <div class="grid">
      <article class="tile">
        <h3>Gezinshereniging</h3>
        <p>Uw partner, kind of gezin naar Nederland laten overkomen? Wij ondersteunen u met de juiste procedure, het verzamelen van bewijs en de MVV-aanvraag.</p>
        <a href="info.php?page=gezinshereniging">Lees meer</a>
      </article>
      <article class="tile">
        <h3>EU- en Chavez-Vilchez</h3>
        <p>EU- en Chavez-Vilchez procedures
Verblijf bij uw Nederlandse kind of een ander familielid op basis van EU-regels? Duidelijke uitleg en zorgvuldige opbouw van uw dossier.</p>
        <a href="info.php?page=EUprocedure">Lees meer</a>
      </article>
      <article class="tile">
        <h3>Arbeid &amp; ondernemerschap</h3>
        <p>Arbeid en zelfstandig ondernemerschap
Kennismigrant, start-up of zelfstandige? Wij ondersteunen bij contracten, salariszaken en IND-aanvragen.</p>
        <a href="info.php?page=arbeidsmigratie">Lees meer</a>
      </article>
      <article class="tile">
        <h3>Nederlanderschap</h3>
        <p>Voorbereiding op naturalisatie, verzamelen van documenten en begeleiding bij gemeentelijke procedures.</p>
        <a href="info.php?page=nederlanderschap">Lees meer</a>
      </article>

</div>
  </div>
</section>

<section class="section" id="over">
  <div class="container about">
    <div>
      <h2>Onze werkwijze</h2>
      <p>Wij houden de lijnen kort en duidelijk. Geen lange memo’s vol jargon, maar helderheid in vier stappen:</p>
      <ul class="work-list">
        <li>
          <strong>Intake:</strong> Een kort gesprek om uw doel vast te stellen en de benodigde documenten te verzamelen.
        </li>
        <li>
          <strong>Dossier:</strong> U ontvangt een overzichtelijke checklist; wij beoordelen uw dossier op juridische vereisten.
        </li>
        <li>
          <strong>Indienen:</strong> Wij dienen uw dossier binnen 48 uur in en houden u continu op de hoogte.
        </li>
        <li>
          <strong>Tarieven:</strong> Vaste prijzen, zodat u altijd precies weet waar u aan toe bent.
        </li>
      </ul>
    </div>
    <div>
      <img src="fotos/foto2.jpg" alt="Overleg met cliënten" loading="lazy">
</div>
  </div>
</section>
<section class="section contact-page">
  <div class="container">
    <h2>Gratis intake? Stel uw vraag, wij nemen snel contact op! </h2>
    <p class="intro">Tijdens het intakegesprek bekijken we samen uw situatie en bespreken we de stappen die nodig zijn. Zo weet u precies wat u kunt verwachten en welke documenten u eventueel moet aanleveren</p>

    <div class="contact-wrapper">
      <div class="contact-info">
        <h2>Contactgegevens</h2>
        <p class="contact-lead">Bereikbaar via telefoon, e-mail of WhatsApp.</p>
        <div class="contact-links">
          <div>
            <span>Bel ons</span>
            <a href="tel:+31297548241">+31 297 548 241</a>
            <a href="tel +31648154534">+31 648 154 534</a>
            <p class="contact-note"><strong>Openingstijden: 08:00 – 19:00</strong><br>
          </div>
          <div>
            <span>E-mail</span>
            <a href="mailto:info@nevanexis.nl">info@nevanexis.nl</a>
          </div>
        </div>
      </div>

      <form action="send-contact.php" method="POST" class="contact-form">
        <?php if ($contactFeedback): ?>
          <p class="form-feedback"><?= htmlspecialchars($contactFeedback, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <label>
          Naam
          <input type="text" name="name" required>
        </label>
        <label>
          E-mailadres
          <input type="email" name="email" required>
        </label>
        <div class="form-row">
          <label>
            Telefoon 
            <input type="tel" name="phone">
          </label>
          <label>
            Onderwerp
            <select name="topic">
              <option value="intake">Ik wil een intakegesprek plannen</option>
              <option value="second-opinion">Ik zoek een second opinion</option>
              <option value="other">Andere vraag</option>
            </select>
          </label>
        </div>
        <label>
          Uw vraag
          <textarea name="message" rows="6" required></textarea>
        </label>
        <button class="btn btn--primary" type="submit">Verstuur bericht</button>
      </form>
    </div>
  </div>
</section>


<?php include 'footer.php'; ?>
