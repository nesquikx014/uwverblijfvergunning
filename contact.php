<?php
$page_title = 'Contact - Neva Nexis Juristen';
$contactFeedback = '';
if (isset($_GET['message'])) {
    if ($_GET['message'] === 'success') {
        $contactFeedback = 'Bedankt! We nemen binnen één werkdag contact met u op.';
    } elseif ($_GET['message'] === 'error') {
        $contactFeedback = 'Er ging iets mis bij het versturen. Mail ons rechtstreeks via info@nevanexis.nl.';
    }
}

include 'header.php';
?>

<section class="hero-about">
  <div class="hero-overlay"></div>
  <div class="hero-inner">
    <h1>Contact</h1>
    <p>Vragen? Neem contact met ons op voor een gratis en vrijblijvend intakegesprek.</p>
  </div>
</section>

<section class="section contact-section">
  <div class="container contact-container">
    <!-- Contact Info (Links) -->
    <div class="contact-info-block">
      <h2>Bereikbaar op verschillende manieren</h2>
      
      <div class="contact-methods">
        <!-- Telefoon -->
        <div class="contact-method">
          <h3>Bel ons</h3>
          <p class="method-detail">
            <a href="tel:+31297548241">+31 297 548 241</a><br>
            <a href="tel:+31648154534">+31 648 154 534</a>
          </p>
          <p class="method-time"><strong>Openingstijden:</strong> 08:00 – 19:00</p>
          <p class="method-note">Voor spoedgevallen kunt u ook buiten kantooruren contact opnemen.</p>
        </div>
        
        <!-- E-mail -->
        <div class="contact-method">
          <h3> E-mail</h3>
          <p class="method-detail">
            <a href="mailto:info@nevanexis.nl">info@nevanexis.nl</a>
          </p>
          <p class="method-note">We antwoorden binnen één werkdag.</p>
        </div>
        
        <!-- Bezoekadres -->
        <div class="contact-method">
          <h3>Bezoekadres</h3>
          <p class="method-detail">
            Evert van de Beekstraat 1<br>
            1118 CN Schiphol
          </p>
        </div>
        
        <!-- Postadres -->
        <div class="contact-method">
          <h3>Postadres</h3>
          <p class="method-detail">
            Postbus 75709<br>
            1118 ZT Schiphol
          </p>
        </div>
      </div>
    </div>

    <!-- Contact Form (Rechts) -->
    <div class="contact-form-block">
      <h2>Stuur ons een bericht</h2>
      <form action="send-contact.php" method="POST" class="contact-form">
        <?php if ($contactFeedback): ?>
          <p class="form-feedback"><?= htmlspecialchars($contactFeedback, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        
        <div class="form-group">
          <label for="name">Naam *</label>
          <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
          <label for="email">E-mailadres *</label>
          <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="phone">Telefoon</label>
            <input type="tel" id="phone" name="phone">
          </div>
          <div class="form-group">
            <label for="topic">Onderwerp *</label>
            <select id="topic" name="topic" required>
              <option value="">Kies een onderwerp</option>
              <option value="intake">Intakegesprek plannen</option>
              <option value="second-opinion">Second opinion</option>
              <option value="urgency">Spoedeisend</option>
              <option value="other">Overig</option>
            </select>
          </div>
        </div>
        
        <div class="form-group">
          <label for="message">Uw bericht *</label>
          <textarea id="message" name="message" rows="5" required placeholder="Beschrijf uw situatie of vraag..."></textarea>
        </div>
        
        <button class="btn btn--primary" type="submit">Verstuur bericht</button>
      </form>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
