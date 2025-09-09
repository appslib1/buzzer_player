<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BuzzerPlayer
 */


$locations = get_nav_menu_locations(); // Get all menu locations
$pages = "";
if ( isset( $locations['footer_menu_1'] ) ) {  // Replace with your location slug
    $menu_id   = $locations['footer_menu_1'];
    $menu_items = wp_get_nav_menu_items( $menu_id );
	if ( $menu_items ) {
        foreach ( $menu_items as $item ) {
			$pages .= '
				<li>
					<a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>
				</li>
			';
        }
    }

}

$follow_us = "";
if ( isset( $locations['footer_menu_2'] ) ) {  // Replace with your location slug
    $menu_id   = $locations['footer_menu_2'];
    $menu_items = wp_get_nav_menu_items( $menu_id );
	if ( $menu_items ) {
        foreach ( $menu_items as $item ) {
			$follow_us .= '
				<li>
					<a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>
				</li>
			';
        }
    }
}

$copyrights_menu = "";
if ( isset( $locations['footer_menu_bottom'] ) ) {  // Replace with your location slug
    $menu_id   = $locations['footer_menu_bottom'];
    $menu_items = wp_get_nav_menu_items( $menu_id );
	if ( $menu_items ) {
        foreach ( $menu_items as $item ) {
			$copyrights_menu .= '
				<li>
					<a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>
				</li>
			';
        }
    }
}

?>
	<footer class="footer">
		<div class="footer-container container">
			<div class="row">
				<div class="col-md-12">
					<div class="footer-logo">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/icons/footer-logo.png" alt="Buzzer Player Symbole" class="logo">
					</div>
				</div>
				<div class="col-md-3">
					<div class="links-column">
						<h4 class="column-title">Pages</h4>
						<ul>
							<?= $pages ?>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="links-column">
						<h4 class="column-title">Follow us</h4>
						<ul>
							<?= $follow_us ?>
						</ul>
					</div>
				</div>
				<div class="col-md-3"></div>
				<div class="col-md-3">
					<?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>
					<div class="footer-contact">
						<?php dynamic_sidebar( 'footer-widget' ); ?>
					</div>
					<?php endif; ?>
				</div>
			
			</div>

			<div class="row footer-bottom">
				<div class="col-md-8">
					<div class="legal-links">
						<span class="language">
							English
						</span>
						<ul>
							<?= $copyrights_menu ?>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="payment-methods">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/icons/payment-gateways.svg" alt="Buzzer Player Symbole" class="logo">
					</div>
					<p class="copyright">Copyright © Buzzer Player</p>
				</div>
			</div>
		</div>
	</footer>


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
