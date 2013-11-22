<?php /* Template Name: Services */
	get_header();
	$my_query = new WP_Query( array(
		'post_type' => 'service',
		'nopaging'	=> true
	) );
	global $service;
?>

	<div class="row">
	    <div class="title-row">
	        <h2>Our Services</h2>
	    </div>
	</div>

	<div class="row services">
		<?php $i = 2; ?>
		<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
			<?php $endClass = (($i % 3 === 1) && ($i != 1)) ? ' end' : ''; ?>
			<?php $service->the_meta(); ?>
			<div class="grid-4<?php echo $endClass; ?>">
				<a href="<?php echo $service->get_the_value('url'); ?>" title="<?php the_title(); ?>">
					<article>
						<figure>
							<?php the_post_thumbnail('service'); ?>
							<figcaption>
								<h1><?php the_title(); ?></h1>
								<p><?php echo substr(get_the_content(), 0, 200); ?></p>
							</figcaption>
						</figure>
						<span class="arrow-right icon-play"></span>
					</article>
				</a>
			</div>
			<?php $i ++; ?>
		<?php endwhile; ?>

	</div>

<?php get_footer(); ?>