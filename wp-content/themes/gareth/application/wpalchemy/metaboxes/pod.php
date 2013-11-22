<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">


	<?php $mb->the_field('type'); ?>
	<p id="type-controlls">
		<label for="<?php $mb->the_name(); ?>">Pod type</label>
		<select id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>">
			<option value="news" <?php if ($mb->get_the_value() == 'news') echo 'selected="selected"'; ?>>News</option>
			<option value="text" <?php if ($mb->get_the_value() == 'text') echo 'selected="selected"'; ?>>Text</option>
			<option value="twitter" <?php if ($mb->get_the_value() == 'twitter') echo 'selected="selected"'; ?>>Twitter</option>
			<option value="video" <?php if ($mb->get_the_value() == 'video') echo 'selected="selected"'; ?>>Video</option>
			<option value="newsletter" <?php if ($mb->get_the_value() == 'newsletter') echo 'selected="selected"'; ?>>Newsletter</option>
			<option value="pages" <?php if ($mb->get_the_value() == 'pages') echo 'selected="selected"'; ?>>Page list</option>
			<option value="services" <?php if ($mb->get_the_value() == 'services') echo 'selected="selected"'; ?>>Services</option>
		</select>
	</p>

	<?php $mb->the_field('pod-title'); ?>
	<p>
		<label for="<?php $mb->the_name(); ?>">Pod Title:</label>
		<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	</p>

	<div id="text-type" class="type-select">
		<?php $mb->the_field('text'); ?>
		<p>
			<label for="<?php $mb->the_name(); ?>">Text</label>
			<?php
			wp_editor( html_entity_decode($mb->get_the_value('text')), $mb->get_the_name(), array(
				'textarea_name' => $mb->get_the_name(),
				'media_buttons' => false,
			));	
			?>
		</p>
		<?php $mb->the_field('text-button-text'); ?>
		<p>
			<label for="<?php $mb->the_name(); ?>">Button Text:</label>
			<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
		</p>
		<?php $mb->the_field('text-button-url'); ?>
		<p>
			<label for="<?php $mb->the_name(); ?>">Button URL:</label>
			<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="/about" />
		</p>
	</div>

	<div id="twitter-type" class="type-select">
		<?php $mb->the_field('twitter'); ?>
		<p>
			<label for="<?php $mb->the_name(); ?>">Twitter name:</label>
			<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
		</p>
	</div>

	<div id="video-type" class="type-select">

		<?php $mb->the_field('video-url'); ?>
		<p>
			<label for="<?php $mb->the_name(); ?>">YoutTube video:</label>
			<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="XBoeqgE2Yu4" />
		</p>
		
	    <?php $mb->the_field('video-author'); ?>
		<p>
			<label for="<?php $mb->the_name(); ?>">Name:</label>
			<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
		</p>
		<?php $mb->the_field('video-extra'); ?>
		<p>
			<label for="<?php $mb->the_name(); ?>">Position:</label>
			<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
		</p>
	</div>

	<div id="newsletter-type" class="type-select">
		<?php $mb->the_field('newsletter'); ?>

		<p>
			<label for="<?php $mb->the_name(); ?>">Newsletter pretext</label>
			<?php
			wp_editor( html_entity_decode($mb->get_the_value('newsletter')), $mb->get_the_name(), array(
				'textarea_name' => $mb->get_the_name(),
				'media_buttons' => false,
			));	
			?>
		</p>
	</div>

	<div id="pages-type" class="type-select">
		<?php $mb->the_field('pages'); ?>
		<p>
			<label for="<?php $mb->the_name(); ?>">Pages</label>
			<?php 
				$args = array(
					'depth' 	=> 1,
					'selected'	=> $mb->get_the_value(),
					'name'		=> $mb->get_the_name()
				);
			?>
			<?php wp_dropdown_pages( $args ); ?> 
		</p>
		<?php $mb->the_field('pages-button-text'); ?>
		<p>
			<label for="<?php $mb->the_name(); ?>">Button Text:</label>
			<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
		</p>
		<?php $mb->the_field('pages-button-url'); ?>
		<p>
			<label for="<?php $mb->the_name(); ?>">Button URL:</label>
			<input type="text" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="/services" />
		</p>
	</div>


	
</div>
