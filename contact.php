<?php
$page_title = 'Contact - info@NevaNexisJuristen.nl';
$contactFeedback = '';
if (isset($_GET['message'])) {
    if ($_GET['message'] === 'success') {
        $contactFeedback = 'Bedankt! We nemen binnen één werkdag contact met u op.';
    } elseif ($_GET['message'] === 'error') {
        $contactFeedback = 'Er ging iets mis bij het versturen. Mail ons rechtstreeks via info@NevaNexisJuristen.nl.';
    }
}

include 'header.php';
?>

<section class="section section--intro">
  <div class="container">
    <h1>Contact</h1>
    <p class="intro">Vul onderstaand formulier in en wij nemen zo snel mogelijk contact met u op.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Contactgegevens</h2>
    <p class="contact-lead">Telefonisch of per e-mail bereikbaar.</p>
    <div class="grid">
      <div class="tile">
        <h3>Bel ons</h3>
        <a href="tel:+31297548241">+31 297 548 241</a>
        <p class="contact-note"><strong>8:00-19:00</strong><br>Bel voor een gratis intake gesprek</p>
      </div>
      <div class="tile">
        <h3>E-mail</h3>
        <a href="mailto:info@nevajuristen.nl">info@nevajuristen.nl</a>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Stel uw vraag</h2>
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
</section>

<?php include 'footer.php'; ?>
