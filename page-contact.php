<?php
/**
 * The template for displaying the contact page
 * @package Crust_&_Crumb_Bakery
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()):
        the_post();

        // Directly display the WordPress page title
        the_title('	<h1 class="page-title">', '</h1>');

        if (function_exists("get_field")) {
            // Query location-CPT posts
            $location_posts = new WP_Query(
                array(
                    'post_type' => 'cac-store-locations',
                    'posts_per_page' => -1
                )
            );

            if ($location_posts->have_posts()):
                echo '<section class="store-locations">';
                while ($location_posts->have_posts()):
                    $location_posts->the_post();

                    // Fetch fields for each location
                    $location_name = get_field('location_name');
                    $location_hours = get_field('location_hours');
                    $location_phone = get_field('location_phone');
                    $location_address = get_field('location_address');
                    echo '<div class="wrapper">';
                    echo '<article class="location-container">';
                    echo '<h2 class="location-name accordionTitle">';
                    echo esc_html($location_name);
                    echo '<span class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z"/></svg></span></h2>';

                    $location_image_id = get_post_meta(get_the_ID(), 'location_image', true);
                    if ($location_image_id) {
                        $location_image_url = wp_get_attachment_image_url($location_image_id, 'full');
                        echo '<img src="' . esc_url($location_image_url) . '" alt="' . esc_attr(get_the_title()) . '" class="accordionContent location-img" />';
                    }
                    // Display other location details
                    echo '<p class="location-address accordionContent">' . esc_html($location_address) . '</p>';
                    echo '<div class="accordionContent">';
                    echo '<p class="location-phone "><u>Phone:</u> ' . esc_html($location_phone) . '</p>';
                    echo '<p class="location-hours "><u>Hours:</u><br/>' . $location_hours . '</p>';
                    echo '</div>';

                    echo '</article>';
                    echo '</div>';
                endwhile;
                echo '</section>';
            endif;
            wp_reset_postdata();


            // Display Store Locations Map
            //need to add in the google maps 
            if (get_field('')):
                echo '<section class="store-locations-map">' . get_field('location_map') . '</section>';
            endif;
            ?>
            <div class='social-media-section'>
                <?php
                // Display Social Media Message
                if (get_field('social_media_message')):
                    echo '<p class="social-media-message">' . get_field('social_media_message') . '</p>';
                endif;

                // Social Media Links section
                if (have_rows('social_media_links')):
                    echo '<nav class="social-media-links"><ul>';
                    while (have_rows('social_media_links')):
                        the_row();
                        $social_media_link_url = get_sub_field('social_media_link');
                        $social_media_image_id = get_sub_field('social_media_image');

                        echo '<li class="social-media-item">';
                        if ($social_media_link_url) {
                            echo '<a href="' . esc_url($social_media_link_url) . '">';
                            if ($social_media_image_id) {
                                echo $social_media_image_id;
                            }
                            echo '</a>';
                        }
                        echo '</li>';
                    endwhile;
                    echo '</ul></nav>';
                endif;

                // Testing SVG link
                if (get_field('svg_link_test')) {
                    echo get_field('svg_link_test');
                }
                ?>
            </div>
            <?php
        }

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()):
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>
    <section class="form-wrapper">
        <h2>Contact Form</h2>
            <?php
            // Embed Gravity Form 
            
            if ( function_exists( 'gravity_form' ) ) {
                gravity_form( 2, false, false, false, '', false );  
            }
            ?>
        </section>
   

</main>

<?php
get_footer();
?>