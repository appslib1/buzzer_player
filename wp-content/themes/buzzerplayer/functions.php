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
            'name'          => esc_html__( 'Footer Need help widget', 'buzzerplayer' ),
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

function buzzerplayer_footer_top_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Section au dessus du footer', 'buzzerplayer' ),
            'id'            => 'section-dessus-footer', // Unique ID
            'description'   => esc_html__( 'Section au dessus du footer', 'buzzerplayer' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'buzzerplayer_footer_top_widgets_init' );


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
                    <div class="button-label title"><?= esc_html($title) ?></div>
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

add_action('wp_ajax_save_audios_session', 'save_audios_session');
add_action('wp_ajax_nopriv_save_audios_session', 'save_audios_session');

function save_audios_session() {
    if (isset($_POST['audios']) && is_array($_POST['audios'])) {
        if (!session_id()) session_start();

        // Existing audios
        $existing = $_SESSION['selected_audios'] ?? [];

        // Each item in $_POST['audios'] should be ['name' => ..., 'url' => ...]
        foreach ($_POST['audios'] as $audio) {
            if (isset($audio['url']) && isset($audio['name'])) {
                // Check if this URL already exists
                $exists = false;
                foreach ($existing as $e) {
                    if ($e['url'] === $audio['url']) {
                        $exists = true;
                        break;
                    }
                }

                // Add only if not exists
                if (!$exists) {
                    $existing[] = $audio;
                }
            }
        }

        $_SESSION['selected_audios'] = $existing;

        wp_send_json_success($_SESSION['selected_audios']);
    } else {
        wp_send_json_error('No audios received');
    }
}

add_action('wp_ajax_delete_audio_session', 'delete_audio_session');
add_action('wp_ajax_nopriv_delete_audio_session', 'delete_audio_session');

function delete_audio_session() {
    if (!session_id()) session_start();

    if (isset($_POST['url'])) {
        $url = sanitize_text_field($_POST['url']);

        if (!empty($_SESSION['selected_audios'])) {
            foreach ($_SESSION['selected_audios'] as $key => $audio) {
                if ($audio['url'] === $url) {
                    unset($_SESSION['selected_audios'][$key]);
                }
            }
            // Reindex array
            $_SESSION['selected_audios'] = array_values($_SESSION['selected_audios']);
        }

        wp_send_json_success($_SESSION['selected_audios']);
    } else {
        wp_send_json_error('No audio URL received');
    }
}

add_action('wp_ajax_save_recorded_audio', 'save_recorded_audio');
add_action('wp_ajax_nopriv_save_recorded_audio', 'save_recorded_audio');

function save_recorded_audio() {
    if (!session_id()) session_start();

    if (!isset($_POST['audio']) || !isset($_POST['name'])) {
        wp_send_json_error("No audio data provided");
    }

    $audio_data = $_POST['audio']; // Base64 encoded
    $name = sanitize_text_field($_POST['name']);

    if (!isset($_SESSION['selected_audios'])) {
        $_SESSION['selected_audios'] = [];
    }

    $_SESSION['selected_audios'][] = [
        'name' => $name,
        'url'  => $audio_data, // use same 'url' key for compatibility
    ];

    wp_send_json_success($_SESSION['selected_audios']);
}

add_action('wp_ajax_save_uploaded_audio', 'save_uploaded_audio');
add_action('wp_ajax_nopriv_save_uploaded_audio', 'save_uploaded_audio');

function save_uploaded_audio() {
    if (!session_id()) session_start();

    if (empty($_FILES['audio_file']) || !isset($_POST['name'])) {
        wp_send_json_error('No file uploaded');
    }

    $file = $_FILES['audio_file'];
    $name = sanitize_file_name($_POST['name']);

    // Optional: check file type
    $allowed_types = ['audio/mpeg','audio/mp3','audio/webm','audio/wav'];
    if (!in_array($file['type'], $allowed_types)) {
        wp_send_json_error('Invalid audio format');
    }

    // Use WordPress function to handle upload
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    $upload_overrides = ['test_form' => false];
    $movefile = wp_handle_upload($file, $upload_overrides);

    if ($movefile && !isset($movefile['error'])) {
        // File URL
        $audio_url = $movefile['url'];

        if (!isset($_SESSION['selected_audios'])) {
            $_SESSION['selected_audios'] = [];
        }

        $_SESSION['selected_audios'][] = [
            'name' => $name,
            'url'  => $audio_url
        ];

        wp_send_json_success($_SESSION['selected_audios']);
    } else {
        wp_send_json_error($movefile['error']);
    }
}


// Add audios from session to cart
add_filter('woocommerce_add_cart_item_data', 'add_session_audios_to_cart', 10, 2);
function add_session_audios_to_cart($cart_item_data, $product_id) {
    if (!session_id()) session_start();

    if (!empty($_SESSION['selected_audios'])) {
        // Store in cart item
        $cart_item_data['selected_audios'] = $_SESSION['selected_audios'];
    }

    return $cart_item_data;
}




add_action('woocommerce_checkout_create_order_line_item', 'save_selected_audios_to_order', 10, 4);
function save_selected_audios_to_order($item, $cart_item_key, $values, $order) {
    if (!empty($values['selected_audios'])) {
        $item->add_meta_data('Selected Audios', json_encode($values['selected_audios']), true);
    }
}

add_action('woocommerce_add_to_cart', 'clear_selected_audios_session', 10, 6);
function clear_selected_audios_session() {
    if (!session_id()) session_start();
    unset($_SESSION['selected_audios']);
}


add_filter('woocommerce_get_item_data', 'display_selected_audios_in_cart', 10, 2);
function display_selected_audios_in_cart($item_data, $cart_item) {
    if (!empty($cart_item['selected_audios'])) {
        foreach ($cart_item['selected_audios'] as $audio) {
            $name = esc_html($audio['name']);
            $url  = esc_url($audio['url']);

            // Add HTML for a small audio player
            $item_data[] = [
                'name'  => $name,
                'value' => '<audio controls style="width:200px;">
                               <source src="' . $url . '" type="audio/mpeg">
                               Your browser does not support the audio element.
                            </audio>',
                'display' => true
            ];
        }
    }
    return $item_data;
}




/** Code ajouté par max **/
// 1. Ajouter un champ "Tracking Number" dans l'admin commande
add_action('woocommerce_admin_order_data_after_order_details', 'add_tracking_number_admin_field');

function add_tracking_number_admin_field($order){
    // Récupérer la valeur si déjà remplie
    $tracking_number = get_post_meta($order->get_id(), '_tracking_number', true);

    echo '<div class="order_data_column">';
    echo '<h4>' . __('Tracking Number') . '</h4>';
    echo '<input type="text" name="tracking_number" value="' . esc_attr($tracking_number) . '" placeholder="Entrez le numéro de suivi" style="width:100%; max-width:300px;" />';
    echo '</div>';
}

// 2. Sauvegarder la valeur du champ
add_action('woocommerce_process_shop_order_meta', 'save_tracking_number_admin_field', 45, 2);

function save_tracking_number_admin_field($order_id, $post){
    if (isset($_POST['tracking_number'])) {
        update_post_meta($order_id, '_tracking_number', sanitize_text_field($_POST['tracking_number']));
    }
}
/*************************/