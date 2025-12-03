<?php get_header(); ?>

<main id="main-content">
<section class="single"	>
  <?php 
  if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); ?>
      
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <div class="post-meta">
          <span><?php the_time( get_option('date_format') ); ?></span> | 
          <span><?php the_author(); ?></span>
        </div>
        <div class="post-content">
          <?php the_content(); ?>
        </div>
      </article>
      
    <?php endwhile; 
  endif; 
  ?>
</section>	
</main>

<?php get_footer(); ?>
