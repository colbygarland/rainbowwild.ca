<?php get_header(); 
//get_sidebar();
?>
<article class="main">
	<h1>Error 404 - Page Not Found</h1>
	<div class="col">	
		<?php if( function_exists('useful404s') ){
			 echo useful404s(); 
		}else{
			echo "<p><strong>Sorry the page you're trying to reach could not be found.</strong><br> Please try using the site map below:</p>";
		}?>
     	<h3>Site Map</h3>
	<?php if( function_exists('ShowSitemap') ){
		 echo ShowSitemap();
	}else{
		echo '<h4>Pages</h4>
		<ul>';
			wp_list_pages( 'sort_column=menu_order&title_li=&depth=10&echo=1&exclude='.$exclude);
		echo '</ul>';	
		
		$rposts = wp_get_recent_posts( array('numberposts' => '500') ); 
		if( count($rposts) > 0 ){
			echo '<h4>Posts</h4>
			<ul>';
			foreach($rposts as $rec ){
				echo '<li><a href="' . get_permalink($rec["ID"]) . '">' . $rec["post_title"].'</a></li>';	
			}
			echo '</ul>';
		}
	}		 ?>

	</div>
</article>
	 
<?php get_footer(); ?>