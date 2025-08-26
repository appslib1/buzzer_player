<?php
/**
 * Template Name: Product Page
 * Description: A custom page template with a special layout.
 */

get_header(); // Include header
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 m-auto">
                <h1><?= the_title() ?></h1>
                <div class="description">
                    <?= the_content() ?>
                </div>
                <div class="product-grid row position-relative">
                    <?php 
                        $args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => -1, // -1 = all products
                        );
                        $loop = new WP_Query( $args );    
                        while ( $loop->have_posts() ) : $loop->the_post();
                        global $product;
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    ?>
                        <div class="col-md-3 col-sm-6 col-6">
                            <a class="product-card" href="<?php the_permalink(); ?>">
                                <div class="image-container">
                                    <img src="<?= $thumb_url ?>" alt="<?= the_title() ?>" class="product-image">
                                </div>
                                <div class="product-details">
                                    <h3 class="product-title"><?= the_title() ?></h3>
                                    <h4 class="text-price"><?= $product->get_price_html(); ?></h4>
                                </div>
                            </a>
                        </div>
                    <?php 
                        endwhile;
                        wp_reset_postdata(); 
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
get_footer(); // Include footer
