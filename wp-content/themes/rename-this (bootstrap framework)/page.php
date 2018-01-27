<?php
get_header();
//get_sidebar();
?>
            
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<article class="main">	

              <?php the_content(); ?>
               
 <div class="clearfix"></div>
				</article><!-- #post-## -->

<?php  endwhile;
get_footer(); 