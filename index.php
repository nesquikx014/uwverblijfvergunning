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
      <a class="btn btn--primary" href="#contact">Plan een intake</a>
      <a class="btn btn--ghost" href="info.php?page=EUprocedure">Lees onze uitleg</a>
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
      <article class="tile">
        <h3>Intake op maat</h3>
        <p>Snel helderheid over uw situatie. Binnen 24 uur ontvangt u een stappenplan en kostenoverzicht.</p>
        <a href="#contact">Plan intake</a>
      </article>
    </div>
  </div>
</section>

<section class="section" id="over">
  <div class="container about">
    <div>
      <h2>Onze werkwijze</h2>


Laat de toekomst je nooit storen. U zult het tegemoet treden, als het moet, met dezelfde wapens van de rede waartegen u zich vandaag bewapent. Je zult het tegemoet treden, als het moet, met dezelfde wapens van de rede.

      <ul>
        <li> <strong>ONZE FILOSOFIE</strong>
Bij UwVerblijfsvergunning.nl zoeken wij altijd een oplossing voor uw persoonlijke situatie. Er is geen standaard werkwijze binnen het vreemdelingenrecht. Dit is altijd maatwerk. Dat betekent dat voor iedereen een ander route is om een verblijfsvergunning te kunnen bemachtigen.</li>
        <li> <strong>ONZE TARIEVEN</strong> 
Wij bieden onze diensten aan voor vaste tarieven. Dit is tegenover particulieren transparant en staat u nooit voor financiële verrassingen. Er komen voor u geen bijkomende kosten dan het afgesproken tarief. </li>
       
      </ul>
    </div>
    <div>
      <img src="fotos/foto2.jpg" alt="Overleg met cliënten" loading="lazy">
    </div>
  </div>
</section>

<section class="section" id="contact">
  <div class="container">
    <div class="contact-wrapper">
      <div class="contact-info">
        <h2>Neem contact op</h2>
        <p class="contact-lead">Laat uw gegevens achter en wij komen binnen één werkdag bij u terug.</p>
        <div class="contact-links">
          <div>
            <span>Bel ons</span>
            <a href="tel:">31&nbsp;297&nbsp;548&nbsp;241</a>
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
          <textarea name="message" rows="5" required></textarea>
        </label>
        <button class="btn btn--primary" type="submit">Verstuur bericht</button>
      </form>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
