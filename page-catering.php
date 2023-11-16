<?php


get_header();

// Page loop
while ( have_posts() ) : the_post(); ?>

    <h1><?php the_title(); ?></h1>
		<?php 
    // Display the Opening Paragraph ACF field
    if ( get_field( 'opening_paragraph' ) ) : ?>
        <div class="opening-paragraph">
            <?php the_field( 'opening_paragraph' ); ?>
        </div>
    <?php endif; ?>
    <div><?php the_content(); ?></div>

    <?php
    // WP Query for Catering CPT
    $args = array(
        'post_type' => 'cac-catering', 
        'posts_per_page' => -1
    );
    $query = new WP_Query( $args );

    if ( $query->have_posts() ) : ?>
        <div class="catering-packages">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="package">
                    <?php $package_image_id = get_field( 'package_image' ); ?>
                    <?php if ( $package_image_id ) : ?>
                        <?php $package_image = wp_get_attachment_image_src( $package_image_id, 'full' ); ?>
                        <?php if ( $package_image ) : ?>
                            <img src="<?php echo esc_url( $package_image[0] ); ?>" alt="<?php the_field( 'package_name' ); ?>" />
                        <?php endif; ?>
                    <?php endif; ?>

                    <h2><?php the_field( 'package_name' ); ?></h2>
                    <p><?php the_field( 'package_description' ); ?></p>
                    
                    <?php $orderform_link = get_field( 'orderform_link' ); ?>
                    <?php if ( $orderform_link ) : ?>
                        <a href="<?php echo esc_url( $orderform_link['url'] ); ?>" class="order-button">Order Now</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;
    wp_reset_postdata();
    ?>

    <?php
    // Embed Gravity Form 
    if ( function_exists( 'gravity_form' ) ) {
        gravity_form( 4, false, false, false, '', false );  
    }
    ?>

<?php endwhile;

get_footer(); ?>
