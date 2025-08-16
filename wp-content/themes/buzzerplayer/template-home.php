<?php
/**
 * Template Name: Home Page
 * Description: A custom page template with a special layout.
 */

get_header(); // Include header
?>

<!-- Bloc Hero -->
<div class="hero-section">
      <div class="hero-content">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/waves.svg" alt="waves" class="decoration decoration-top-left">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/boostnote.svg" alt="boostnote" class="decoration decoration-top-right">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/smile.svg" alt="smile" class="decoration decoration-bottom-left">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/pink_smile.svg" alt="pink smile" class="decoration decoration-bottom-right">
        <h1 class="hero-title">CUSTOM YOUR BUZZER</h1>
        <p class="hero-description">Personalise the sound of your press button for a magic, funny and memorable moment!</p>
        <a href="#" class="button">ADD A SONG</a>
    </div>


    <div class="hero-footer">
        <div class="container">
          <div class="row">
              <div class="col-md-4">
                <span>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/audio_file.svg" alt="audio file" class="decoration decoration-top-left">
                    Up to 3min sound
                </span>
              </div>
              <div class="col-md-4">
                <span>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/audio_file.svg" alt="audio file" class="decoration decoration-top-left">
                    Up to 3min sound
                </span>
              </div>
              <div class="col-md-4">
                <span>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/audio_file.svg" alt="audio file" class="decoration decoration-top-left">
                    Up to 3min sound
                </span>
              </div>
          </div>
        </div>
    </div>

</div>

<div style="height: 110px"></div>

<!-- Bloc Sound ideas -->
<div class="container">
    <div class="row">
        <div class="col-md-12 sound-ideas-block position-relative text-center">
            <h2 class="block-title mb-4">SOUND IDEAS YOU COULD USE</h2>

            <div class="d-flex justify-content-center flex-wrap gap mb-3">
              <?php for($i = 0; $i <5; $i++){ ?>
              <div class="sound-button-group position-relative">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/buzzBtn.png" alt="Sound button" class="sound-button">
                <div class="button-label">Trololo</div>
                <div class="button-label button-label-2">
                  <a href="#" class="use-it-button btn btn-danger">USE IT</a>
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

<div class="products-section container">
  <div class="header">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/symbole.svg" alt="Buzzer Player Symbole" class="logo">
    <p class="description">With Buzzer Player, we offer a range of buzzer for any kind of purpose. The principle is simple : Bring a good vibe and smiles.</p>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/yes.svg" alt="Yes" class="decoration">
  </div>
  <div class="product-grid row">
    <?php for($i=0; $i <= 3; $i++){ ?>
    <div class="product-card col-md-3">
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
     <?php } ?>
  </div>
  <a href="#" class="see-all-button">SEE ALL PRODUCTS</a>
</div>




<?php
get_footer(); // Include footer
