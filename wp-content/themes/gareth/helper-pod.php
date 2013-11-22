<article>
    <header><h1><?php echo $pod->get_the_value('pod-title'); ?></h1></header>

    <?php switch($pod->get_the_value('type')) : 
        case 'news': ?>

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

        <?php break; ?>

        <?php case 'text': ?>
            <?php echo apply_filters('the_content', $pod->get_the_value('text')); ?>
            <?php if($pod->get_the_value('text-button-text') != '' && $pod->get_the_value('text-button-url') != ''): ?>
                <a class="btn" href="<?php echo $pod->get_the_value('text-button-url'); ?>" title="<?php echo $pod->get_the_value('text-button-text'); ?>"><?php echo $pod->get_the_value('text-button-text'); ?></a>
            <?php endif; ?>
        <?php break; ?>

        <?php case 'twitter': ?>
            <div class="twitter">
                <?php  $tweets = getTweets(1, $pod->get_the_value('twitter'));?>

                <?php foreach ($tweets as $item) : ?>

                    <div class="content">
                        <span class="icon-twitter"></span>
                        <p><?php echo Inflector::twitterify($item['text']); ?></p>
                    </div>
                    <time datetime="<?php echo date('c', strtotime($item['created_at'])) ?>"><?php echo Inflector::timesince(strtotime($item['created_at'])); ?></time>
                
                <?php endforeach; ?>
            </div>
        <?php break; ?>

        <?php case 'video': ?>
        	<div class="video"> 
        		<div class="video-wrapper">
    				<iframe src="http://www.youtube.com/embed/<?php echo $pod->get_the_value('video-url'); ?>" frameborder="0" allowfullscreen width="420" height="315"></iframe>
    			</div>
    			<?php if( $pod->get_the_value('video-author') != '') : ?>
    				<cite><?php echo $pod->get_the_value('video-author'); ?></cite>
				<?php endif; ?>
				<?php if( $pod->get_the_value('video-extra') != '') : ?>
    				<h3><?php echo $pod->get_the_value('video-extra'); ?></h3>
				<?php endif; ?>
    		</div>
        <?php break; ?>

        <?php case 'newsletter': ?>
            <div class="newsletter">

                <?php echo apply_filters('the_content', $pod->get_the_value('newsletter')); ?>

                <?php $form = Form_Handler::get_instance()->get_form_class('newsletter'); ?>

                <?php if (!$form->submitted()) : ?>
                    <?php echo $form->errors(); ?>

                    <form id="newsletter" action="/" method="post" class="newsletter-form">
                        <fieldset>
                        
                            <label for="name">Name</label>
                            <input type="text" id="fname" name="fname" required="required" placeholder="Your name" value="<?php echo Uri::get_param('fname'); ?>"/>

                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo Uri::get_param('email'); ?>" placeholder="sample@emailprovider.com" required="required"/>

                            <input type="submit" name="submit-newsletter" value="Sign up now" class="btn" />
                            <a href="#" class="js-submit btn">Sign up now</a>

                            <input type="hidden" name="form" value="newsletter" />
                        </fieldset>
                    </form>

                <?php else: ?>
                    <div class="valid">
                        <p>Thank you, you have been subscribed to our newsletter.</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php break; ?>

        <?php case 'pages': ?>
            <div class="pages">
                 <?php

                    $args = array(
                        'depth'         => 1,
                        'post_type'     => 'page',
                        'post_status'   => 'publish',
                        'sort_order'    => 'DESC',
                        'number'        =>  6,
                        'title_li'      => '',
                        'child_of'      => (int)$pod->get_the_value('pages')
                    );
                ?>
                <ul>
                    <?php wp_list_pages($args); ?>
                </ul>
                <?php if($pod->get_the_value('pages-button-text') != '' && $pod->get_the_value('pages-button-url') != ''): ?>
                    <a class="btn" href="<?php echo $pod->get_the_value('pages-button-url'); ?>" title="<?php echo $pod->get_the_value('pages-button-text'); ?>"><?php echo $pod->get_the_value('pages-button-text'); ?></a>
                <?php endif; ?>
            </div>

        <?php break; ?>

        <?php case 'services' ?>
            <div class="pages">
                 <?php

                    $my_query = new WP_Query( array(
                        'post_type' => 'service',
                        'order_by'  => 'date',
                        'order'     => 'DESC',
                        'posts_per_page'  => 6
                    ) );

                    global $service;
                ?>
                <ul>
                <?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
                    <?php $service->the_meta(); ?>
                    <li><a href="<?php echo $service->get_the_value('url'); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                </ul>
                
                <a class="btn" href="/services" title="View all services">All Services</a>
                
            </div>
        <?php break; ?>

    <?php endswitch; ?>

</article>