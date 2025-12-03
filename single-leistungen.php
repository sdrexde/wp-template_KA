<?php get_header(); ?>
<br>
<div class="service-grid">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="service-item">
                <h3><?php the_title(); ?></h3>
			<p>
			<?php if (has_post_thumbnail()): ?>
                    <div class="service-image">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>
            <?php endif; ?>
			</p>
            <div class="service-content">
                <?php the_content(); ?>
            </div>	
                <p><a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="cta-button">Jetzt Angebot anfordern</a></p>
                <p><a href="<?php echo esc_url(get_permalink(get_page_by_path('leistungen'))); ?>">← Zurück zu allen Leistungen</a></p>
    <?php endwhile; endif; ?>
</div>
<br>
<?php get_footer(); ?>