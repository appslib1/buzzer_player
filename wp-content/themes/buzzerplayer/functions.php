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

// Register Custom Post Type "Audios"
function create_audio_post_type() {

    $labels = array(
        'name'                  => _x( 'Audios', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Audio', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Audios', 'text_domain' ),
        'name_admin_bar'        => __( 'Audio', 'text_domain' ),
        'add_new_item'          => __( 'Ajouter un nouvel audio', 'text_domain' ),
        'edit_item'             => __( 'Modifier l\'audio', 'text_domain' ),
        'view_item'             => __( 'Voir l\'audio', 'text_domain' ),
    );

    $args = array(
        'label'                 => __( 'Audio', 'text_domain' ),
        'labels'                => $labels,
        'public'                => true,
        'show_in_menu'          => true,
        'supports'              => array( 'title' ), // seulement le titre
        'taxonomies'            => array( 'category' ), // activer les catégories
        'has_archive'           => true,
        'show_in_rest'          => true, // pour Gutenberg et REST API
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-format-audio', // icône dans le menu
    );

    register_post_type( 'audio', $args );
}
add_action( 'init', 'create_audio_post_type', 0 );


add_filter('lzb/register_blocks', function ($blocks) {
    $block_slug    = 'lazyblock/idees-de-bruitage'; // Full slug
    $repeater_name = 'bruitages';                   // Repeater name
    $select_name   = 'bruitage';                    // Select name
    $cpt           = 'audio';                       // Custom post type

    foreach ($blocks as &$block) {
        if (!isset($block['slug']) || $block['slug'] !== $block_slug) {
            continue;
        }

        // Loop all controls
        foreach ($block['controls'] as $control_id => &$control) {
            // Find the repeater control
            if ($control['type'] === 'repeater' && $control['name'] === $repeater_name) {
                $repeater_id = $control_id;

                // Now find the select inside this repeater
                foreach ($block['controls'] as &$sub_control) {
                    if (
                        $sub_control['type'] === 'select' &&
                        $sub_control['name'] === $select_name &&
                        $sub_control['child_of'] === $repeater_id
                    ) {
                        // Build choices
                        $choices = [];
                        $posts = get_posts([
                            'post_type'      => $cpt,
                            'posts_per_page' => -1,
                            'orderby'        => 'title',
                            'order'          => 'ASC',
                        ]);

                        foreach ($posts as $post) {
                            $choices[] = [
                                'label' => $post->post_title,
                                'value' => $post->ID,
                            ];
                        }

                        $sub_control['choices'] = $choices;
                    }
                }
            }
        }
    }

    return $blocks;
});
add_action('wp_ajax_filter_audio', 'filter_audio_callback');
add_action('wp_ajax_nopriv_filter_audio', 'filter_audio_callback');

function filter_audio_callback() {
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

    $args = [
        'post_type'      => 'audio',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    if (!empty($category)) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'category', // replace with your custom taxonomy if needed
                'field'    => 'slug',
                'terms'    => $category,
            ]
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start(); // start output buffering
        echo '<div class="audios">';
        while ($query->have_posts()) {
            $query->the_post();
            $bruitage_id = get_the_ID();
            if (!$bruitage_id) continue;

            $title = get_the_title($bruitage_id);
            $icon  = get_the_post_thumbnail_url($bruitage_id, 'thumbnail') ?: get_template_directory_uri() . '/assets/icons/buzzBtn.png';
            $audio_url = get_field('upload_mp3', $bruitage_id)['url'] ?? '';
            ?>
            <div class="sound-button-group position-relative text-center">
                <img data-audio="<?= esc_url($audio_url) ?>" src="<?= esc_url($icon) ?>" alt="<?= esc_attr($title) ?>" class="sound-button">
                <div class="position-relative">
                    <div class="button-label"><?= esc_html($title) ?></div>
                    <div class="button-label button-label-2 text-center">
                        <a href="#" class="use-it-button btn btn-danger">USE IT</a>
                    </div>
                </div>
            </div>
            <?php
        }
        echo '</div>';
        wp_reset_postdata();
        $html = ob_get_clean();

        wp_send_json_success($html);
    } else {
        wp_send_json_error('<p>No posts found</p>');
    }

    wp_die();
}

function add_page_excerpts() {
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'add_page_excerpts' );


// Load More Ajax
add_action('wp_ajax_load_more_audios', 'load_more_audios');
add_action('wp_ajax_nopriv_load_more_audios', 'load_more_audios');

