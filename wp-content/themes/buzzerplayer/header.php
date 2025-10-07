<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuzzerPlayer
 */

 $locations = get_nav_menu_locations(); // Get all menu locations

$header_items = "";
if ( isset( $locations['header_menu'] ) ) {  // Replace with your location slug
    $menu_id   = $locations['header_menu'];
	
    $menu_items = wp_get_nav_menu_items( $menu_id );

    if ( $menu_items ) {
        foreach ( $menu_items as $item ) {
			$current_class = ( esc_url( $item->url ) == home_url( add_query_arg( [], $GLOBALS['wp']->request ) ).'/' ) ? ' current' : '';
			$header_items .= '
				<li class="nav-item">
					<a class="nav-link '.$current_class.'" href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>
				</li>
			';
        }
    }
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header <?= is_front_page() ? '' : 'shadow' ?>">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-md-12 m-auto">

					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<a class="navbar-brand" href="<?= home_url('/') ?>">
                			<img src="<?php echo get_template_directory_uri(); ?>/assets/icons/header-logo.svg" alt="Buzzer Player Symbole" class="logo">
						</a>
						<div class="top-right-menu-mobile">
							<a href="<?= home_url('cart') ?>" class="nav-link cart">
								<img src="<?= home_url('wp-content/themes/buzzerplayer/assets/icons/cart.svg') ?>" alt="cart">
								<?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
								<?php if ( $cart_count > 0 ) : ?>
									<span class="cart-count"></span>
								<?php endif; ?>
							</a>
							<button class="navbar-toggler" id="customToggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
								<span></span>
								<span></span>
								<span></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
							<ul class="navbar-nav ms-auto">
								<?= $header_items ?>
								<li class="nav-item">
									<a href="<?= home_url('cart') ?>" class="nav-link cart">
										<img src="<?= home_url('wp-content/themes/buzzerplayer/assets/icons/cart.svg') ?>" alt="cart">
										<?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
										<?php if ( $cart_count > 0 ) : ?>
											<span class="cart-count"></span>
										<?php endif; ?>
										<label for="">Basket</label>
									</a>
								</li>
							</ul>
						</div>
					</nav>

				</div>
			</div>
		</div>
		

	</header>

