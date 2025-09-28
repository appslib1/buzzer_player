<?php
if ( ! session_id() ) {
    session_start();
}
get_header();
global $woocommerce;
$product = new WC_Product(get_the_ID()); 
$thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

$attachment_ids = $product->get_gallery_image_ids();

// Get saved audios
$saved_audios = $_SESSION['selected_audios'] ?? [];

?>


<section class="product-top-section">
    <div class="container">
      <div class="row">
        <!-- Left: Product Image -->
        <div class="col-lg-7 col-md-6 text-center">

            <div class="product-imgs-wrapper">
                <h2 class="section-title"><?= the_title() ?></h2>
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

          </div>


        <!-- Right: Product Details -->
        <div class="col-lg-5 col-md-6">
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
          <?php 
            if ( ! empty( $saved_audios ) ) {
          ?>
              <div class="select-audio-files">
                  <?php 
                    foreach ( $saved_audios as $audio ) {
                  ?>
                      <div>
                          <button class="play-recorded-audio" data-audio="<?= $audio['url'] ?>"></button>
                          <img src="<?= home_url('wp-content/themes/buzzerplayer/assets/icons/song-file.svg') ?>" alt="Song file">
                          <span><?= $audio['name'] ?></span>
                          <button class="cancel remove-audio-session"></button>
                      </div>
                  <?php 
                    }
                  ?>
                  <a href="" class="buzzer-default-btn add-another-audio add-song">
                      Add another audio
                  </a>
              </div>
          <?php 
            }
          ?>

          <?php if ( ! empty( $saved_audios ) ) { ?>
              <label>
                  <input id="agree-checkbox" type="checkbox" name="agree" value="yes">
                  <span>I confirm I have the rights to this audio and accept the <a href="">Terms</a>.</span>
              </label>
              <!-- Add to Cart Button -->
              <?php 
                if ( $product ) {
                    $add_to_cart_url = $product->add_to_cart_url();
                    $add_to_cart_text = "Add to cart"
                    ?>
                    <a id="add-to-cart-btn" href="<?php echo esc_url( $add_to_cart_url ); ?>" 
                    class="btn btn-primary btn-lg mt-3 add_to_cart_button ajax_add_to_cart "
                    data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
                    rel="nofollow">
                    <i class="bi bi-cart-fill"></i> <?php echo esc_html( $add_to_cart_text ); ?>
                    </a>
                <?php } ?>
          <?php } else { ?>
            <a href="" class="buzzer-default-btn add-song" id="openModal"> 
              <img src="<?= home_url('wp-content/themes/buzzerplayer/assets/icons/track.svg') ?>" alt="Track">
              <span>Add a song</span>
            </a>
          <?php } ?>

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

<!-- Modal structure -->
<div id="audioModal" class="addSongModal modal">
    <div>
        <h2>Add a song</h2>
        <div class="btns">
          <button id="trigger-upload" class="audioOption" data-action="upload">
            Upload your audio
          </button>
          <button id="search-for-song" class="audioOption" data-action="search">
            Search for a song
          </button>
          <button id="record-modal" class="audioOption" data-action="record">
            Record your sound
          </button>
        </div>
        <span class="closeModal">&times;</span>
    </div>
</div>

<div id="recordModal" class="recordModal modal">
    <div>
        <h2>Add a song</h2>
        <span>
          You have up to <strong>3 minutes</strong> to record your song.
          You can also add multiple audio clips by recording multiple times.
        </span>
        <div class="record-section">
            <span class="label">Click the button to start recording</span>
            <span class="timer" id="timer">00:00</span>
            <span class="allow">Please allow access to your microphone to continue...</span>
            <span class="result">Your sound is ready!</span>
            <button class="record-audio"></button>
            <div class="recorded-audio-result"> 
                <div>
                    <button class="play-recorded-audio"></button>
                    <img src="<?= home_url('/wp-content/themes/buzzerplayer/assets/icons/song-file.svg') ?>" alt="Song file">
                    <span>Recording.webm</span>
                    <button class="cancel"></button>
                </div>
            </div>
        </div>
        <div class="confirm-wrapper d-none"> 
            <a href="" class="buzzer-default-btn">
              CONFIRM AND SELECT
            </a>
        </div>
        <span class="closeModal">&times;</span>
    </div>
