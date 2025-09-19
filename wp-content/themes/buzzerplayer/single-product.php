<?php
get_header();
global $woocommerce;
$product = new WC_Product(get_the_ID()); 
$thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

$attachment_ids = $product->get_gallery_image_ids();

?>


<section class="product-top-section">
    <div class="container">
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

          <div class="price-reviews">
              <!-- Ratings -->
              <div class="ratings">
                <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9733;</span>
                <small class="nb-ratings">120 reviews</small>
              </div>

              <!-- Price -->
              <h4 class="text-price"><?= $product->get_price_html(); ?></h4>
          </div>

          <!-- Description -->
          <div class="product-description">
                <?= the_excerpt() ?>
            </div>

          <!-- Add to Cart Button -->
		      <!-- Proper WooCommerce Add-to-Cart Form -->
<form class="cart" method="post" enctype="multipart/form-data">

    <!-- Choose Audio Option -->
    <div>
        <label>
            <input type="radio" name="audio_option" value="upload" checked> Upload MP3
        </label>
        <label>
            <input type="radio" name="audio_option" value="record"> Record Audio
        </label>
    </div>

    <!-- File upload -->
    <div id="upload-section">
        <input type="file" name="mp3_upload[]" id="mp3_upload" accept=".mp3" multiple>
    </div>

    <!-- Record audio controls -->
    <div id="record-section" style="display:none;">
        <button type="button" id="start-record">Start Recording</button>
        <button type="button" id="stop-record" disabled>Stop Recording</button>
        <audio id="audio-preview" controls style="display:none;"></audio>
    </div>

    <!-- WooCommerce add-to-cart hidden input -->
    <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>">

    <button type="submit">Add to Cart</button>
</form>




        </div>
      </div>
    </div>
</section>


<div class="features-bar">
    <div class="features-bar-content">
        <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="feature-items">
                          <div class="feature-item">
                            <img src="<?= home_url('wp-content/themes/buzzerplayer/assets/icons/audio_file.svg') ?>" alt="Audio file icon" class="feature-icon">
                            <p class="feature-text">Up to 3min sound</p>
                          </div>
                          <div class="feature-item">
                            <img src="<?= home_url('wp-content/themes/buzzerplayer/assets/icons/battery.svg') ?>" alt="Battery icon" class="feature-icon">
                            <p class="feature-text">Batteries included</p>
                          </div>
                          <div class="feature-item">
                            <img src="<?= home_url('wp-content/themes/buzzerplayer/assets/icons/shipping.svg') ?>" alt="Shipping truck icon" class="feature-icon">
                            <p class="feature-text">Free shipping in UK</p>
                          </div>
                          <div class="feature-item">
                            <img src="<?= home_url('wp-content/themes/buzzerplayer/assets/icons/secure.svg') ?>" alt="Secure payment icon" class="feature-icon">
                            <p class="feature-text">100% Secure Payment</p>
                          </div>
                      </div>
                  </div>
              </div>
        </div>
    </div>
</div>

<div class="product-features">
      <div class="container">
        <div class="row">
              <div class="col-md-6">
                <div class="product-details">
                    <?php the_content() ?>
                </div>
                <div class="shipping">
                    <h3>Shipping and delivery</h3>
                    <div>
                        <strong>Standard delivery</strong>
                        <ul>
                            <li>FREE order in the UK</li>
                            <li>£3.50 on all orders less than £20</li>
                        </ul>
                        <br>
                        <strong>Delivery</strong>
                        <ul>
                          <li>Order by 7pm Monday to Friday for next working day</li>
                        </ul>
                        <br>
                        <strong>More info</strong>
                        <p>Visit our <a href="">Shipping & Delivery</a> page for more detailed info.</p>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                  <?php if ( is_active_sidebar( 'faq-produit' ) ) : ?>
                      <div class="faq-widget-area">
                          <?php dynamic_sidebar( 'faq-produit' ); ?>
                      </div>
                  <?php endif; ?>

              </div>
        </div>
    </div>
</div>

<div>
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <?php if ( is_active_sidebar( 'spread-smiles' ) ) : ?>
                  <?php dynamic_sidebar( 'spread-smiles' ); ?>
              <?php endif; ?>
          </div>
      </div>
  </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', () => {
    const audioOptionInputs = document.querySelectorAll('input[name="audio_option"]');
    const uploadSection = document.getElementById('upload-section');
    const recordSection = document.getElementById('record-section');
    const fileInput = document.getElementById('mp3_upload');
    const startBtn = document.getElementById('start-record');
    const stopBtn = document.getElementById('stop-record');
    const audioPreview = document.getElementById('audio-preview');

    let mediaRecorder;
    let audioChunks = [];

    // Toggle sections
    audioOptionInputs.forEach(input => {
        input.addEventListener('change', () => {
            if (input.value === 'upload') {
                uploadSection.style.display = 'block';
                recordSection.style.display = 'none';
            } else {
                uploadSection.style.display = 'none';
                recordSection.style.display = 'block';
            }
        });
    });

    // Start recording
    startBtn.addEventListener('click', async () => {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        mediaRecorder = new MediaRecorder(stream);
        audioChunks = [];
        mediaRecorder.start();

        startBtn.disabled = true;
        stopBtn.disabled = false;

        mediaRecorder.addEventListener('dataavailable', e => audioChunks.push(e.data));
    });

    // Stop recording
    stopBtn.addEventListener('click', async () => {
        mediaRecorder.stop();
        startBtn.disabled = false;
        stopBtn.disabled = true;

        mediaRecorder.addEventListener('stop', async () => {
            const blob = new Blob(audioChunks, { type: 'audio/mp3' });
            const file = new File([blob], `recording-${Date.now()}.mp3`, { type: 'audio/mp3' });

            // Append recorded file to existing file input
            const dataTransfer = new DataTransfer();

            // Include existing uploaded files
            Array.from(fileInput.files).forEach(f => dataTransfer.items.add(f));

            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;

            // Preview
            audioPreview.src = URL.createObjectURL(blob);
            audioPreview.style.display = 'block';
        });
    });
});

</script>


<?php
get_footer(); // Include header
?>