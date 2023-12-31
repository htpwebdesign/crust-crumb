<?php
/**
 * The template for displaying the catering page
 *
 * @package Crust_&_Crumb_Bakery
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    // Page loop
    while ( have_posts() ) : the_post(); ?>

        <section class="catering-title">
            <h1><?php the_title(); ?></h1>
            <?php 
            // Display the Opening Paragraph ACF field
            if ( get_field( 'opening_paragraph' ) ) : ?>
                <div class="opening-paragraph">
                    <?php the_field( 'opening_paragraph' ); ?>
                </div>
            <?php endif; ?>
            
        </section>

        <?php
        // WP Query for Catering CPT
        $args = array(
            'post_type' => 'cac-catering', 
            'posts_per_page' => -1
        );
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) : ?>
            <section class="catering-packages">
                <h2>Packages</h2>
                <div>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <article class="package">
                        <?php $package_image_id = get_field( 'package_image' ); ?>
                        <?php if ( $package_image_id ) : ?>
                            <?php $package_image = wp_get_attachment_image_src( $package_image_id, 'full' ); ?>
                            <?php if ( $package_image ) : ?>
                                <img src="<?php echo esc_url( $package_image[0] ); ?>" alt="<?php the_field( 'package_name' ); ?>" />
                            <?php endif; ?>
                        <?php endif; ?>

                        <h3><?php the_field( 'package_name' ); ?></h3>
                        <p><?php the_field( 'package_description' ); ?></p>
                    </article>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif;
        wp_reset_postdata();
        ?>

    <div>

        <section id="catering-form-wrapper" class="form-wrapper">
        <h2> Catering Order Form</h2>
            <?php
            // Embed Gravity Form 
            
            if ( function_exists( 'gravity_form' ) ) {
                gravity_form( 4, false, false, false, '', false );  
            }
            ?>
        </section>
    </div>

    <?php endwhile; ?>
</main>

<?php
get_footer(); ?>