</div>

<!-- select from audios -->
<div class="listAudiosModal modal">
    <div>
        <h2>Add a song</h2>
        <div>
          <div class="input-wrapper">
              <input type="text" name="" id="" placeholder="Search for a song">
          </div>
          <ul id="audio-list">
              <?php
                $args = array(
                    'post_type'      => 'audio',
                    'posts_per_page' => -1,
                    'status' => 1
                );
                $loop = new WP_Query($args);    

                while ($loop->have_posts()) : $loop->the_post();
                $bruitage_id = get_the_ID();
                if (!$bruitage_id) continue;
                $title = get_the_title($bruitage_id);
              ?>
              <li>
                  <button>
                      <a class="play" data-audio="<?php echo esc_url(get_field('upload_mp3', $bruitage_id)['url']); ?>"></a>
                      <div class="">
                          <span class="title"><?= $title ?></span>
                          <span class="timer"></span>
                      </div>
                  </button>
              </li>
            <?php
              endwhile;
            ?>
          </ul>
          <div class="confirm-wrapper d-none"> 
              <a href="" class="buzzer-default-btn">
                CONFIRM AND SELECT
              </a>
          </div>
        </div>
        <span class="closeModal">&times;</span>
    </div>
</div>

<form id="uploadAudioForm" enctype="multipart/form-data" class="d-none">
    <input type="file" id="uploadAudioInput" accept="audio/*">
    <button type="submit">Upload Audio</button>
</form>



