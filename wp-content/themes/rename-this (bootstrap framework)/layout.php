<?php
/*
Add new content blocks within the Advanced Custom Fields - Flexible Columns editor by adding a new layout within the row width(s) you want it available in. Then just add your layout types in the function below
*/
add_filter( 'flexible_layout', 'IDP_Custom_Layouts');
function IDP_Custom_Layouts($type){
	
	switch( $type ):
		case 'custom_type': 
			$field = get_sub_field('field_name');
    	    echo $field;
			break;
		
	endswitch;
}