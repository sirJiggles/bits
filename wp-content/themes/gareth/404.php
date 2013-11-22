<!-- 404 Template -->

<?php get_header(); ?>

<?php global $pod_images; ?>


<div class="white-row">
    <div class="row">

        <div class="grid-12 end">
            <div class="title-row">
            	<h2>Page Not Found</h2>
          
            </div>
        </div>
    </div>
</div>

<div class="row" role="main">
	<div class="grid-8">
		<section class="wp-content">
			<h3>Page Not Found</h3>
			<p>The page you where looking for could not be found, please try again.</p>
		</section>
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