<script>
jQuery(document).ready(function($){
    let currentAudio = null;
    let currentRecordedAudio = null;

    /*$(document).on("click", function(e) {
        console.log('doc click');
        // if the click is NOT inside #myDiv
        if ( !$(e.target).closest(".modal>div").length && !$(e.target).closest("#openModal").length) {
            $('.modal').removeClass('show');
        // your code here
        }
    });*/

    $('#add-to-cart-btn').on('click', function(e) {
        if (!$('#agree-checkbox').is(':checked')) {
            e.preventDefault(); // Stop the default add to cart
            alert('Please confirm that you have the rights to this audio and accept the Terms.');
            return false;
        }
    });

    $(document).on("click",".single-product .recordModal > div div.record-section .recorded-audio-result > div .cancel",function(e) {
        if(currentRecordedAudio != null){
            currentRecordedAudio.pause();
            currentRecordedAudio.currentTime = 0;
        }
        $('.record-section').removeClass('recording-finished');
        $('.single-product .recordModal > div .confirm-wrapper').addClass('d-none');
    });

    $(document).on("click","#recordModal .recorded-audio-result .play-recorded-audio",function(e) {
        var btn = $(this);
        btn.addClass('play');
        currentRecordedAudio = new Audio(recordedAudio);
        currentRecordedAudio.play();
        currentRecordedAudio.addEventListener('ended', () => {
          btn.removeClass('play');
          console.log('Audio has finished playing.');

          // You can add any other logic here, like resetting UI or playing next audio
        });

    });


    $(document).on("click","#trigger-upload",function(e) {
        $('#uploadAudioInput').trigger('click');
    });
    $(document).on("change","#uploadAudioInput",function(e) {
        $('#uploadAudioForm').submit();
    });
    $(document).on("click","#search-for-song",function(e) {
        e.preventDefault();
        $('.addSongModal').removeClass('show');
        $('.listAudiosModal').addClass('show');
    });

    $(document).on("click","#record-modal",function(e) {
        e.preventDefault();
        $('.addSongModal').removeClass('show');
        $('.recordModal').addClass('show');
    });

    $(document).on("click",".modal .closeModal",function(e) {
        e.preventDefault();
        $(this).parents('.modal').removeClass('show');
    });


    $(document).on("click",".add-song",function(e) {
        e.preventDefault();
        $('.addSongModal').addClass('show');
    });

    $(document).on("click",".addSongModal .closeModal,.listAudiosModal .closeModal",function(e) {
        $(this).parents('.modal').removeClass('show');
    });

    var currentBtn = null;

    $('.listAudiosModal ul li .play').click(function(e) {
        e.preventDefault();
        var audioUrl = $(this).attr('data-audio');

        if (!currentAudio || currentAudio.src !== audioUrl) {
            if (currentAudio) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
                $(currentBtn).removeClass('pause');
            }
            currentAudio = new Audio(audioUrl);
            currentBtn = this;
            currentAudio.play();
            $(this).addClass('pause');
        }
        else {
            if (currentAudio.paused) {
                currentAudio.play();
                $(this).addClass('pause');
            } else {
                currentAudio.pause();
                $(this).removeClass('pause');
            }
        }

        currentAudio.onended = function() {
            $(currentBtn).removeClass('pause');
        };
    });



    $(document).on("click",".listAudiosModal ul li button",function(e) {
        if ($(e.target).hasClass('play')) {
            return; // do nothing if the click was on .play
        }

        if($(this).hasClass('active')){
            $(this).removeClass('active');
        }
        else{
            $(this).addClass('active');
        }
        if($('.listAudiosModal ul li button.active').length){
              $('.listAudiosModal .confirm-wrapper').removeClass('d-none');
        }
        else{
              $('.listAudiosModal .confirm-wrapper').addClass('d-none');
        }
        
    });

    $('.listAudiosModal input[type=text]').on('keyup', function() {
        var keyword = $(this).val().toLowerCase();
        var foundResults = false; // Flag to track if any results are found

        // Loop through each list item in the audio list
        $('#audio-list li').each(function() {
            var listItem = $(this);
            var title = listItem.find('.title').text().toLowerCase();

            // Check if the title includes the keyword
            if (title.includes(keyword)) {
                listItem.show();
                foundResults = true; // Set flag to true
            } else {
                if(!listItem.hasClass('no-result')){
                    listItem.hide();
                }
            }
        });

        // After the loop, check the flag to add or remove the 'no-result' message
        if (foundResults) {
            $('.listAudiosModal ul li.no-result').remove();
        } else {
            // Check if the 'no-result' message already exists to prevent duplication
            if ($('.listAudiosModal ul li.no-result').length === 0) {
                $('.listAudiosModal ul').append('<li class="no-result pt-4">No result found</li>');
            }
        }
    });

    $(document).on("click",".record-audio",function(e) {
      if (mediaRecorder && mediaRecorder.state !== "inactive") {
          $('.record-section').removeClass('recording');
          mediaRecorder.stop();
      }
      else{
          startRecording();
      }
        
    });

    $(document).on("click","#recordModal .confirm-wrapper a",function(e) {
      e.preventDefault();
      console.log(recordedAudio);
      const reader = new FileReader();
      reader.readAsDataURL(audioBlob);
      reader.onloadend = function () {
          const base64Audio = reader.result;

          // Send AJAX request to save in session
          $.ajax({
              url: '<?php echo admin_url("admin-ajax.php"); ?>',
              type: 'POST',
              data: {
                  action: 'save_recorded_audio',
                  audio: base64Audio,
                  name: "Recorded " + new Date().toLocaleString()
              },
              success: function (response) {
                  if (response.success) {
                        location.reload();
                  } else {
                      alert("Failed to save audio: " + response.data);
                  }
              }
          });
      };

    });

    attrTimers();
    
    function attrTimers(){
        // First, find all the play buttons on the page
      const playButtons = document.querySelectorAll('.listAudiosModal .play');

      // Loop through each button to add the functionality
      playButtons.forEach(button => {
          const audioUrl = button.getAttribute('data-audio');
          const timerSpan = button.closest('button').querySelector('.timer');
          if (audioUrl) {
              const audio = new Audio(audioUrl);

              // Listen for the loadedmetadata event
              audio.addEventListener('loadedmetadata', () => {
                  const durationInSeconds = audio.duration;
                  const minutes = Math.floor(durationInSeconds / 60);
                  const seconds = Math.floor(durationInSeconds % 60);

                  // Format the duration as MM:SS with leading zeros
                  const formattedTime = 
                      `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

                  // Update the span with the calculated duration
                  timerSpan.textContent = formattedTime;
              });
          }
      });
    }

    let mediaRecorder;
    let audioChunks = [];
    let timerInterval;
    let seconds = 0;
    let stream;
    let recordedAudio;
    let audioBlob;
    function formatTime(sec) {
      const m = String(Math.floor(sec / 60)).padStart(2, "0");
      const s = String(sec % 60).padStart(2, "0");
      return `${m}:${s}`;
    }
    async function startRecording() {
          try{
            stream = await navigator.mediaDevices.getUserMedia({ audio: true });
          
          mediaRecorder = new MediaRecorder(stream);

          mediaRecorder.ondataavailable = e => {
            audioChunks.push(e.data);
          };

          mediaRecorder.onstop = () => {
              stream.getTracks().forEach(track => track.stop());
              audioBlob = new Blob(audioChunks, { type: 'audio/webm' });
              const audioUrl = URL.createObjectURL(audioBlob);
              recordedAudio = audioUrl;
              console.log(recordedAudio);
              audioChunks = []; // reset for next recording
              stream = null;
              $('.record-section').removeClass('recording');
              $('.record-section').removeClass('permission-denied');
              $('.record-section').addClass('recording-finished');
              $('#recordModal .confirm-wrapper').removeClass('d-none');
              clearInterval(timerInterval);
          
          };

          mediaRecorder.start();
          seconds = 0;
          document.getElementById("timer").textContent = "00:00";
          timerInterval = setInterval(() => {
            seconds++;
            document.getElementById("timer").textContent = formatTime(seconds);
          }, 1000);
          
          $('.record-section').removeClass('permission-denied');
          $('.record-section').removeClass('recording-finished');
          $('.record-section').addClass('recording');
          
          }
          catch(err){
              if (err.name === "NotAllowedError" || err.message.includes("NotAllowedError")) {
                  console.log("Microphone access denied or not available:", err);
                $('.record-section').addClass('permission-denied');
              }
          }
    }
    
    //Confirmation des songs fournis par le pop up
    $(document).on("click",".listAudiosModal .buzzer-default-btn",function(e) {
      e.preventDefault();
      
      var audiosList = $('.listAudiosModal #audio-list li button.active');

      var audioElements = [];

      audiosList.each(function() {
          var url = $(this).find('a').attr('data-audio');
          var title = $(this).find('.title').text();
          audioElements.push({ name: title, url: url });
          //if (url) audioUrls.push(url);
      });

      $.ajax({
          url: '<?php echo admin_url("admin-ajax.php"); ?>', // WordPress provides this in admin, or use localized script for frontend
          type: 'POST',
          data: {
              action: 'save_audios_session', // PHP hook
              audios: audioElements
          },
          success: function(response) {
              //console.log(response);
              location.reload();
          }
      });
    });

    var currentBtn_1 = null;
    let currentAudio_1 = null;

    $(document).on("click",".product-top-section .select-audio-files .play-recorded-audio",function(e) {
        e.preventDefault();
        var audioUrl = $(this).attr('data-audio');

        if (!currentAudio_1 || currentAudio_1.src !== audioUrl) {
            if (currentAudio_1) {
                currentAudio_1.pause();
                currentAudio_1.currentTime = 0;
                $(currentBtn_1).removeClass('pause');
            }
            currentAudio_1 = new Audio(audioUrl);
            currentBtn_1 = this;
            currentAudio_1.play();
            $(this).addClass('pause');
        }
        else {
            if (currentAudio_1.paused) {
                currentAudio_1.play();
                $(this).addClass('pause');
            } else {
                currentAudio_1.pause();
                $(this).removeClass('pause');
            }
        }

        currentAudio_1.onended = function() {
            $(currentBtn_1).removeClass('pause');
        };
    });



    $(document).on("click",".product-top-section .select-audio-files .remove-audio-session",function(e) {
        var audioUrl = $(this).parent().find('button').attr('data-audio');
        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            type: 'POST',
            data: {
                action: 'delete_audio_session',
                url: audioUrl
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.data);
                }
            }
        });
    });

    
    $('#uploadAudioForm').submit(function(e) {
        e.preventDefault();

        var fileInput = $('#uploadAudioInput')[0];
        if (!fileInput.files.length) return alert('Select a file');

        var file = fileInput.files[0];
        var formData = new FormData();
        formData.append('action', 'save_uploaded_audio');
        formData.append('audio_file', file);
        formData.append('name', file.name);

        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Upload failed: ' + response.data);
                }
            }
        });
    });


});
</script>



<?php
get_footer(); // Include header
?>