<?php
/*
Template Name: News
*/
get_header(); ?>

<section class="news" id="news">
    <br/>
    <h2>Neuigkeiten</h2>
    <div class="news-grid">
        <?php
        // WP_Query für die letzten 6 Beiträge
        $news_query = new WP_Query(array(
            'post_type' => 'post', // Standard-Beiträge
            'posts_per_page' => 6, // Anzahl der Beiträge
            'post_status' => 'publish', // Nur veröffentlichte Beiträge
            'orderby' => 'date', // Nach Datum sortieren
            'order' => 'DESC' // Neueste zuerst
        ));

        if ($news_query->have_posts()) :
            while ($news_query->have_posts()) : $news_query->the_post(); ?>
                <div class="news-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium', array('alt' => get_the_title(), 'class' => 'news-image')); ?>
                    <?php endif; ?>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>
                    <p class="news-date"><?php echo get_the_date(); ?></p>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Keine Neuigkeiten vorhanden.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>