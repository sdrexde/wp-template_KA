<?php get_header(); ?>

<section class="hero" id="home">
    <div class="slider" role="region" aria-label="Bildslider">
        <button class="slider-control prev" aria-label="Vorheriges Bild">Vorheriges</button>
        
        <?php 
        // Slider images from customizer
        $slider_images = array();
        for ($i = 1; $i <= 3; $i++) {
            $image = get_theme_mod("slider_image_$i");
            if ($image) {
                $slider_images[] = $image;
            }
        }
        
        // Default images if none set
        if (empty($slider_images)) {
            $slider_images = array(
                get_template_directory_uri() . '/img/slider1.jpg',
                get_template_directory_uri() . '/img/slider2.jpg',
                get_template_directory_uri() . '/img/flotte.jpg'
            );
        }
        
        foreach ($slider_images as $index => $image) {
            $active_class = $index === 0 ? 'active' : '';
            $fetchpriority = $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"';
            echo "<img class='slide $active_class' src='$image' alt='Kälte- und Klimatechnik' $fetchpriority>";
        }
        ?>
        
        <button class="slider-control next" aria-label="Nächstes Bild">Nächstes</button>
        <button class="slider-control pause" aria-label="Slider pausieren">Pause</button>
    </div>
    
    <div class="slider-dots">
        <?php for ($i = 0; $i < count($slider_images); $i++): ?>
            <button class="dot <?php echo $i === 0 ? 'active' : ''; ?>" onclick="currentSlide(<?php echo $i; ?>)" aria-label="Zu Bild <?php echo $i + 1; ?> wechseln"><?php echo $i + 1; ?></button>
        <?php endfor; ?>
    </div>
    
    <div class="hero-content">
        <h1><?php echo esc_html(get_theme_mod('hero_title', 'Ihre Experten für Kälte- und Klimatechnik')); ?></h1>
        <p><?php echo esc_html(get_theme_mod('hero_subtitle', 'Zuverlässige Lösungen für ganz Deutschland – jetzt Angebot sichern!')); ?></p>
        <a href="#kontakt" class="cta-button">Angebot anfordern</a>
    </div>
</section>
<section class="testimonials" id="kundenstimmen">
    <br/>
    <h2>Was unsere Kunden sagen</h2>
    <div class="testimonial-grid">
        <?php
        $testimonials = new WP_Query(array(
            'post_type' => 'testimonials',
            'posts_per_page' => 6
        ));
        
        if ($testimonials->have_posts()) {
            while ($testimonials->have_posts()) {
                $testimonials->the_post();
                $author = get_post_meta(get_the_ID(), '_testimonial_author', true);
                ?>
                <div class="testimonial-item">
                    <p><?php the_content(); ?></p>
                    <cite>— <?php echo esc_html($author); ?> —</cite>
                </div>
                <?php
            }
            wp_reset_postdata();
        } else {
            // Default testimonials if none created
            $default_testimonials = array(
                array('content' => 'Der Einbau unserer Klimaanlage verlief vom Angebot bis zur Montage absolut vorbildlich. Die Monteure haben sauber und ordentlich gearbeitet. Selbst eine kurzfristige Änderung von meiner Seite war kein Problem und wurde professionell umgesetzt. Absolut empfehlenswert!', 'author' => 'Marko K.'),
                array('content' => 'Ich habe mich lange informiert, welche Firma ich nehme für eine Klimaanlage, und ich kann sagen ich bin sehr zufrieden. Vom ersten Gespräch, über die Montage und Einhaltung der Termine hat alles bestens funktioniert. Sehr ordentlich gearbeitet, für Frau auch alles verständlich erklärt.. kein Dreck hinterlassen. Sehr gut.', 'author' => 'Julia Kr'),
                array('content' => 'Im Februar 2020 wurde durch die Firma Kälte-Apel eine Klimaanlage in unserem Einfamilienhaus installiert. Die Mitarbeiter waren pünktlich, freundlich, kompetent und waren mit viel Sorgfalt bei der Sache, wir sind sehr zufrieden! Der nette Kontakt zum Vertrieb und der sympathische Geschäftsführer runden die Erfahrung ab. So muss das sein, einfach eine tolle Truppe!', 'author' => 'Christian B'),
                array('content' => 'Firma zum 2. Mal gehabt. Sehr gute Qualität, sehr gute Leistung. Die Montage lief reibungslos und schmutzlos. Wie versprochen. Freundliche und kompetente Mitarbeiter, die sehr flink und fleißig sind. Man merkt das gute Betriebsklima. Immer wieder gern Fam.E', 'author' => 'Heidrun E'),
                array('content' => 'Zwei mal mit der Firma zusammen gearbeitet. War sehr angenehm überrascht. Preis Leistung okay und immer Termin treu', 'author' => 'Heiko J'),
                array('content' => 'Kälte Apel hat vor ca. 3 Monaten bei uns eine Klimaanlage installiert. 5 von 5 möglichen Sternen. Alles Jupp!!!', 'author' => 'Kalle B')
            );
            
            foreach ($default_testimonials as $testimonial) {
                echo '<div class="testimonial-item">';
                echo '<p>"' . esc_html($testimonial['content']) . '"</p>';
                echo '<cite>— ' . esc_html($testimonial['author']) . ' —</cite>';
                echo '</div>';
            }
        }
        ?>
    </div>
</section>

<section class="contact" id="kontakt">
        
    <h3>Anfahrt & Öffnungszeiten</h3>
    <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=11.743333339691164%2C51.894447113767455%2C11.753847599029543%2C51.89847243759668&amp;layer=mapnik&amp;marker=51.896459820759844%2C11.748590469360352" style="border: 1px solid #ccc; border-radius: 5px;" title="Karte zu Kälte-Apel in Stadtfeld 19a, 39240 Calbe (Saale)" loading="lazy"></iframe>
    <br>
    <small><a href="https://www.openstreetmap.org/?mlat=51.896460&amp;mlon=11.748590#map=18/51.896460/11.748590" target="_blank" rel="noopener noreferrer">Größere Karte anzeigen (OpenStreetMap)</a></small>
    
    <table>
        <caption>Öffnungszeiten</caption>
        <tr>
            <th>Tag</th>
            <th>Öffnungszeiten</th>
        </tr>
        <tr>
            <td>Montag - Freitag</td>
            <td>07:00 - 16:00</td>
        </tr>
        <tr>
            <td>Samstag</td>
            <td>Geschlossen</td>
        </tr>
        <tr>
            <td>Sonntag</td>
            <td>Geschlossen</td>
        </tr>
    </table>
    
    <p><strong>E-Mail:</strong> <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'info@kälte-apel.de')); ?>"><?php echo esc_html(get_theme_mod('contact_email', 'info@kälte-apel.de')); ?></a></p>
    <p><strong>Telefon:</strong> <?php echo esc_html(get_theme_mod('contact_phone', '039291 491 44')); ?></p>
    <p>Unser 24/7-Notdienst ist außerhalb der regulären Öffnungszeiten verfügbar (Pauschale wird berechnet).</p>
    <p>Adresse: <?php echo esc_html(get_theme_mod('contact_address', 'Stadtfeld 19a, 39240 Calbe (Saale), Deutschland')); ?></p>
</section>

<?php get_footer(); ?>