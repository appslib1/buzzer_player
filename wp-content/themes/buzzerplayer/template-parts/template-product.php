<?php
/**
 * Template Name: Product Page
 * Description: A custom page template with a special layout.
 */

get_header();

$pageTitle   = get_the_title();
$pageContent = get_the_content();
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 m-auto">
                <div class="header">
                    <h1><?php echo esc_html($pageTitle); ?></h1>
                    <div class="description">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
                <div class="filters">
                    <?php 
                        $post_type   = 'audio';
                        $taxonomies  = get_object_taxonomies($post_type, 'objects'); // fixed: 'objects' not 'category'

                        foreach ($taxonomies as $taxonomy) {
                            $terms = get_terms([
                                'taxonomy'   => $taxonomy->name,
                                'hide_empty' => false,
                            ]);

                            if (!empty($terms) && !is_wp_error($terms)) {
                                echo '<ul>';
                                foreach ($terms as $term) {
                                    if ($term->count > 0 && $term->slug != "non-classe") {
                                        echo '<li><a href="#" data-slug="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</a></li>';
                                    }
                                }
                                echo '</ul>';
                            }
                        }
                    ?>
                </div>

                <div class="audios-wrapper">
                    <div id="audio-list" class="audios">
                        <?php
                        $args = array(
                            'post_type'      => 'audio',
                            'posts_per_page' => 15,
                            'paged'          => 1,
                        );
                        $loop = new WP_Query($args); 

                        while ($loop->have_posts()) : $loop->the_post();
                            $bruitage_id = get_the_ID();
                            if (!$bruitage_id) continue;

                            $title = get_the_title($bruitage_id);
                            $icon  = get_the_post_thumbnail_url($bruitage_id, 'thumbnail') ?: get_template_directory_uri() . '/assets/icons/buzzBtn.png';
                        ?>
                        <div class="sound-button-group position-relative text-center">
                            <img data-audio="<?php echo esc_url(get_field('upload_mp3', $bruitage_id)['url']); ?>"
                                 src="<?php echo esc_url($icon); ?>" 
                                 alt="<?php echo esc_attr($title); ?>" 
                                 class="sound-button">
                            <div class="position-relative">
                                <div class="button-label title"><?php echo esc_html($title); ?></div>
                                <div class="button-label button-label-2 text-center">
                                    <a href="#" class="use-it-button btn btn-danger">USE IT</a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>

                    <?php if($loop->found_posts > 15) { ?>
                    <div class="paginate text-center">
                        <a href="#" class="show-more btn btn-primary buzzer-default-btn" data-page="1">Display more sounds</a>
                    </div>
                    <?php } ?>
                </div>

                <div class="content">
                    <?php echo $pageContent; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
jQuery(document).ready(function($){

    // 🔹 Filter AJAX
    $(document).on('click', '.page-template-template-product .filters ul a', function(e) {
        e.preventDefault();

        $('.page-template-template-product .filters ul a').removeClass('active');
        $(this).addClass('active');

        let category = $(this).attr('data-slug');

        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            method: 'POST',
            data: {
                action: 'filter_audio',
                category: category,
            },
            success: function(response) {
                if(response.success){
                    $('.audios').html(response.data); 
                } else {
                    $('.audios').html('<p>No audios found.</p>');
                }
            }
        });
    });

    // 🔹 Load More AJAX
    $(document).on('click', '.paginate .show-more', function(e) {
        e.preventDefault();

        let button = $(this);
        let page   = parseInt(button.attr('data-page')) + 1;

        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            type: 'POST',
            data: {
                action: 'load_more_audios',
                page: page
            },
            beforeSend: function() {
                button.text('Loading...');
            },
            success: function(response) {
                if (response.trim() !== '') {
                    $('#audio-list').append(response);
                    button.attr('data-page', page).text('Display more sounds');
                } else {
                    button.remove(); // no more posts
                }
            }
        });
    });
    //use-it-button
    $(document).on('click', '.use-it-button', function(e) {   
        e.preventDefault();
        var audioElements = [];
        var title = $(this).parents('.sound-button-group').find('.button-label.title').text();
        var url = $(this).parents('.sound-button-group').find('img').attr('data-audio');
        audioElements.push({ name: title, url: url });
        
       

        $.ajax({
            url: '<?php echo admin_url("admin-ajax.php"); ?>', // WordPress provides this in admin, or use localized script for frontend
            type: 'POST',
            data: {
                action: 'save_audios_session', // PHP hook
                audios: audioElements
            },
            success: function(response) {
                window.location.replace("<?= home_url('/product/buzzer-with-customized-sound/') ?>");
            }
        });
    });

});
</script>

<?php
get_footer();
