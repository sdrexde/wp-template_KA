<?php
// single-testimonials.php - Einzelnes Testimonial Template
?>
<?php get_header(); ?>

<div class="single-testimonial">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="testimonial-single">
            <header class="testimonial-header">
                <h1>Kundenstimme</h1>
            </header>
            
            <div class="testimonial-content">
                <blockquote>
                    <p><?php the_content(); ?></p>
                    <cite>— <?php echo esc_html(get_post_meta(get_the_ID(), '_testimonial_author', true)); ?> —</cite>
                </blockquote>
            </div>
            
            <footer class="testimonial-footer">
                <p><a href="<?php echo esc_url(home_url('/#kundenstimmen')); ?>">← Zurück zu allen Kundenstimmen</a></p>
            </footer>
        </article>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>