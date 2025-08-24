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
							<li><a href="#">Buzzer Player</a></li>
							<li><a href="#">Sounds effects</a></li>
							<li><a href="#">Products</a></li>
							<li><a href="#">FAQ</a></li>
							<li><a href="#">Basket</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="links-column">
						<h4 class="column-title">Follow us</h4>
						<ul>
							<li><a href="#">Instagram</a></li>
							<li><a href="#">Facebook</a></li>
							<li><a href="#">TikTok</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3"></div>
				<div class="col-md-3">
					<div class="footer-contact">
						<h4 class="contact-title">Need help ?</h4>
						<p class="contact-text">Send us a message through the contact page</p>
						<button class="chat-button">Chat with us</button>
					</div>
				</div>
			
			</div>

			<div class="row footer-bottom">
				<div class="col-md-8">
					<div class="legal-links">
						<span class="language">
							English
						</span>
						<ul>
							<li>
								<a href="#">Term and conditions</a>
							</li>
							<li>
								<a href="#">Privacy Policy</a>
							</li>
							<li>
								<a href="#">General Conditions of Purchase</a>
							</li>
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
