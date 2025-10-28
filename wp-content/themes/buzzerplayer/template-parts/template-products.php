<?php
/**
 * Template Name: Liste produits
 * Description: A custom page template with a special layout.
 */


get_header();
?>


	<main id="primary" class="site-main simple-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-md-12 m-auto">
					<div class="max-875">
						<h1 class="page-title"><?= the_title() ?></h1>
						<?= the_content() ?>

                        <div class="product-grid row position-relative mb-4 mt-4">
                            <?php
                            // Query the products (WooCommerce post type)
                            $args = array(
                                'post_type'      => 'product',
                                'posts_per_page' => 4, // Adjust number as needed
                                'post_status'    => 'publish',
                                /*'meta_query'     => array(
                                    array(
                                        'key'     => 'audio',      // The custom field
                                        'value'   => '',           // Exclude empty values
                                        'compare' => '!=',         // Not equal to empty
                                    ),
                                ),*/
                            );
                            $products = new WP_Query($args);

                            if ( $products->have_posts() ) :
                                while ( $products->have_posts() ) : $products->the_post();
                                global $product;
                                $link = get_the_permalink();
                            ?>
                            <div class="col-md-3 col-6 mb-4">
                                <a class="product-card" href="<?= $link ?>">
                                    <div class="image-container">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'product-image', 'alt' => get_the_title()]); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/product-example.png" alt="Default product" class="product-image">
                                        <?php endif; ?>
                                    </div>

                                    <div class="product-details">
                                        <?php 
                                        // Récupérer les catégories du produit
                                        $terms = get_the_terms( $product->get_id(), 'product_cat' );
                                        $cats = [];
                                        
                                        if ( $terms && ! is_wp_error( $terms ) ) {
                                            foreach ( $terms as $term ) {
                                                if ( strtolower($term->name) !== 'uncategorized' ) { // Exclure "Uncategorized"
                                                    $cats[] = $term->name;
                                                }
                                            }
                                        }
                                        
                                        // Transformer en chaîne séparée par une virgule
                                        $cats_list = !empty($cats) ? '<span class="product-category">' . implode(', ', $cats) . '</span>' : '';
                                        ?>
                                        <h3 class="product-title">
                                        <?php the_title(); ?>
                                        <?php echo $cats_list; ?>
                                        </h3>
                                        <div class="prices">
                                        <?= $product->get_price_html(); ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                            ?>
                            <p class="text-center">No products available at the moment.</p>
                            <?php endif; ?>
                        </div>
					</div>
				</div>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