function load_more_audios() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type'      => 'audio',
        'posts_per_page' => 15,
        'paged'          => $paged
    );

    $loop = new WP_Query($args);

    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            global $post;
            $bruitage_id = get_the_ID();
            if (!$bruitage_id) continue;

            $title = get_the_title($bruitage_id);
            $icon  = get_the_post_thumbnail_url($bruitage_id, 'thumbnail') ?: get_template_directory_uri() . '/assets/icons/buzzBtn.png';
            ?>
            <div class="sound-button-group position-relative text-center">
                <img data-audio="<?= get_field('upload_mp3',$bruitage_id)['url'] ?>" 
                     src="<?php echo esc_url($icon); ?>" 
                     alt="<?php echo esc_attr($title); ?>" 
                     class="sound-button">
                <div class="position-relative">
                    <div class="button-label"><?php echo esc_html($title); ?></div>
                    <div class="button-label button-label-2 text-center">
                        <a href="#" class="use-it-button btn btn-danger">USE IT</a>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
    endif;

    wp_die(); // important
}





































// 1. Champ d'upload multiple sur la page produit
add_action( 'woocommerce_before_add_to_cart_button', 'custom_multiple_mp3_upload_field' );
function custom_multiple_mp3_upload_field() {
    echo '<div class="mp3-upload-wrapper mb-3">
        <label for="mp3_upload">Upload your MP3(s):</label>
        <input type="file" name="mp3_upload[]" id="mp3_upload" accept=".mp3" multiple />
    </div>';
}

// 2. Validation (vérifie qu'au moins un fichier est uploadé)
add_filter( 'woocommerce_add_to_cart_validation', 'validate_multiple_mp3_upload', 10, 3 );
function validate_multiple_mp3_upload( $passed, $product_id, $quantity ) {
    if ( empty($_FILES['mp3_upload']['name'][0]) ) {
        wc_add_notice( __( 'Please upload at least one MP3 file.', 'woocommerce' ), 'error' );
        return false;
    }
    return $passed;
}



// Save audio files (uploaded or recorded) to cart item
add_filter('woocommerce_add_cart_item_data', 'handle_audio_input_cart_item', 10, 2);
function handle_audio_input_cart_item($cart_item_data, $product_id) {

    // 1️⃣ Handle uploaded MP3 files
    if (!empty($_FILES['mp3_upload']['name'][0])) {
        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        $uploaded_files = [];
		
        foreach ($_FILES['mp3_upload']['name'] as $key => $value) {
            if (!empty($_FILES['mp3_upload']['name'][$key])) {
                $file = [
                    'name'     => $_FILES['mp3_upload']['name'][$key],
                    'type'     => $_FILES['mp3_upload']['type'][$key],
                    'tmp_name' => $_FILES['mp3_upload']['tmp_name'][$key],
                    'error'    => $_FILES['mp3_upload']['error'][$key],
                    'size'     => $_FILES['mp3_upload']['size'][$key],
                ];

				

                $upload = wp_handle_upload($file, ['test_form' => false]);
				var_dump($file);
				exit;
                if (isset($upload['url']) && !isset($upload['error'])) {
                    $uploaded_files[] = $upload['url'];
                }
            }
        }


        if (!empty($uploaded_files)) {
            $cart_item_data['mp3_uploads'] = $uploaded_files;
        }
    }

    // 2️⃣ Handle recorded audio (Base64 hidden input)
    if (!empty($_POST['recorded_audio'])) {
        $audio_data = $_POST['recorded_audio'];

        // Decode base64
        $audio_data = preg_replace('/^data:audio\/\w+;base64,/', '', $audio_data);
        $audio_data = base64_decode($audio_data);

        $upload_dir = wp_upload_dir();
        $filename = 'recording-' . uniqid() . '.mp3';
        $file_path = $upload_dir['path'] . '/' . $filename;
		
        file_put_contents($file_path, $audio_data);

        $cart_item_data['recorded_audio'] = $upload_dir['url'] . '/' . $filename;
    }

    return $cart_item_data;
}

// Display audio files in cart & checkout
add_filter('woocommerce_get_item_data', 'display_audio_cart_item', 10, 2);
function display_audio_cart_item($item_data, $cart_item) {

    if (!empty($cart_item['mp3_uploads'])) {
        $links = '';
        foreach ($cart_item['mp3_uploads'] as $i => $url) {
            $links .= '<a href="' . esc_url($url) . '" target="_blank">Uploaded File ' . ($i+1) . '</a><br>';
        }
        $item_data[] = [
            'name' => __('Uploaded MP3s', 'woocommerce'),
            'value' => $links,
        ];
    }

    if (!empty($cart_item['recorded_audio'])) {
        $item_data[] = [
            'name' => __('Recorded Audio', 'woocommerce'),
            'value' => '<a href="' . esc_url($cart_item['recorded_audio']) . '" target="_blank">Listen</a>',
        ];
    }

    return $item_data;
}

// Save audio files in order meta
add_action('woocommerce_checkout_create_order_line_item', 'save_audio_order_meta', 10, 4);
function save_audio_order_meta($item, $cart_item_key, $values, $order) {
    if (!empty($values['mp3_uploads'])) {
        foreach ($values['mp3_uploads'] as $i => $url) {
            $item->add_meta_data('Uploaded MP3 ' . ($i+1), $url);
        }
    }

    if (!empty($values['recorded_audio'])) {
        $item->add_meta_data('Recorded Audio', $values['recorded_audio']);
    }
}

