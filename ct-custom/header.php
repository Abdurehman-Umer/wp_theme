<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/custom.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="top-bar-container">
        <div class="top-bar">
            <div class="float-left">
                <span class="dark-orange font-bold">CALL US NOW!</span>
                <span class="font-bold">
					<?php $phone_number = esc_html(get_option('theme_phone_number')); ?>
					<a class="white" href="tel:
					<?php 
					echo $phone_number ? $phone_number : '';
					?>">   
					<?php 
						echo $phone_number ? $phone_number : '385.154.11.28.35'; 
					?>
					</a> 
				</span>
            </div>
            <div class="float-right">
                <span class="dark-orange font-bold">LOGIN</span>
                <span class="white font-bold">SIGNUP</span>
            </div>
        </div>
    </div>
    <header>
        <div class="header-container">
			<?php
				$logo_url = get_option('theme_logo');
				if ($logo_url && @getimagesize($logo_url)) {
					echo '<a href="http://coalitiontest.local/"><img class="logo" src="' . esc_url($logo_url) . '" alt="Site Logo"></a>';
				} else {
					echo '<a href="http://coalitiontest.local/"><img class="logo" src="' . get_template_directory_uri() . '/assets/images/logo.png" alt="Default Logo"></a>';
				}
			?>
			  	<div class="hamburger-menu" id="hamburgerMenu">
					<span></span>
					<span></span>
					<span></span>
				</div>
            <?php 
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_class' => 'menu float-right'
                )); 
            ?>
        </div>
    </header>
