<?php
/**
 * Template Name: Contact Page
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
        if( get_field('page_title') ): 
            echo '<h1>' . get_field('page_title') . '</h1>';
        endif;

        // Display Store Locations
        if( have_rows('store_locations') ): 
            echo '<div class="store-locations">';
            while ( have_rows('store_locations') ) : the_row();
                $store_image_id = get_sub_field('store_image');
                $location_name = get_sub_field('location_name');
                $location_hours = get_sub_field('location_hours');
                $location_phone_number = get_sub_field('location_phone_number');
                $location_address = get_sub_field('location_address');

                echo '<div class="store">';
                if( $store_image_id ) {
                    $store_image_url = wp_get_attachment_image_url( $store_image_id, 'full' );
                    $store_image_alt = get_post_meta( $store_image_id, '_wp_attachment_image_alt', true );
                    echo '<img src="' . esc_url($store_image_url) . '" alt="' . esc_attr($store_image_alt) . '" />';
                }
                if( $location_name ) {
                    echo '<h2>' . esc_html($location_name) . '</h2>';
                }
                if( $location_hours ) {
                    echo '<p>Hours: ' . esc_html($location_hours) . '</p>';
                }
                if( $location_phone_number ) {
                    echo '<p>Phone: ' . esc_html($location_phone_number) . '</p>';
                }
                if( $location_address ) {
                    echo '<p>Address: ' . esc_html($location_address) . '</p>';
                }
                echo '</div>';
            endwhile;
            echo '</div>';
        endif;

        // Display Store Locations Map
        if( get_field('store_locations_map') ): 
            echo '<div class="store-locations-map">' . get_field('store_locations_map') . '</div>';
        endif;

        // Display Social Media Message
        if( get_field('social_media_message') ): 
            echo '<div class="social-media-message">' . get_field('social_media_message') . '</div>';
        endif;

        // Display Social Media Links
        if( have_rows('social_media_links') ): 
            echo '<div class="social-media-links">';
            while ( have_rows('social_media_links') ) : the_row();
                $social_media_link_url = get_sub_field('social_media_link');
                $social_media_image_id = get_sub_field('social_media_image');

                echo '<div class="social-media-item">';
                if( $social_media_link_url ) {
                    echo '<a href="' . esc_url($social_media_link_url) . '">';
                    if( $social_media_image_id ) {
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
    ?>
<?php gravity_form( 1, false, false, false, '', false ); ?>

</main>

<?php
get_sidebar();
get_footer();
?>
