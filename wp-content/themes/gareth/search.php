<?php get_header(); ?>
<?php global $pod; ?>

<div class="row">
    <div class="title-row">
        <h2>Search Results</h2>
    </div>
</div>

<div class="row">

    <div class="grid-8 search-results">
        <form method="get" action="<?php bloginfo('home'); ?>">
            <label for="search">Search Again</label>
            <div class="search-form-wrapper">
                <input type="text" name="s" id="search" placeholder="Search" />
                <input type="submit" name="submit" value=""/>
                <a class="js-submit icon-search" href="#" title="Click to search"></a>
            </div>
        </form>
        <p class="showing-data">Showing <em><?php echo $wp_query->found_posts; ?></em> results containing the word '<em><strong><?php echo get_query_var('s'); ?></strong></em>'</p>
    
        <ul class="search-listing">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <article>
                        <header>
                            <h1>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                            </h1>
                        </header>

                        <p><?php echo substr(get_the_content(), 0, 200).' ...'; ?></p>

                    </article>
                </li>
             <?php endwhile; ?>
        </ul>

        <?php include('helper-pagination.php'); ?>

    </div>

    <aside class="grid-4 end">
        <div class="pod">
            <article>
                <header><h1>News</h1></header>
                 <div class="news">
                    <ul>
                        <?php 
                        $query = new WP_Query(array(
                            'post_type' => 'post',
                            'order_by'  => 'date',
                            'order'     => 'DESC',
                            'posts_per_page'  => 3
                        ));
                        ?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <li>
                                <time datetime="<?php echo date('c', strtotime($post->post_date)) ?>"><?php echo Inflector::timesince(strtotime($post->post_date)); ?></time>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo substr(get_the_content(), 0, 50) . ' ...'; ?></a>
                            </li>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>

                    <a class="btn" href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>">View all <?php echo strtolower($pod->get_the_value('pod-title')); ?></a>
                </div>
            </article>
        </div>
    </aside>

</div>

<?php get_footer(); ?>