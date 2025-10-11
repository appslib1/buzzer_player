<?php
/**
 * Custom 404 template (Bootstrap version)
 * Copy this file to your active theme (or child theme) as 404.php
 */

get_header();
?>

<main id="site-content" role="main" class="py-5">
  <div class="container text-center my-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <h1 class="display-4 fw-bold mb-3">Oops! Page Not Found</h1>
        <p class="lead text-muted mb-4">
          The page you’re looking for doesn’t exist, has been moved, or is no longer available.
        </p>


        <div class="d-flex flex-wrap justify-content-center gap-3">
		  <div class="check-link">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="">
            <i class="bi bi-house-door"></i> Home
          </a>
			</div>
		  <div class="check-link">
			<a href="<?php echo esc_url( home_url( 'contact' ) ); ?>" class="">
				<i class="bi bi-envelope"></i> Contact Us
			</a>
		  </div>
        </div>

        <div class="mt-5">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/icons/pink_smile.svg' ); ?>" 
               alt="404 illustration" class="img-fluid" style="max-width: 400px;">
        </div>
      </div>
    </div>
  </div>
</main>

<?php
get_footer();
?>
