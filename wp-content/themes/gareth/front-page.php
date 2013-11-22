<?php 

get_header();
global $homepage_slide;
global $pod;

?>

<?php while (have_posts()) : the_post(); ?>


<div class="drop-shadow-row">
    <div class="row">
        <div class="homepage-gallery">
            <ul class="slides">
                 <?php
                    // Get all of the homepage slides
                    $args = array(
                        'orderby'           => 'date',
                        'post_type'         => 'homepage_slide',
                        'order'             => 'DESC',
                    );
                    $query = new WP_Query($args);
                ?>
                <?php while ($query->have_posts()) : ?>
                    <?php 
                        $query->the_post();
                        //refresh the meta!
                        $homepage_slide->the_meta();
                    ?>
                    <li>
                        <figure>
                            <?php the_post_thumbnail('homepage_slide'); ?>
                            <figcaption>
                                <?php the_content(); ?>
                            </figcaption>

                             <?php if ($homepage_slide->get_the_value('cite')) : ?>
                                <cite>
                                    <?php echo $homepage_slide->get_the_value('cite'); ?>
                                </cite>
                            <?php endif; ?>

                            <?php if( $homepage_slide->get_the_value('link_text') && $homepage_slide->get_the_value('link_location') ) : ?>
                                <a href="<?php echo $homepage_slide->get_the_value('link_location'); ?>" class="btn" title="<?php echo $homepage_slide->get_the_value('link_text'); ?>">
                                    <?php echo $homepage_slide->get_the_value('link_text'); ?>
                                </a>
                            <?php endif; ?>

                        </figure>


                    </li>

                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>

            </ul>

            <div class="flex-controlls-container">

            </div>
        </div>
    </div>
</div>

<!-- PODS ON THE HOMEPAGE -->
<div class="row">

    <?php 
    // query to get the pods
    $connected = new WP_Query( array(
      'connected_type' => 'pod_to_page',
      'connected_items' => get_queried_object(),
      'nopaging' => false,
      'posts_per_page' => 6
    ) );
    ?>
    <?php if ( $connected->have_posts() ) : ?>
        <?php $i = -1; ?>
        <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>

            <?php $pod->the_meta(); ?>

            <div class="grid-4<?php echo ($i % 3 == 1) ? ' end' : ''; ?> pod">

                <?php include('helper-pod.php'); ?>
                
            </div>

            <?php if($i % 3 == 1) : ?>
                <div class="clear">&nbsp;</div>
            <?php endif; ?>


            <?php $i ++; ?>
        <?php endwhile; ?>

    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

</div>


<?php endwhile; ?>

<?php get_footer(); ?>