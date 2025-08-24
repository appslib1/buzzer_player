<?php
/**
 * Template Name: Contact Page
 * Description: A custom page template with a special layout.
 */

get_header(); // Include header
?>

<div class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title"><?= the_title() ?></h1>
            </div>
            <div class="col-md-5 order-md-1 order-2">
                <div class="contact-info">
                    <div class="contact-email">
                        <p><?php pll_e('Fill in the form or drop an email'); ?></p>
                        <a href="mailto:<?= get_field('email') ?>"><?= get_field('email') ?></a>
                    </div>
                    <div class="content">
                        <?= the_content() ?>
                    </div>
                </div>
            </div>
            <div class="col-md-7 order-md-2 order-1">
                <div class="contact-form">
                    <?= do_shortcode('[contact-form-7 id="ea702eb" title="Principal Contact form"]') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer(); // Include footer
