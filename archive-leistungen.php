<?php
// archive-leistungen.php - Archiv für Leistungen
?>
<?php get_header(); ?>

    <section class="services leistungen">
        <h1>Unsere Leistungen</h1>
        <div class="service-grid">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="service-item">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('full', array('alt' => get_the_title())); ?>
            <?php endif; ?>
           <p><?php echo get_the_content(); ?></p>
           </div>
            <?php endwhile; else: ?>
                <p>Noch keine Leistungen vorhanden.</p>
            <?php endif; ?>
        </div>
        
        <?php
        // Pagination
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '← Vorherige',
            'next_text' => 'Nächste →',
        ));
        ?>
    </section>

<?php get_footer(); ?>
