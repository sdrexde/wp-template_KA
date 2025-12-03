<?php
// page-leistungen.php - Leistungen Seite Template
?>
<?php get_header(); ?>

<div class="services-page">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <section class="services leistungen" id="leistungen">
            <br/>
            <h1><?php the_title(); ?></h1>
            <div class="services-intro">
                <?php the_content(); ?>
            </div>
            
            <div class="service-grid">
                <?php
                $leistungen = new WP_Query(array(
                    'post_type' => 'leistungen',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                
                if ($leistungen->have_posts()) {
                    while ($leistungen->have_posts()) {
                        $leistungen->the_post();
                        ?>
                        <div class="service-item">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('thumbnail', array('alt' => get_the_title())); ?>
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p>Noch keine Leistungen erstellt. Bitte erstellen Sie Leistungen im WordPress Admin-Bereich.</p>';
                }
                ?>
            </div>
        </section>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>