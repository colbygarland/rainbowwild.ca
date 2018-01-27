<?php
get_header();
//get_sidebar();
		?>

<article class="main">
<nav class="posts">
		<span class="pull-left"><?php previous_post_link(); ?></span>
		<span class="pull-right"><?php next_post_link(); ?></span>
</nav>

<h1><?php get_the_title(get_option( 'page_for_posts' ));?></h1>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div class="">
					<h3><?php the_title(); ?></h3>                        
						<?php the_excerpt(); ?>
                        <div class="clearfix"></div>         
				</div><!-- #post-## -->

<?php endwhile;?>

</article>

<?php get_footer(); ?>