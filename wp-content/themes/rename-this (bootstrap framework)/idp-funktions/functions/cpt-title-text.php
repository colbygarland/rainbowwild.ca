<?php
/*
Change Custom Post Type Title Text
*/
function idp_change_default_title( $title ){
     $screen = get_current_screen();
 
     if  ( $screen->post_type == 'newsosaur' ) {
          return 'Enter Year and Month';
     }
	 if  ( $screen->post_type == 'post' ) {
          return 'Enter Blog Title';
     }
	 if  ( $screen->post_type == 'sponsor' ) {
          return 'Enter Company Name';
     }
	 if  ( $screen->post_type == 'testimonial' ) {
          return 'Enter Name and Position';
     }
}
 
add_filter( 'enter_title_here', 'idp_change_default_title' );