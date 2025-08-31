<?php
get_header();
global $woocommerce;
$product = new WC_Product(get_the_ID()); 
$thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

$attachment_ids = $product->get_gallery_image_ids();

?>


<div class="container my-5">
  <div class="row align-items-center">
    <!-- Left: Product Image -->
    <div class="col-md-5 text-center">
        <?php

        // Get main image
        $thumb_id  = $product->get_image_id();
        $thumb_url = wp_get_attachment_image_url( $thumb_id, 'large' );

        // Get gallery images
        $gallery_ids = $product->get_gallery_image_ids();
        ?>
        
        <!-- Main Swiper -->
        <div class="swiper productSwiper mb-3">
          <div class="swiper-wrapper">
            <?php if ( $thumb_url ) : ?>
              <div class="swiper-slide">
                <img src="<?= esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid rounded">
              </div>
            <?php endif; ?>

            <?php if ( $gallery_ids ) : 
              foreach ( $gallery_ids as $img_id ) :
                $img_url = wp_get_attachment_image_url( $img_id, 'large' ); ?>
                <div class="swiper-slide">
                  <img src="<?= esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid rounded">
                </div>
              <?php endforeach;
            endif; ?>
          </div>
        </div>

        <!-- Thumbnail Swiper -->
        <?php if ( $thumb_url || $gallery_ids ) : ?>
          <div class="productThumbsContainer">
              <div class="swiper productThumbs">
                <div class="swiper-wrapper">
                  <?php if ( $thumb_url ) : ?>
                    <div class="swiper-slide">
                      <img src="<?= esc_url( $thumb_url ); ?>" class="img-fluid rounded shadow-sm" alt="">
                    </div>
                  <?php endif; ?>

                  <?php foreach ( $gallery_ids as $img_id ) :
                    $img_url = wp_get_attachment_image_url( $img_id, 'thumbnail' ); ?>
                    <div class="swiper-slide">
                      <img src="<?= esc_url( $img_url ); ?>" class="img-fluid rounded shadow-sm" alt="">
                    </div>
                  <?php endforeach; ?>
                </div>

              </div>
              <!-- Add arrows -->
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
          </div>
        <?php endif; ?>
      </div>


    <!-- Right: Product Details -->
    <div class="col-md-7">
      <!-- Title -->
      <h1><?= the_title() ?></h1>

      <!-- Ratings -->
      <div class="ratings">
        <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
        <small class="nb-ratings">120 reviews</small>
      </div>

      <!-- Price -->
      <h4 class="text-price"><?= $product->get_price_html(); ?></h4>

      <!-- Description -->
      <div class="product-description">
            <?= the_content() ?>
        </div>

      <!-- Add to Cart Button -->
      <?php 
        if ( $product ) {
            $add_to_cart_url = $product->add_to_cart_url();
            $add_to_cart_text = "Add to cart"
            ?>
            <a href="<?php echo esc_url( $add_to_cart_url ); ?>" 
            class="btn btn-primary btn-lg mt-3 add_to_cart_button ajax_add_to_cart "
            data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
            rel="nofollow">
            <i class="bi bi-cart-fill"></i> <?php echo esc_html( $add_to_cart_text ); ?>
            </a>
        <?php } ?>

    </div>
  </div>
</div>

<div class="features-bar">
    <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="feature-items">
                      <div class="feature-item">
                        <img src="http://localhost:8080/wp-content/themes/buzzerplayer/assets/icons/audio_file.svg" alt="Audio file icon" class="feature-icon">
                        <p class="feature-text">Up to 3min sound</p>
                      </div>
                      <div class="feature-item">
                        <img src="http://localhost:8080/wp-content/themes/buzzerplayer/assets/icons/audio_file.svg" alt="Battery icon" class="feature-icon">
                        <p class="feature-text">Batteries included</p>
                      </div>
                      <div class="feature-item">
                        <img src="http://localhost:8080/wp-content/themes/buzzerplayer/assets/icons/audio_file.svg" alt="Shipping truck icon" class="feature-icon">
                        <p class="feature-text">Free shipping in UK</p>
                      </div>
                      <div class="feature-item">
                        <img src="http://localhost:8080/wp-content/themes/buzzerplayer/assets/icons/audio_file.svg" alt="Secure payment icon" class="feature-icon">
                        <p class="feature-text">100% Secure Payment</p>
                      </div>
                  </div>
              </div>
          </div>
    </div>
</div>
<div style="height: 100px"></div>


<?php
get_footer(); // Include header
?>