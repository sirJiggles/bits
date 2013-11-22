<?php get_header(); ?>


<div class="row">
    <div class="title-row">
        <h2>Blog and News</h2>
    </div>
</div>

<div class="row">
   <aside class="grid-3 blog-side">
        <h3>Filter news</h3>
        <?php get_sidebar('blog'); ?>
    </aside>
    <div class="grid-9 end">

        <section class="blog-details">
            <ul>
                <?php $count = 1; ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php

                    $class = false;

                    if ($count == 1) $class = 'first';
                    if ($count == $wp_query->post_count) $class = 'last';

                    ?>
                    <li class="<?php echo $class; ?>">
                        <article>
                            <time datetime="<?php the_time('c') ?>"><?php the_time('d M'); ?></time>
                            <div class="social">
                                <a class="socialite twitter-share" href="http://twitter.com/share" data-url="<?php the_permalink(); ?>"></a>
                                <a class="socialite facebook-like" data-href="<?php the_permalink(); ?>" data-send="true" data-layout="button_count" data-show-faces="false"></a>
                            </div>
                            <header>
                                <h2><a href="<?php the_permalink(); ?>" title="Click here to read <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                            </header>
                            <ul class="tags">
                                <?php $terms = wp_get_post_terms($post->ID, 'category'); ?>
                                <?php $i = 1; ?>
                                <?php foreach ($terms as $key => $term) {
                                    if ($term->slug == 'uncategorized') unset($terms[$key]);
                                } ?>
                                <?php foreach ($terms as $term) : ?>
                                    <li>
                                        <a href="<?php echo get_category_link($term->term_id); ?>"><?php echo $term->name; ?></a><?php if ($i != count($terms)) echo ','; ?>
                                    </li>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </ul>

                            <?php the_content(); ?>

                        </article>
                    </li>
                    <?php $count++; ?>
                <?php endwhile; ?>
            </ul>
        </section>
        
        <?php include('helper-pagination.php'); ?>

    </div>
</div>


<?php get_footer(); ?>