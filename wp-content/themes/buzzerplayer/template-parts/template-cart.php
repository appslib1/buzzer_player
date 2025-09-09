<?php
/**
 * Template Name: Cart Page
 * Description: A custom page template with a special layout.
 */

get_header(); // Include header
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <main>
                    <h1><?= the_title() ?></h1>
                    <?= the_content() ?>
                </main>
            </div>
        </div>
    </div>

<?php
get_footer(); // Include footer
