<?php
// 404.php - Fehlerseite
?>
<?php get_header(); ?>

<div class="error-404">
    <section class="error-content">
        <h1>Seite nicht gefunden</h1>
        <p>Die angeforderte Seite konnte nicht gefunden werden. Möglicherweise wurde sie verschoben oder gelöscht.</p>
        
        <div class="error-search">
            <h2>Suchen Sie nach etwas Bestimmtem?</h2>
            <?php get_search_form(); ?>
        </div>
        
        <div class="error-links">
            <h2>Versuchen Sie diese Links:</h2>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Startseite</a></li>
                <li><a href="<?php echo esc_url(home_url('/#leistungen')); ?>">Unsere Leistungen</a></li>
                <li><a href="<?php echo esc_url(home_url('/#kontakt')); ?>">Kontakt</a></li>
            </ul>
        </div>
    </section>
</div>

<?php get_footer(); ?>