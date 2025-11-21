<?php
$page_title = 'UwVerblijfsvergunning.nl';

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
    <p>Meer dan 18 jaar ervaring met gezinshereniging, EU-rechten, arbeid en naturalisatie. We leggen uit wat nodig is en begeleiden u stap voor stap.</p>
    <div class="hero-actions">
      <a class="btn btn--primary" href="contact.php">Plan een intake</a>
      <a class="btn btn--ghost" href="kennisbank.php">Lees onze uitleg</a>
    </div>
  </div>
</section>

<section class="section" id="diensten">
  <div class="container">
    <h2>Wat wij voor u doen</h2>
    <p class="intro">Een kleine selectie van trajecten die wij dagelijks begeleiden.</p>
    <div class="grid">
      <article class="tile">
        <h3>Gezinshereniging</h3>
        <p>Partner, kind of gezin naar Nederland halen. Wij helpen met checklist, bewijs en MVV-aanvraag.</p>
        <a href="info.php?page=gezinshereniging">Lees meer</a>
      </article>
      <article class="tile">
        <h3>EU- en Chavez-Vilchez</h3>
        <p>Verblijf bij uw Nederlandse kind of partner binnen de EU-regels. Praktische uitleg en dossieropbouw.</p>
        <a href="info.php?page=EUprocedure">Lees meer</a>
      </article>
      <article class="tile">
        <h3>Arbeid &amp; ondernemerschap</h3>
        <p>Kennismigrant, start-up of zelfstandige. We kijken mee met contracten, salaris en IND-indiening.</p>
        <a href="info.php?page=arbeidsmigratie">Lees meer</a>
      </article>
      <article class="tile">
        <h3>Nederlanderschap</h3>
        <p>Voorbereiding op naturalisatie, documenten verzamelen en meekijken met de gemeente.</p>
        <a href="info.php?page=nederlanderschap">Lees meer</a>
      </article>
      <article class="tile">
        <h3>Bezwaar en beroep</h3>
        <p>Afwijzing ontvangen? We beoordelen de beslissing en dienen binnen de termijn bezwaar in.</p>
        <a href="info.php?page=bezwaar-beroep">Lees meer</a>
      </article>
          </div>
  </div>
</section>

<section class="section" id="over">
  <div class="container about">
    <div>
      <h2>Onze werkwijze</h2>
      <p>We werken in kleine teams en houden de lijnen kort. Geen memo’s vol jargon, maar duidelijkheid in vier stappen.</p>
      <ul class="work-list">
        <li>
          <strong>Intake:</strong> een kort gesprek waarin we uw doel bepalen en de benodigde bewijsstukken opvragen.
        </li>
        <li>
          <strong>Dossier:</strong> u ontvangt een checklist; wij beoordelen het dossier op juridische eisen.
        </li>
        <li>
          <strong>Indienen:</strong> we dienen digitaal in, monitoren de termijnen en houden u op de hoogte.
        </li>
        <li>
          <strong>Tarieven:</strong> vaste prijsafspraken, zodat u precies weet waar u aan toe bent.
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
    <h1>Contact</h1>
    <p class="intro">Vul onderstaand formulier in en wij nemen zo snel mogelijk contact met u op.</p>

    <div class="contact-wrapper">
      <div class="contact-info">
        <h2>Contactgegevens</h2>
        <p class="contact-lead">Telefonisch of per e-mail bereikbaar.</p>
        <div class="contact-links">
          <div>
            <span>Bel ons</span>
            <a href="tel:+31297548241">+31 297 548 241</a>
            <p class="contact-note"><strong>8:00-19:00</strong><br>Bel voor een gratis intake gesprek</p>
          </div>
          <div>
            <span>E-mail</span>
            <a href="mailto:info@uwverblijfsvergunning.nl">info@uwverblijfsvergunning.nl</a>
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
            Telefoon (optioneel)
            <input type="tel" name="phone">
          </label>
          <label>
            Onderwerp
            <select name="topic">
              <option value="intake">Ik wil een intakegesprek plannen</option>
              <option value="second-opinion">Ik zoek een second opinion</option>
              <option value="employer">Ik neem contact op als werkgever</option>
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
