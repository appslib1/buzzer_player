<?php
/**
 * BuzzerPlayer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BuzzerPlayer
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function buzzerplayer_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on BuzzerPlayer, use a find and replace
		* to change 'buzzerplayer' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'buzzerplayer', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'buzzerplayer' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'buzzerplayer_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'buzzerplayer_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function buzzerplayer_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'buzzerplayer_content_width', 640 );
}
add_action( 'after_setup_theme', 'buzzerplayer_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function buzzerplayer_widgets_init() {
	/*register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'buzzerplayer' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'buzzerplayer' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);*/
}
add_action( 'widgets_init', 'buzzerplayer_widgets_init' );

// Register FAQ de la page produit widget area
function buzzerplayer_faq_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'FAQ de la page produit', 'buzzerplayer' ),
            'id'            => 'faq-produit', // Unique ID
            'description'   => esc_html__( 'Ajoutez des widgets FAQ sur les pages produits.', 'buzzerplayer' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'buzzerplayer_faq_widgets_init' );


function buzzerplayer_footer_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer widget', 'buzzerplayer' ),
            'id'            => 'footer-widget', // Unique ID
            'description'   => esc_html__( 'Footer right widget', 'buzzerplayer' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'buzzerplayer_footer_widgets_init' );


function buzzerplayer_sm_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Block spead smiles de la page produit', 'buzzerplayer' ),
            'id'            => 'spread-smiles', // Unique ID
            'description'   => esc_html__( 'Configuration du block sur les pages produits.', 'buzzerplayer' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'buzzerplayer_sm_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function buzzerplayer_scripts() {
	wp_enqueue_style( 'buzzerplayer-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'buzzerplayer-style', 'rtl', 'replace' );

	wp_enqueue_script( 'bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/js/bootstrap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'buzzerplayer-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js', array(), _S_VERSION, true );


//	wp_enqueue_script( 'buzzerplayer-js', get_template_directory_uri() . '/js/custom.js', array(), _S_VERSION, true );
	wp_enqueue_script(
		'buzzerplayer-js',
		get_template_directory_uri() . '/js/custom.js',
		array('jquery'), // add jQuery as a dependency
		_S_VERSION,
		true
	);



}
add_action( 'wp_enqueue_scripts', 'buzzerplayer_scripts' );

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



function buzzer_enqueue_styles() {
    wp_enqueue_style('bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css');
    wp_enqueue_style('swiper-style', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css');
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/style.css');
}
add_action('wp_enqueue_scripts', 'buzzer_enqueue_styles');


// Enable support for editor styles
add_theme_support('editor-styles');

// Load your custom editor styles
add_editor_style('css/style.css');
add_editor_style('css/admin.css');

// Still enqueue admin styles for dashboard UI
function buzzer_enqueue_admin_styles() {
    wp_enqueue_style(
        'theme-style-admin',
        get_template_directory_uri() . '/css/style.css',
        array(),
        filemtime(get_template_directory() . '/css/style.css')
    );

	wp_enqueue_style(
        'theme-style-admin-2',
        get_template_directory_uri() . '/css/admin.css',
        array(),
        filemtime(get_template_directory() . '/css/admin.css')
    );
}
add_action('admin_enqueue_scripts', 'buzzer_enqueue_admin_styles');




// Register a custom menu location
function mytheme_register_menus() {
    register_nav_menus( array(
        'header_menu' => __( 'Header Menu', 'buzzerplayer' ),
        'footer_menu_1' => __( 'Footer Menu 1', 'buzzerplayer' ),
        'footer_menu_2' => __( 'Footer Menu 2', 'buzzerplayer' ),
        'footer_menu_bottom' => __( 'Footer Bottom Menu', 'buzzerplayer' ),
    ) );
}
add_action( 'init', 'mytheme_register_menus' );


// Remove the checkout payment from order review
function custom_remove_checkout_payment() {
    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
}
add_action( 'wp', 'custom_remove_checkout_payment' );

// Move WooCommerce payment section after customer details
function custom_move_checkout_payment() {
    // Remove payment from order review
    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

    // Add payment after customer details
    add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20 );
}
add_action( 'wp', 'custom_move_checkout_payment' );
