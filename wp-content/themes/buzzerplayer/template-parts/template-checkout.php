<?php
/**
 * Template Name: Checkout Page
 * Description: A custom page template with a special layout.
 */

get_header(); // Include header
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <main>
                    <?php if(isset($_GET['key'])) { ?>
                    <h1 class="thank-you">Thank you</h1>
                    <?php } else { ?>
                    <h1><?= the_title() ?></h1>
                    <?php } ?>

                    <?php if(isset($_GET['key'])) { ?>
                        <div class="thank-you-text">
                            <p>Thank you for your purchase!</p>
                            <p>
                                We've sent you an email with all the details of your order.<br>
                                Our team is now preparing your product and will dispatch it as soon as possible.
                            </p>
                            <p>If you have any questions or need support, feel free to contact us at <a href="mailto:contact@buzzerplayer.com">contact@buzzerplayer.com</a>.</p>
                            <p>Thanks again for choosing Buzzer Player, get ready to buzz in style!</p>

                            <a href="<?= home_url('/') ?>" class="buzzer-default-btn mt-4">
                                Go Home
                            </a>
                        </div>
                    <?php } ?>
                    <?= the_content() ?>
                </main>
            </div>
        </div>
    </div>

<?php
get_footer(); // Include footer
