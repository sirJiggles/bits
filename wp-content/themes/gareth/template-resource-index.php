<?php /* Template Name: Resource Index */
	get_header();
	global $pod;
?>


<div class="resources-section">

	<div class="row">
	    <div class="title-row">
	        <h2><?php the_title(); ?></h2>
	    </div>
	</div>

	<div class="row">
		<nav class="breadcrumbs">
			<ul>
				<li><a href="#" title="Resources">Resources</a></li>
				<li><a href="#" title="Online Resources" class="active">Online Resources</a></li>
			</ul>
		</nav>
	</div>

	<div class="row">
		<aside class="grid-4">
			<nav class="sub-nav-global">
				<ul>
					<li><a href="#" title="Factsheets">Factsheets</a></li>
					<li><a href="#" title="Online Resources" class="active">Online Resources</a></li>
					<li><a href="#" title="Mobile App">Mobile App</a></li>
				</ul>
			</nav>

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


		<section class="grid-8 end">
			<!-- FOR NOW THIS IS JUST HARD SET -->
			<ul class="resources">
				<?php for($i = 0; $i < 6; $i ++): ?>
					<li>
						<a href="/resource-library/sample-page" title="Some title">
							<span class="arrow-right icon-play"></span>
							<article>
								<header><h1>Title for item <?php echo $i; ?></h1></header>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquam felis sem, 
									eu molestie augue adipiscing et. Mauris quis turpis iaculis, ornare nisi quis</p>
							</article>
						</a>
					</li>
				<?php endfor; ?>
			</ul>



		</section>


	</div>


</div>

<?php get_footer(); ?>