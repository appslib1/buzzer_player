<?php
/**
 * Template Name: Faq Page
 * Description: A custom page template with a special layout.
 */

get_header(); // Include header
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <h1 class="page-title"><?= the_title() ?></h1>
                    <?= the_content() ?>
            </div>
        </div>
    </div>
</main>

<?php
get_footer(); // Include footer
