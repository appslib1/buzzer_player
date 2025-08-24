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

	<?php /*
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'buzzerplayer' ); ?></a>


	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$buzzerplayer_description = get_bloginfo( 'description', 'display' );
			if ( $buzzerplayer_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $buzzerplayer_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'buzzerplayer' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header>
	*/
	?>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-md-12 m-auto">

					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<a class="navbar-brand" href="#">
                			<img src="<?php echo get_template_directory_uri(); ?>/assets/icons/header-logo.svg" alt="Buzzer Player Symbole" class="logo">
						</a>
						<button class="navbar-toggler" id="customToggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
							<ul class="navbar-nav ms-auto">
								<li class="nav-item active">
									<a class="nav-link" href="#">Home</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Sounds effects</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Push button</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">FAQ</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#">Contact</a>
								</li>
							</ul>
						</div>
					</nav>

				</div>
			</div>
		</div>
		

	</header>

