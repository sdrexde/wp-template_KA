<?php get_header(); ?>

<main id="main-content">
 <section class="single">
  <?php 
  if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); ?>
      
      <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <div class="page-content">
          <?php the_content(); ?>
        </div>
      </article>
      
    <?php endwhile; 
  endif; 
  ?>
</section>		 
</main>


<?php get_footer(); ?>
