<?php
// page-kontakt.php - Kontakt Seite Template
?>
<?php get_header(); ?>

<div class="contact-page">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <section class="contact" id="kontakt">
            <br/>
            <h1><?php the_title(); ?></h1>
            <div class="contact-content">
                <?php the_content(); ?>
            </div>
            
            <p>Haben Sie Fragen oder möchten Sie ein Angebot? Wir freuen uns auf Ihre Nachricht!</p>
            
            <div aria-live="polite">
                <?php
                if (isset($_GET['contact_sent'])) {
                    if ($_GET['contact_sent'] === 'success') {
                        echo '<p class="success">Ihre Nachricht wurde erfolgreich gesendet!</p>';
                    } else {
                        echo '<p class="error">Fehler beim Senden der Nachricht. Bitte versuchen Sie es erneut.</p>';
                    }
                }
                
                if (isset($_GET['contact_errors'])) {
                    $errors = explode('|', urldecode($_GET['contact_errors']));
                    foreach ($errors as $error) {
                        echo '<p class="error">' . esc_html($error) . '</p>';
                    }
                }
                ?>
            </div>
            
            <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
                <?php wp_nonce_field('kaelte_apel_contact_form', 'contact_nonce'); ?>
                <input type="hidden" name="kaelte_apel_contact_form" value="1">
                
                <label for="anrede">Anrede</label>
                <input type="text" id="anrede" name="anrede" placeholder="Anrede" required>
                
                <label for="vorname">Vorname</label>
                <input type="text" id="vorname" name="vorname" placeholder="Vorname" required>
                
                <label for="nachname">Nachname</label>
                <input type="text" id="nachname" name="nachname" placeholder="Nachname" required>
                
                <label for="telefon">Telefon</label>
                <input type="tel" id="telefon" name="telefon" placeholder="Telefon" required>
                
                <label for="nachricht">Ihre Nachricht</label>
                <textarea id="nachricht" name="nachricht" placeholder="Ihre Nachricht" required></textarea>
                
                <label for="strasse">Straße (optional)</label>
                <input type="text" id="strasse" name="strasse" placeholder="Straße (optional)">
                
                <label for="hausnummer">Hausnummer (optional)</label>
                <input type="text" id="hausnummer" name="hausnummer" placeholder="Hausnummer (optional)">
                
                <label for="plz">PLZ (optional)</label>
                <input type="text" id="plz" name="plz" placeholder="PLZ (optional)">
                
                <label for="ort">Ort (optional)</label>
                <input type="text" id="ort" name="ort" placeholder="Ort (optional)">
                
                <button type="submit">Absenden</button>
            </form>
            
            <h3>Anfahrt & Öffnungszeiten</h3>
            <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=11.743333339691164%2C51.894447113767455%2C11.753847599029543%2C51.89847243759668&amp;layer=mapnik&amp;marker=51.896459820759844%2C11.748590469360352" style="border: 1px solid #ccc; border-radius: 5px;" title="Karte zu Kälte-Apel" loading="lazy"></iframe>
            <br>
            <small><a href="https://www.openstreetmap.org/?mlat=51.896460&amp;mlon=11.748590#map=18/51.896460/11.748590" target="_blank" rel="noopener noreferrer">Größere Karte anzeigen (OpenStreetMap)</a></small>
            
            <table>
                <caption>Öffnungszeiten</caption>
                <tr><th>Tag</th><th>Öffnungszeiten</th></tr>
                <tr><td>Montag - Freitag</td><td>07:00 - 16:00</td></tr>
                <tr><td>Samstag</td><td>Geschlossen</td></tr>
                <tr><td>Sonntag</td><td>Geschlossen</td></tr>
            </table>
            
            <p><strong>E-Mail:</strong> <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'info@kälte-apel.de')); ?>"><?php echo esc_html(get_theme_mod('contact_email', 'info@kälte-apel.de')); ?></a></p>
            <p><strong>Telefon:</strong> <?php echo esc_html(get_theme_mod('contact_phone', '039291 491 44')); ?></p>
            <p>Unser 24/7-Notdienst ist außerhalb der regulären Öffnungszeiten verfügbar (Pauschale wird berechnet).</p>
            <p>Adresse: <?php echo esc_html(get_theme_mod('contact_address', 'Stadtfeld 19a, 39240 Calbe (Saale), Deutschland')); ?></p>
        </section>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>