 <?php header('X-UA-Compatible: IE=edge'); ?>
<!doctype html>
<!--[if IE 7 | IE 8]>
<html class="no-js oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function theme_slug_render_title() {
?>
<title><?php wp_title( '-', true, 'right' ); ?></title>
<?php
    }
    add_action( 'wp_head', 'theme_slug_render_title' );
endif;
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:image" content="https://yourdomain.com/fb_share_image.jpg" />

<?php /* RSS FEEDS - uncomment if site uses news/blog posts
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
*/ ?>
<?php wp_head(); ?>

</head>
<body class="<?php if(is_front_page()) echo 'home';?>">

<div class="container">
    	<header class="main">
                <h1 class="title"><a href="<?php echo get_option('siteurl');?>" class="ir"><?php echo get_option('blogname');?></a></h1>
               	<nav class="main">
                	<input type="checkbox" id="MenuToggle" />
                    <label for="MenuToggle" onclick aria-label="Toggle Navigation" class="lines-button x2">
                      <span class="lines"></span> <strong>MENU</strong>
                    </label>
                    <ul class="menu">
                        <?php  
                        $exclude = ''; //comma seperated ID's
                        wp_list_pages( 'sort_column=menu_order&title_li=&depth=3&echo=1&exclude='.$exclude);?>	
                        
                    </ul>  
                </nav>
                
           <form role="search" method="get" id="searchform" action="<?php echo get_option('siteurl');?>" >
            <fieldset class="search">
            	
                <input type="text" name="s" id="s" class="form-control" placeholder="Search"  /> 
                <button class="btn btn-default" title="Submit Search"><span class="glyphicon glyphicon-search"></span></button>
            </fieldset>
          </form>

            </header>
            