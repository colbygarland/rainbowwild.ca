<?php
get_header(); 
//get_sidebar();
?>
<article class="main">

<?php if ( have_posts() ) : ?>
			
                        <h1><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
             
			
				<?php
				 while ( have_posts() ) : the_post();?>
				 <div class="searchresult">
						<h2><?php the_title(); ?></h2>
						<?php the_excerpt(); ?>
                        <p><a href="<?php the_permalink(); ?>">View this Result &raquo;</a></p>
                        <br class="clear" />
				</div><!-- #post-## -->
				<?php endwhile;
				?>
<?php else : ?>
				<div class="searchresult no-results">
                
                	<h2>Nothing Found</h2>		
                
						<p>Sorry, but nothing matched your search criteria. Please try again with different keywords or use our Site Map.</p>
                         
                    <h3>Site Map</h3>  
                        <?php echo ShowSitemap(); ?>
				</div>
				
<?php endif; ?>
</article>
 <?php get_footer(); ?>