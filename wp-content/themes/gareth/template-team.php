<?php /* Template Name: Team */
    get_header();

    $currentCat = 'all';

    if(isset($_GET['category']) && $_GET['category'] != ''){
        $currentCat = $_GET['category'];
    }

    global $team;

?>


<div class="row">
    <div class="title-row">
        <h2>The Tyrrell and Company Team</h2>
    </div>
</div>

<div class="row team">

    <?php $categories = get_categories(array('taxonomy' => 'job_category')); ?>
    <nav class="category-nav">
        <ul>
            <li class="first"><a href="/about" title="All" <?php echo ($currentCat == 'all') ? 'class="active"' : ''; ?>>All</a></li>
            <?php $i = 0; ?>
            <?php foreach($categories as $category): ?>

                <li <?php echo (($i + 1) == count($categories)) ? 'class="last"' : ''; ?>>
                    <a href="/about?category=<?php echo $category->cat_ID; ?>" <?php echo ($currentCat == $category->cat_ID) ? 'class="active"' : ''; ?> title="<?php echo $category->name; ?>"><?php echo $category->name; ?></a>
                </li>

                <?php $i ++; ?>
            <?php endforeach; ?>
        </ul>
    </nav>


    <div class="grid-8">

        <div class="team-listing">

            <?php 
                // if we have a specific cat to show, then the categories array is one index with the relevent obj in it
                if($currentCat != 'all'){
                    foreach ($categories as $cat ) {
                        if($cat->cat_ID == $currentCat){
                            $categories = array($cat);
                            break;
                        }
                    }
                }
            ?>

            <?php foreach($categories as $cat): ?>

                <h3><?php echo $cat->name; ?></h3>
                <ul>
                    <?php 
                        $args = array(
                            'nopaging'  => true,
                            'post_type' => 'team',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'job_category',
                                    'field' => 'cat_ID',
                                    'terms' => $cat->cat_ID
                                )
                            )
                        );

                        $my_query = new WP_Query($args);

                        while ( $my_query->have_posts() ) : $my_query->the_post();
                        
                        $team->the_meta();

                    ?>
                        <li>
                            <article>
                                <figure>
                                    <?php the_post_thumbnail('team-profile'); ?>
                                </figure>

                                <div class="team-right">
                                    <header>
                                        <h1><?php the_title(); ?></h1>

                                        <?php if($team->get_the_value('position') != ''): ?>
                                            <div class="role"><?php echo $team->get_the_value('position'); ?></div>
                                        <?php endif; ?>

                                        <?php if($team->get_the_value('email') != ''): ?>
                                            <a href="mailto:<?php echo $team->get_the_value('email'); ?>" title="Email: <?php the_title(); ?>" class="email"><?php echo $team->get_the_value('email'); ?></a>
                                        <?php endif; ?>

                                        <?php if($team->get_the_value('tel') != ''): ?>
                                            <a href="tel:<?php echo str_replace(' ', '', $team->get_the_value('tel')); ?>" title="Telephone: <?php the_title(); ?>" class="tel"><?php echo $team->get_the_value('tel'); ?></a>
                                        <?php endif; ?>
                                    </header>

                                    <div class="bio-wrapper">
                                        <h2>Biography</h2>
                                        <?php the_content(); ?>
                                    </div>
                                    <a href="#" title="Read biography" class="more">Read biography</a>
                                </div>
                            </article>
                        </li>

                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>

                </ul>

            <?php endforeach; ?>

            <?php wp_reset_postdata(); ?>

            </ul>
        </div>
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