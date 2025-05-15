<?php
/**
 * CT Custom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CT_Custom
 */

if ( ! function_exists( 'ct_custom_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ct_custom_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CT Custom, use a find and replace
		 * to change 'ct-custom' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ct-custom', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ct-custom' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ct_custom_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ct_custom_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ct_custom_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ct_custom_content_width', 640 );
}
add_action( 'after_setup_theme', 'ct_custom_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ct_custom_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ct-custom' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ct-custom' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ct_custom_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ct_custom_scripts() {
	wp_enqueue_style( 'ct-custom-style', get_stylesheet_uri() );

	wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/custom.css', array('theme-style'), '1.0.0');

	wp_enqueue_script( 'ct-custom-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ct-custom-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ct_custom_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/*Theme Settings*/
function mytheme_setup() {
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'mytheme_setup');

function mytheme_add_settings_page() {
    add_menu_page(
        'Theme Settings', 
        'Theme Settings', 
        'manage_options', 
        'theme-settings', 
        'mytheme_settings_page_content', 
        'dashicons-admin-generic', 
        100 
    );
}
add_action('admin_menu', 'mytheme_add_settings_page');

function mytheme_settings_page_content() {
    if (isset($_POST['save_theme_settings'])) {
        update_option('theme_logo', esc_url_raw($_POST['theme_logo']));
        update_option('theme_phone_number', sanitize_text_field($_POST['theme_phone_number']));
        update_option('theme_address', sanitize_textarea_field($_POST['theme_address']));
        update_option('theme_fax_number', sanitize_text_field($_POST['theme_fax_number']));
        update_option('theme_social_links', sanitize_textarea_field($_POST['theme_social_links']));
        echo '<div class="updated"><p>Settings saved!</p></div>';
    }

    $theme_logo = get_option('theme_logo', '');
    $theme_phone_number = get_option('theme_phone_number', '');
    $theme_address = get_option('theme_address', '');
    $theme_fax_number = get_option('theme_fax_number', '');
    $theme_social_links = get_option('theme_social_links', '');
?>
    <div class="wrap">
        <h1>Theme Settings</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
					<th scope="row"><label for="theme_logo">Logo</label></th>
                    <td>
						<?php
							$logo_url = get_option('theme_logo');
							if ($logo_url && @getimagesize($logo_url)) {
								$logo_preview_url = esc_url($logo_url);
							} else {
								$logo_preview_url = 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png';
							}
						?>
						<img id="theme-logo-preview" src="<?php echo $logo_preview_url; ?>" alt="Logo Preview" style="max-width: 200px; display: block; margin-bottom: 10px; margin-left: 50px; cursor: pointer;" />
						<input type="hidden" name="theme_logo" id="theme_logo" value="<?php echo esc_url(get_option('theme_logo')); ?>" />
						<button type="button" class="button" id="upload-logo-button" style="margin-left:50px;">Upload Logo</button>
						<button type="button" class="button" id="remove-logo-button">Remove Logo</button>
					</td>
                </tr>
                <tr>
                    <th scope="row"><label for="theme_phone_number">Phone Number</label></th>
                    <td><input type="text" name="theme_phone_number" id="theme_phone_number" value="<?php echo esc_attr($theme_phone_number); ?>" style="width: 33%;" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="theme_address">Address</label></th>
                    <td><textarea name="theme_address" id="theme_address" style="width: 33%;"><?php echo esc_textarea($theme_address); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="theme_fax_number">Fax Number</label></th>
                    <td><input type="text" name="theme_fax_number" id="theme_fax_number" value="<?php echo esc_attr($theme_fax_number); ?>" style="width: 33%;" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="theme_social_links">Social Media Links (Comma Separated)</label></th>
                    <td><textarea name="theme_social_links" id="theme_social_links" style="width: 66%;"><?php echo esc_textarea($theme_social_links); ?></textarea></td>
                </tr>
            </table>
            <?php submit_button('Save Settings', 'primary', 'save_theme_settings'); ?>
        </form>
    </div>
<?php
}

function mytheme_enqueue_admin_scripts($hook) {
    if ($hook === 'toplevel_page_theme-settings') {
        wp_enqueue_media();
        wp_enqueue_script('mytheme-admin-js', get_template_directory_uri() . '/js/theme_settings.js', array('jquery'), null, true);
    }
}
add_action('admin_enqueue_scripts', 'mytheme_enqueue_admin_scripts');


function mytheme_register_menus() {
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu'),
        'footer-menu' => __('Footer Menu'),
    ));
}
add_action('init', 'mytheme_register_menus');

