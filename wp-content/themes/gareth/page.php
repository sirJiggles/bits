<?php get_header(); ?>
<?php 

global $pod;
global $testimonial; 

?>

<?php while (have_posts()) : the_post(); ?>

    <div class="row">
        <div class="title-row">
            <h2><?php the_title(); ?></h2>
        </div>
    </div>

    <div class="row">

        <section role="main" class="grid-8 wp-content">
            <?php the_content(); ?>
        </section>

        <aside class="grid-4 end">

            <?php 
            // query to get the testimonials
            $connected = new WP_Query( array(
              'connected_type' => 'testimonial_to_page',
              'connected_items' => get_queried_object(),
              'nopaging' => false,
              'posts_per_page' => 1
            ) );
            ?>
            <?php if ( $connected->have_posts() ) : ?>
                <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
                    <?php $testimonial->the_meta(); ?>
                    <?php include('helper-testimonial.php'); ?>
                <?php endwhile; ?>

            <?php endif; ?>

            <?php wp_reset_postdata(); ?> 


            <?php 
            // query to get the pods
            $connected = new WP_Query( array(
              'connected_type' => 'pod_to_page',
              'connected_items' => get_queried_object(),
              'nopaging' => false,
              'posts_per_page' => 4
            ) );
            ?>
            <?php if ( $connected->have_posts() ) : ?>
                <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
                    <?php $pod->the_meta(); ?>
                    <div class="pod">

                        <?php include('helper-pod.php'); ?>
                        
                    </div>
                <?php endwhile; ?>

            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

        </aside>

    </div>

<?php endwhile; ?>

<?php get_footer(); ?>