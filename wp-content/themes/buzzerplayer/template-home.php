<?php
/**
 * Template Name: Home Page
 * Description: A custom page template with a special layout.
 */

get_header(); // Include header
?>

  <?= the_content() ?>

<?php /*
<!-- Bloc Sound ideas -->
<div class="container">
    <div class="row">
        <div class="col-md-12 sound-ideas-block position-relative text-center">
            <h2 class="block-title mb-4">SOUND IDEAS YOU COULD USE</h2>

            <div class="d-flex justify-content-center flex-wrap gap mb-3">
              <?php for($i = 0; $i <5; $i++){ ?>
              <div class="sound-button-group position-relative">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/buzzBtn.png" alt="Sound button" class="sound-button">
                <div class="position-relative">
                    <div class="button-label">Trololo</div>
                    <div class="button-label button-label-2">
                      <a href="#" class="use-it-button btn btn-danger">USE IT</a>
                    </div>
                </div>
              </div>
              <?php } ?>
            </div>

            <div class="check-link ">
              <a href="#">Check other sound effects →</a>
            </div>
          </div>

    </div>
</div>

<div style="height: 168px"></div>

<!-- Bloc featured products -->
<div class="products-section">
  <div class="container">
      <div class="header">
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/symbole.svg" alt="Buzzer Player Symbole" class="logo">
                <p class="description">With Buzzer Player, we offer a range of buzzer for any kind of purpose. The principle is simple : Bring a good vibe and smiles.</p>
            </div>
            <div class="col-lg-8 col-md-12 m-auto">
                <div class="product-grid row position-relative">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/yes.svg" alt="Yes" class="decoration">
                  <?php for($i=0; $i <= 3; $i++){ ?>
                  <div class="col-md-3 col-sm-6 col-6">
                    <div class="product-card">
                      <div class="image-container">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/product-example.png" alt="Custom buzzer" class="product-image">
                      </div>
                      <div class="product-details">
                        <h3 class="product-title">Custom buzzer</h3>
                        <div class="prices">
                          <span class="current-price">£15</span>
                          <span class="old-price">£20</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
            </div>
        </div>
      </div>
      <div class="text-center">
            <a href="#" class="button buzzer-default-btn">SEE ALL PRODUCTS</a>
      </div>
  </div>
</div>

<div style="height: 150px"></div>

<div class="container features-section">
  <div class="row">
      <div class="col-lg-8 col-md-12 m-auto">      
          <div class="row align-items-center">
            <!-- Image Left -->
            <div class="col-md-6">
              <div class="feature-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/placeholder.png" alt="">
              </div>
            </div>
            <!-- Text Right -->
            <div class="col-md-6">
              <h3 class="feature-title">ADD YOUR OWN SONG</h3>
              <p class="feature-text">
                Have a specific audio file? Just upload it and we’ll insert it into your buzzer.
                You can also record a heartfelt message to surprise your family or friends.
                Don’t know what to insert? Just select one of the songs from our library.
              </p>
            </div>
          </div>

          <div class="row align-items-center flex-md-row-reverse">
            <!-- Image Right -->
            <div class="col-md-6">
              <div class="feature-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/placeholder.png" alt="">
              </div>
            </div>
            <!-- Text Left -->
            <div class="col-md-6">
              <h3 class="feature-title">CLEAR AUDIO OUTPUT</h3>
              <p class="feature-text">
                These buttons ensure loud and clear audio output, making them suitable
                for classroom activities and large offices.
              </p>
            </div>
          </div>

      </div>
  </div>


</div>

<div style="height: 150px"></div>

<section class="explore-ideas">
  <div class="container text-center">
    <div class="row g-4">
      <div class="col-lg-10 col-md-12 mx-auto">
          <h2 class="section-title">Explore More Ideas</h2>
          <div class="ideas-slider">
              <div class="swiper-wrapper">
                  <?php for($i=0; $i<=3; $i++){ ?>
                  <!-- Card 1 -->
                  <div class="card-container swiper-slide">
                    <a class="idea-card" href="">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/article-placeholder.png" alt="For Pets" class="img-fluid rounded-top">
                      <div class="idea-body">
                        <h3 class="idea-title">For Pets</h3>
                        <p class="idea-text">Train your dog to talk by using a buzzer.</p>
                      </div>
                    </a>
                  </div>
                  <?php } ?>
              </div>
          </div>
          <div class="position-relative arrows">
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
          </div>
      </div>

    </div>
  </div>
</section>

<div style="height: 150px"></div>

<section class="spread-smiles">
  <div class="container text-center">
    <h2 class="section-title mb-5">Spread Smiles with a Press</h2>
    <div class="row justify-content-center align-items-center">
      <div class="col-12 col-md-10 col-lg-8">
        <div class="smile-card d-flex flex-column flex-md-row align-items-center">
          <div class="row">
              <div class="col-md-7 order-2 order-md-1">
                  <div class="smile-text">
                    <p>
                      Whether it’s for parties, game nights, or breaking the ice at work, 
                      this buzzer brings instant fun. Just one press delivers laughter, 
                      surprises, and a smile every time!
                    </p>
                  </div>
              </div>
              <div class="col-md-5 order-1 order-md-2">
                  <div class="smile-image position-relative">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/press.jpg" alt="For Pets" class="img-fluid card-img rounded-top">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/bip.svg" alt="BIP!" class="bip-badge position-absolute">
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div style="height: 158px"></div>

<div class="faq-section">
  <div class="container">
      <div class="row">
          <div class="col-md-8 m-auto">
            <div class="faq-card">
              <div class="faq-header">
                <h2 class="faq-title section-title">YOU ASKED, WE ANSWERED</h2>
              </div>
              
              <div class="accordion" id="accordionExample">
                <?php for($i=0; $i <= 5; $i++) { ?>
                <div class="accordion-item faq-item">
                  <h2 class="accordion-header" id="heading-<?= $i ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $i ?>" aria-expanded="true" aria-controls="collapse-<?= $i ?>">
                      Accordion Item #1
                    </button>
                  </h2>
                  <div id="collapse-<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= $i ?>" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                  </div>
                </div>
                <?php } ?>

              </div>

              <div class="faq-footer check-link text-center">
                    <a href="#" class="faq-link">See all the FAQ page →</a>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>

<div style="height: 158px"></div>

<div class="explanation-section">
  <div class="container">
      <div class="row">
          <div class="col-md-10 m-auto">
            <div class="explanation-content">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/logo-placeholder.png" alt="Buzzer Player Symbole" class="logo">
              <p class="explanation-text">
                Buzzer Player come from the idea of bringing joy and fun into places but can also be used for <a href="">pet training</a>, gift for family, and many more! All the buzzers are carefully prepared in the UK for a fast delivery.
              </p>
            </div>
          </div>
      </div>
  </div>
</div>

*/ ?>

<?php
get_footer(); // Include footer
