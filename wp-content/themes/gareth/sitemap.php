<?php /* Template Name: Sitemap */ ?>

<?php 
get_header();
global $pod; 
global $testimonial; 
?>


<div class="row">
    <div class="title-row">
        <h2>Sitemap</h2>
    </div>
</div>


<div class="row" role="main">
	<div class="grid-8">
		<section class="wp-content">

			<h3>Sitemap</h3>

			<?php 
				wp_nav_menu(array(
                    'menu'          => 'Primary Navigation',
                    'container'     => false,
                    'menu_class'    => false,
                    'echo'          => true,
                    'before'        => '',
                    'after'         => '',
                    'link_before'   => '',
                    'link_after'    => '',
                    'depth'         => 0
                ));

				 wp_nav_menu(array(
                    'menu'          => 'Footer Navigation',
                    'container'     => false,
                    'menu_class'    => false,
                    'echo'          => true,
                    'before'        => '',
                    'after'         => '',
                    'link_before'   => '',
                    'link_after'    => '',
                    'depth'         => 0
                ));

			 ?>

		</section>
	</div>

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


<?php get_footer(); ?>