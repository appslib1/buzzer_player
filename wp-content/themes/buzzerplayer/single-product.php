<?php
get_header();
global $woocommerce;
$product = new WC_Product(get_the_ID()); 
$thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

?>


<div class="container my-5">
  <div class="row align-items-center">
    <!-- Left: Product Image -->
    <div class="col-md-5 text-center">
      <img src="<?= $thumb_url ?>" alt="<?= the_title() ?>" class="img-fluid rounded shadow">
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
            class="btn btn-primary btn-lg mt-3 add_to_cart_button ajax_add_to_cart"
            data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
            rel="nofollow">
            <i class="bi bi-cart-fill"></i> <?php echo esc_html( $add_to_cart_text ); ?>
            </a>
        <?php } ?>

    </div>
  </div>
</div>


<?php
get_footer(); // Include header
?>