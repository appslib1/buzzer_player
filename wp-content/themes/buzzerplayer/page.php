<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuzzerPlayer
 */

get_header();
?>


	<main id="primary" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-title"><?= the_title() ?></h1>
					<?= the_content() ?>
				</div>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
