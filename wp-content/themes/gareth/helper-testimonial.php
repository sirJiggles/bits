<article class="testimonial">
	<header><h1><?php echo $testimonial->get_the_value('title'); ?></h1></header>

	<div class="testimonial-inner">
		<h2>"<?php the_content(); ?>"</h2>

		<figure>
			<?php the_post_thumbnail('testimonial'); ?>
			<figcaption>
				<?php if($testimonial->get_the_value('name') != ''): ?>
					<cite><?php echo $testimonial->get_the_value('name'); ?></cite>
				<?php endif; ?>

				<?php if($testimonial->get_the_value('position') != ''): ?>
					<div class="role"><?php echo $testimonial->get_the_value('position'); ?></div>
				<?php endif; ?>
			</figcaption>
		</figure>
	</div>

</article>