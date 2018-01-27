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
$first = true;
while( has_sub_field('content') ):

	//SECTION COLUMN REPEATER	
	if( get_row_layout() == 'content' ):
		
		foreach( get_sub_field('section') as $col ):
			$settings = $col['settings'][0];

			$lg = false;
			$md = false;
			$sm = false;
			$xs = false;
			
			//Width Classes
			$lgw = $settings['column_width'][0]['widescreen'];
			$mdw = $settings['column_width'][0]['desktop'];
			$smw = $settings['column_width'][0]['tablet'];
			$xsw = $settings['column_width'][0]['mobile'];
			
			$xs = ' col-xs-'.$xsw;
			if( $smw != $xsw ) $sm = ' col-sm-'.$smw;
			if( (!$sm && $mdw != $xsw) || ($sm && $mdw != $smw) ) $md = ' col-md-'.$mdw;
			if( ($md && $mdw != $lgw) || (!$md && $sm && $smw != $lgw) || (!$md && !$sm && $xsw != $lgw ) ) $lg = ' col-lg-'.$lgw;
			
			//Padding Classes
			$padding = $settings['padding'][0];
			if( $padding['top'] != 0 ) $pad = ' t-pad-'.$padding['top'];
			if( $padding['right'] != '15px' ) $pad .= ' r-pad-'.$padding['right'];
			if( $padding['bottom'] != 0 ) $pad .= ' b-pad-'.$padding['bottom'];
			if( $padding['left'] != '15px' ) $pad .= ' l-pad-'.$padding['left'];
			
			//New Row Wrapper
			$row = $settings['new_row'];
			if( $row && $first ){  echo '<div class="row firstrow">'; $first = false;}
			elseif( $row && !$first ){  echo '</div><!-- /.row --> <div class="row nextrow">'; }

			
			
			$type = $col['section_type'];
			if($type == 'editor' ):
				$content = $col['content_editor'];
				
				//List Column Class
				$licols = $col['list_layout'];
				$listyle = false;
				if( $licols != 1){ 
					$listyle = 'li-col-'.$licols;
					$lifind = array( '<li', '</ul>');
					$lirep  = array( '<li class="'.$listyle.'"', '</ul><div class="clearfix"></div>');
				}
				if( $listyle ) $content = str_replace($lifind, $lirep, $content);
				$lead = false;
				
				echo '<section class="'.$lead.ltrim($lg.$md.$sm.$xs).$pad.'">';
				echo do_shortcode($content);
				echo '</section>';
			
			endif;
	
			
			
				
			
		endforeach;
		if( !$first ) echo '</div> <!-- /.row last section-->';
		$z=0;
	
	
	endif;
endwhile; //content
endif;
endwhile; //loop
?>
 <div class="clearfix"></div>
				</article><!-- #post-## -->

<?php 
get_footer(); 
