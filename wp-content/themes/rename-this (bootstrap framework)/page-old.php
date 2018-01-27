<?php
get_header();
//get_sidebar();
?>
            
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 

?>
<article class="main">
               
<?php
if( post_password_required($post) ):
	echo '<section class="col-xs-12">'.get_the_password_form().'</section>';
else:
if( have_rows('rows') ):
	while( have_rows('rows') ): the_row();
		echo '<div class="row">';
		if( get_row_layout() == 'full_width_row' ):
			//SINGLE COLUMN
			
			if( have_rows('column') ):
				 while( have_rows('column') ): the_row();
					if( get_row_layout() == 'content' ):
						$content = get_sub_field('content');
						$licols = get_sub_field('list_layout');
						$listyle = false;
						if( $licols != 1){ 
							$listyle = 'li-col-'.$licols;
							$lifind = array( '<li', '</ul>');
							$lirep  = array( '<li class="'.$listyle.'"', '</ul><div class="clearfix"></div>');
						}
						if( $listyle ) $content = str_replace($lifind, $lirep, $content);
						$lead = false;
						
						echo '<div class="col-sm-12">';
						echo do_shortcode($content);
						echo '</div>';	
					endif;
				endwhile; 
			endif; //END SINGLE COLUMN
			
		elseif( get_row_layout() == '2_column_row' ):
			//TWO COLUMNS
			if( have_rows('column_1') ):
				 while( have_rows('column_1') ): the_row();
					if( get_row_layout() == 'content' ):
						$content = get_sub_field('content');
						
						$width = get_sub_field('width');
						$mdw = $width[0]['desktop'];
						$smw = $width[0]['tablet'];
						$xsw = $width[0]['mobile'];
						
						$xs = ' col-xs-'.$xsw;
						if( $smw != $xsw ) $sm = ' col-sm-'.$smw;
						if( (!$sm && $mdw != $xsw) || ($sm && $mdw != $smw) ) $md = ' col-md-'.$mdw;
						
						$licols = get_sub_field('list_layout');
						$listyle = false;
						if( $licols != 1){ 
							$listyle = 'li-col-'.$licols;
							$lifind = array( '<li', '</ul>');
							$lirep  = array( '<li class="'.$listyle.'"', '</ul><div class="clearfix"></div>');
						}
						if( $listyle ) $content = str_replace($lifind, $lirep, $content);
						$lead = false;
						
						echo '<div class="'.ltrim($md.$sm.$xs).'">';
						echo do_shortcode($content);
						echo '</div>';	
					endif;
				endwhile; 
			endif;
				
			if( have_rows('column_2') ):
				 while( have_rows('column_2') ): the_row();
					if( get_row_layout() == 'content' ):
						$content = get_sub_field('content');
						
						$width = get_sub_field('width');
						$mdw = $width[0]['desktop'];
						$smw = $width[0]['tablet'];
						$xsw = $width[0]['mobile'];
						
						$xs = ' col-xs-'.$xsw;
						if( $smw != $xsw ) $sm = ' col-sm-'.$smw;
						if( (!$sm && $mdw != $xsw) || ($sm && $mdw != $smw) ) $md = ' col-md-'.$mdw;
						
						$licols = get_sub_field('list_layout');
						$listyle = false;
						if( $licols != 1){ 
							$listyle = 'li-col-'.$licols;
							$lifind = array( '<li', '</ul>');
							$lirep  = array( '<li class="'.$listyle.'"', '</ul><div class="clearfix"></div>');
						}
						if( $listyle ) $content = str_replace($lifind, $lirep, $content);
						$lead = false;
						
						echo '<div class="'.ltrim($md.$sm.$xs).'">';
						echo do_shortcode($content);
						echo '</div>';	
					endif;
				endwhile;
				
			endif;
			
		elseif( get_row_layout() == '3_column_row' ):
			//THREE COLUMNS
			if( have_rows('column_1') ):
				 while( have_rows('column_1') ): the_row();
					if( get_row_layout() == 'content' ):
						$content = get_sub_field('content');
						
						$width = get_sub_field('width');
						$mdw = $width[0]['desktop'];
						$smw = $width[0]['tablet'];
						$xsw = $width[0]['mobile'];
						
						$xs = ' col-xs-'.$xsw;
						if( $smw != $xsw ) $sm = ' col-sm-'.$smw;
						if( (!$sm && $mdw != $xsw) || ($sm && $mdw != $smw) ) $md = ' col-md-'.$mdw;
						
						$licols = get_sub_field('list_layout');
						$listyle = false;
						if( $licols != 1){ 
							$listyle = 'li-col-'.$licols;
							$lifind = array( '<li', '</ul>');
							$lirep  = array( '<li class="'.$listyle.'"', '</ul><div class="clearfix"></div>');
						}
						if( $listyle ) $content = str_replace($lifind, $lirep, $content);
						$lead = false;
						
						echo '<div class="'.ltrim($md.$sm.$xs).'">';
						echo do_shortcode($content);
						echo '</div>';	
					endif;
				endwhile; 
			endif;
				
			if( have_rows('column_2') ):
				 while( have_rows('column_2') ): the_row();
					if( get_row_layout() == 'content' ):
						$content = get_sub_field('content');
						
						$width = get_sub_field('width');
						$mdw = $width[0]['desktop'];
						$smw = $width[0]['tablet'];
						$xsw = $width[0]['mobile'];
						
						$xs = ' col-xs-'.$xsw;
						if( $smw != $xsw ) $sm = ' col-sm-'.$smw;
						if( (!$sm && $mdw != $xsw) || ($sm && $mdw != $smw) ) $md = ' col-md-'.$mdw;
						
						$licols = get_sub_field('list_layout');
						$listyle = false;
						if( $licols != 1){ 
							$listyle = 'li-col-'.$licols;
							$lifind = array( '<li', '</ul>');
							$lirep  = array( '<li class="'.$listyle.'"', '</ul><div class="clearfix"></div>');
						}
						if( $listyle ) $content = str_replace($lifind, $lirep, $content);
						$lead = false;
						
						echo '<div class="'.ltrim($md.$sm.$xs).'">';
						echo do_shortcode($content);
						echo '</div>';	
					endif;
				endwhile;
			endif;
				
			if( have_rows('column_3') ):
				 while( have_rows('column_3') ): the_row();
					if( get_row_layout() == 'content' ):
						$content = get_sub_field('content');
						
						$width = get_sub_field('width');
						$mdw = $width[0]['desktop'];
						$smw = $width[0]['tablet'];
						$xsw = $width[0]['mobile'];
						
						$xs = ' col-xs-'.$xsw;
						if( $smw != $xsw ) $sm = ' col-sm-'.$smw;
						if( (!$sm && $mdw != $xsw) || ($sm && $mdw != $smw) ) $md = ' col-md-'.$mdw;
						
						$licols = get_sub_field('list_layout');
						$listyle = false;
						if( $licols != 1){ 
							$listyle = 'li-col-'.$licols;
							$lifind = array( '<li', '</ul>');
							$lirep  = array( '<li class="'.$listyle.'"', '</ul><div class="clearfix"></div>');
						}
						if( $listyle ) $content = str_replace($lifind, $lirep, $content);
						$lead = false;
						
						echo '<div class="'.ltrim($md.$sm.$xs).'">';
						echo do_shortcode($content);
						echo '</div>';	
					endif;
				endwhile;
				
			endif;
			
			
		endif;
		echo '</div>';
	endwhile; //end rows
endif;
endif;
endwhile; //loop
?>
 <div class="clearfix"></div>
				</article><!-- #post-## -->

<?php 
get_footer(); 
