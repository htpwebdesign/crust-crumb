<?php
/**

 * The template for displaying the contact page
 *
 * @package Crust_&_Crumb_Bakery
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();

        // Display Page Title
        if ( get_field('page_title') ): 
            echo '<h1>' . get_field('page_title') . '</h1>';
        endif;

        // Query location-CPT posts
        $location_posts = new WP_Query(array(
            'post_type' => 'cac-store-locations', 
            'posts_per_page' => -1 
        ));

        if ( $location_posts->have_posts() ) :
            echo '<div class="store-locations">';
            while ( $location_posts->have_posts() ) : $location_posts->the_post();

                // Fetch fields for each location
                
                $location_name = get_field('location_name');
                $location_hours = get_field('location_hours');
                $location_phone = get_field('location_phone');
                $location_address = get_field('location_address');

                echo '<div class="store">';
                // Display location image
                $location_image_id = get_post_meta( get_the_ID(), 'location_image', true ); 
                if ( $location_image_id ) {
                    $location_image_url = wp_get_attachment_image_url( $location_image_id, 'full' );
                    echo '<img src="' . esc_url($location_image_url) . '" alt="' . esc_attr(get_the_title()) . '" />';
                }
                // Display other location details
                echo '<h2>' . esc_html($location_name) . '</h2>';
                echo '<p>Hours: ' . esc_html($location_hours) . '</p>';
                echo '<p>Phone: ' . esc_html($location_phone) . '</p>';
                echo '<p>Address: ' . esc_html($location_address) . '</p>';
                echo '</div>';

            endwhile;
            echo '</div>';
        endif;
        wp_reset_postdata();

        // Display Store Locations Map
        if ( get_field('store_locations_map') ): 
            echo '<div class="store-locations-map">' . get_field('store_locations_map') . '</div>';
        endif;

        // Display Social Media Message
        if ( get_field('social_media_message') ): 
            echo '<div class="social-media-message">' . get_field('social_media_message') . '</div>';
        endif;
      
        // Display Social Media Links
        if ( have_rows('social_media_links') ): 
            echo '<div class="social-media-links">';
            while ( have_rows('social_media_links') ) : the_row();
                $social_media_link_url = get_sub_field('social_media_link');
                $social_media_image_id = get_sub_field('social_media_image');

                echo '<div class="social-media-item">';
                if ( $social_media_link_url ) {
                    echo '<a href="' . esc_url($social_media_link_url) . '">';
                    if ( $social_media_image_id ) {
                        $social_media_image_url = wp_get_attachment_image_url( $social_media_image_id, 'full' );
                        $social_media_image_alt = get_post_meta( $social_media_image_id, '_wp_attachment_image_alt', true );
                        echo '<img src="' . esc_url($social_media_image_url) . '" alt="' . esc_attr($social_media_image_alt) . '" />';
                    }
                    echo '</a>';
                }
                echo '</div>';
            endwhile;
            
            
            echo '</div>';
        endif;
        
        // The default page content
        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    gravity_form( 2, false, false, false, '', false );
    ?>

</main>

<?php
// get_sidebar();
get_footer();
?>
